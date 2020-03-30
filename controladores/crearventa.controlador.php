<?php

class ControladorVentas
{
    public function ctrCrearVenta()
	{
		if (isset($_POST["nuevaVenta"]))
		{
            include_once "modelos/crearventa.modelo.php";
            include_once "controladores/productos.controlador.php";
            include_once "controladores/helpers.php";
            $tabla = "ventas";
            date_default_timezone_set('America/Hermosillo');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
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
                                "Estado" => 0
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
                                "Estado" => 0
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
                                "Estado" => 0
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
            }else{
                $pendiente = "0";
                $calendarioAbonosFinal = "N";
                $TipoAbono = "N";
            }
            $ModeloCrearventa = new ModeloVentas(NULL, $_POST["nuevaVenta"], $_POST["id_usuario"], $_POST["id_cliente"], $_POST["id_almacen"], $fecha, $hora, $_POST["listaProductos"], $_POST["totalVenta"], $_POST["totalPayment"], $_POST["descuentoTH"], $pendiente, $calendarioAbonosFinal, $TipoAbono, $_POST["tipoVenta"]);

            $respuesta = ModeloVentas::mdlCrearVenta($tabla,$ModeloCrearventa);
            if ($respuesta = "ok")
            {
                Helpers::imprimirMensaje("success","La venta se registró correctamente.","crearventa");
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

}
?>