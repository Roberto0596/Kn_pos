<?php
require __DIR__ . '/autoload.php';
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
class ControladorVentas
{
    public function ctrCrearVenta()
	{
		if (isset($_POST["nuevaVenta"]))
		{
            //print_r($_POST);
            include_once "modelos/crearventa.modelo.php";
            include_once "controladores/productos.controlador.php";
            include_once "controladores/helpers.php";
            $tabla = "ventas";
            date_default_timezone_set('America/Hermosillo');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $fechaActual = $fecha.' '.$hora;
            if($_POST["tipoVenta"] == 0){ //0 es credito
                $fechaPrimerAbono = date("Y-m-d",strtotime($_POST["primerAbono"]));
                $pendiente = $_POST["totalVenta"] - $_POST["totalPayment"];
                $abonoBase = $pendiente / $_POST["cantidadTiempo"];
                $abonoBase = round($abonoBase,2);
                $calendarioAbonos = [];

                switch($_POST["tipoTiempo"]){
                    case "Semanal":
                        for ($i=1; $i <= $_POST["cantidadTiempo"]; $i++) {
                            $calendarioAbonos1 = [
                                "Fecha" => $fechaPrimerAbono,
                                "Abono" => $abonoBase,
                                "Estado" => 0,
                                "FechaPago" => 0,
                                "Cantidad" => 0,
                                "Folio" => 0
                            ];
                            array_push($calendarioAbonos, $calendarioAbonos1);
                            $fechaPrimerAbono = date("Y-m-d",strtotime($fechaPrimerAbono."+ 7 days"));
                        }
                    break;
                    case "Quincenal":
                        for ($i=1; $i <= $_POST["cantidadTiempo"]; $i++) {
                            $calendarioAbonos1 = [
                                "Fecha" => $fechaPrimerAbono,
                                "Abono" => $abonoBase,
                                "Estado" => 0,
                                "FechaPago" => 0,
                                "Cantidad" => 0,
                                "Folio" => 0
                            ];
                            array_push($calendarioAbonos, $calendarioAbonos1);
                            if(date("m",strtotime($fechaPrimerAbono)) == 2 && date("d",strtotime($fechaPrimerAbono)) == 15){
                                $fechaPrimerAbono = date("Y-m-d",strtotime($fechaPrimerAbono."+ 13 days"));
                            }else{
                                $fechaPrimerAbono = date("Y-m-d",strtotime($fechaPrimerAbono."+ 15 days"));
                            }
                            if(date("d",strtotime($fechaPrimerAbono)) == 14){
                                $fechaPrimerAbono = date("Y-m-d",strtotime($fechaPrimerAbono."+ 1 days"));
                            }
                        }
                    break;
                    case "Mensual":
                        for ($i=1; $i <= $_POST["cantidadTiempo"]; $i++) {
                            $calendarioAbonos1 = [
                                "Fecha" => $fechaPrimerAbono,
                                "Abono" => $abonoBase,
                                "Estado" => 0,
                                "FechaPago" => 0,
                                "Cantidad" => 0,
                                "Folio" => 0
                            ];
                            array_push($calendarioAbonos, $calendarioAbonos1);
                            $fechaPrimerAbono = date("Y-m-d",strtotime($fechaPrimerAbono."+ 1 month"));
                        }
                    break;
                }
                $calendarioAbonosFinal=json_encode($calendarioAbonos);
            }

            $productos = json_decode($_POST["listaProductos"]);
            foreach ($productos as $producto) {
                if(ControladorProductos::ctrVenta($producto->existencia, $producto->id) != "ok"){
                    $mensajeError .= "El producto ".$producto->descripcion." no se pudo modificar el stock, error sql";
                    dei("Error SQL: " . $mensajeError);
                }
            }

            if ($_POST["tipoVenta"] == 0) {
                $TipoAbono = $_POST["tipoTiempo"];
                $folioFact = "CR:".$_POST["falioFact"];
            }else{
                $pendiente = "0";
                $calendarioAbonosFinal = "N";
                $TipoAbono = "N";
                $folioFact = "CO:".$_POST["falioFact"];
            }
            $ModeloCrearventa = new ModeloVentas(NULL, $_POST["nuevaVenta"], $_POST["id_usuario"], $_POST["id_cliente"], $_POST["id_almacen"], $fecha, $hora, $_POST["listaProductos"], $_POST["totalVenta"], $_POST["totalPayment"], $_POST["descuentoTH"], $pendiente, $calendarioAbonosFinal, $TipoAbono, $_POST["tipoVenta"], $folioFact);
            //print_r($_POST);
            $respuesta = ModeloVentas::mdlCrearVenta($tabla,$ModeloCrearventa);
            if ($respuesta = "ok")
            {
					$cliente = ModeloClientes::mdlMostrarClientes("cliente","id_cliente",$_POST["id_cliente"],0);

					$nombre_impresora = "POS-80";
					$connector = new WindowsPrintConnector($nombre_impresora);
                    $printer = new Printer($connector);
                    $logo = EscposImage::load(__DIR__ . "/karina.jpg", false);
                    for ($contador=0; $contador < 3; $contador++) {
                        $printer->setJustification(Printer::JUSTIFY_CENTER);
                        $printer->bitImage($logo);
                        $printer->setTextSize(1, 2);
                        $printer->text("Calle 9 y 10 Avenida 28 Tel: 633-121-0748\n Agua Prieta, Son.\n");
                        $printer->text("__________________________________________\n");
                        $printer->feed();
                        if ($_POST["tipoVenta"] == 0) { //credito
                            $printer->text("Nuevo crédito: ".$_POST['nuevaVenta']."\n");
                        }else{//contado
                            $printer->text("Ticket #".$_POST['nuevaVenta']."\n");
                        }
                        $printer->setTextSize(1, 1);
                        $printer->feed();
                        $printer->text("Ticket #". $_POST['nuevaVenta'] ."    Fecha: ".$fechaActual."\n");
                        $printer->text("Cliente: ".$_POST['id_cliente']." - ". $cliente["nombre"] ."\n");
                        $printer->text("________________________________________________\n");
                        foreach ($productos as $producto) {
                            $printer->text($producto->id . "-" .substr($producto->descripcion, 0, 12). " $". $producto->precio ." x " . $producto->cantidad . " ··········· $" .$producto->total."\n");
                        }
                        $printer->text("________________________________________________\n");
                        $totalVenta = $_POST['totalVenta'];
                        $descuento = 0;
                        if (isset($_POST['descuentoP'])) {
                            $descuento = $_POST['descuentoTH'];
                            $totalVenta = $_POST['totalVenta'] + $_POST['descuentoTH'];
                            $printer->text("Subtotal ·············· $".$totalVenta."\n");
                            $printer->text("Descuento ··················· $".$_POST['descuentoTH']."\n");
                        }
                        if ($_POST["tipoVenta"] == 0) { //credito
                            $printer->text("Total a pagar ·············· $".$_POST['totalPayment']."\n");
                            $printer->text("Pagó con ··················· $".$_POST['totalPayment']."\n");
                            $printer->text("Cambio ····················· $0\n");
                            $printer->feed(2);
                            $printer->text("\n");
                            $printer->setJustification(Printer::JUSTIFY_LEFT);
                            $printer->text("Nuevo crédito agregado a la cuenta\n");
                            $printer->text("Total de la cuenta $".$totalVenta."\n");
                            $printer->text("Descuento $".$descuento."\n");
                            $printer->text("Anticipo $".$_POST['totalPayment']."\n");
                            $printer->text("Monto pendiente $".$pendiente."\n");
                            $printer->text("Tipo de abono: ".$_POST['tipoTiempo']."\n");
                            $printer->text("Cantidad de abonos: ".$_POST['cantidadTiempo']."\n");
                            $printer->text("Monto a abonar $".$abonoBase."\n");
                            $printer->text("Fecha del primer abono: ".$_POST['primerAbono']."\n");
                            $printer->setJustification(Printer::JUSTIFY_CENTER);
                        }else{//contado
                            $printer->text("Total a pagar ·············· $".$_POST['totalVenta']."\n");
                            $printer->text("Pagó con ··················· $".$_POST['totalPayment']."\n");
                            $printer->text("Cambio ·················· $".$_POST['cambio']."\n");
                        }
                        $printer->feed(2);
                        $printer->setTextSize(1, 2);
                        $printer->text("Gracias por su preferencia!\n");
                        if ($_POST["tipoVenta"] == 0) { //credito
                            $printer->text("--- CUIDE SU CRÉDITO ---\n\n\n\n");
                        }else{//contado

                        }
                        if($contador == 0){
                            $printer->text("- COMPROBANTE ORIGINAL -\n\n");
                            $printer->cut();
                        }else{
                            $printer->text("- COPIA -\n\n");
                            $printer->cut();
                        }
                    }
					$printer->pulse();
					$printer->close();
					Helpers::imprimirMensaje("suceess","Se ha registrado la venta.","crearventa");
            }
            else
            {
                Helpers::imprimirMensaje("error","La venta no se creó.","crearventa");
            }
		}
    }

    public function ctrMostrarCreditos($idCliente)
	{
		$respuesta = ModeloVentas::mdlMostrarCreditos($idCliente);
		return $respuesta;
    }

    public function ctrAbonar($folioVenta,$nuevoSaldo)
	{
        $tabla = "ventas";
        $item="Folio";
		$respuesta = ModeloVentas::mdlAbonar($tabla,$item,$folioVenta,$nuevoSaldo);
		return $respuesta;
    }

    public function ctrMostrarVentas($item,$valor)
    {
        $respuesta = ModeloVentas::mdlMostrarVentas($item,$valor);
        return $respuesta;
    }

     public function ctrMostrarClienteVentas($item,$valor)
    {
        $respuesta = ModeloVentas::mdlMostrarClienteVentas($item,$valor);
        return $respuesta;
    }

    public function ctrMostrarVentasPorFecha($valor1,$valor2)
    {
        $respuesta = ModeloVentas::mdlMostrarVentasPorFecha($valor1,$valor2);
        return $respuesta;
    }
}
?>