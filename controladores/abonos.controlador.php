<?php
require __DIR__ . '/autoload.php';
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
class ControladorAbonos
{

 	function ctrTraerUltimoFolio()
 	{
 		$tabla = "abonos";
 		$respuesta = ModeloAbonos::mdlTraerUltimoFolio($tabla);
 		return $respuesta["folio_pago"];
	 }

	 function ctrMostrarAbonos($item,$valor)
 	{
 		$tabla = "abonos";
 		$respuesta = ModeloAbonos::mdlMostrarAbonos($tabla,$item,$valor);
 		return $respuesta;
 	}

 	public function ctrRegistrarAbono()
 	{
		if (isset($_POST["folioCompra"]))
		{
			include_once "modelos/abonos.modelo.php";
			include_once "modelos/crearventa.modelo.php";
            include_once "controladores/helpers.php";
			$tabla = "abonos";
			date_default_timezone_set('America/Hermosillo');
			$fechaPago = date('Y-m-d');
			$nuevoSaldo = 0;
			if (!isset($_POST['descuentoP'])) {
				$nuevoSaldo = $_POST["ultimoSaldo"] - $_POST["abono"];
			}

			$ModeloAbono= new ModeloAbonos(NULL, $_POST["folioCompra"], ($this->ctrTraerUltimoFolio()+1), $_POST["fechaVence"], $fechaPago, $_POST["nAbono"], $_POST["abono"], $nuevoSaldo, 1);
			$respuesta = ModeloVentas::mdlAbonar("ventas","Folio",$_POST["folioCompra"],$nuevoSaldo);

			if ($respuesta = "ok")
			{
				$respuesta = ModeloAbonos::mdlRegistrarAbono($tabla,$ModeloAbono);
				if ($respuesta = "ok")
				{
					date_default_timezone_set('America/Hermosillo');
					$fecha = date('Y-m-d');
					$hora = date('H:i:s');
					$fechaActual = $fecha.' '.$hora;
					//print_r($_POST);
					//print_r($ModeloAbono->Id);
					$data = ModeloVentas::mdlMostrarVentas("Folio",$_POST['folioCompra']);
					$cliente = ModeloClientes::mdlMostrarClientes("cliente","id_cliente",$data["Id_cliente"],0);
					$abono = ModeloAbonos::mdlMostrarAbonos("abonos","folio_venta",$data["Folio"]);

					$nombre_impresora = "POS-80";
					$connector = new WindowsPrintConnector($nombre_impresora);
					$printer = new Printer($connector);
					$logo = EscposImage::load(__DIR__ . "/karina.jpg", false);
					for ($contador=0; $contador < 3; $contador++) {
						$printer->setJustification(Printer::JUSTIFY_CENTER);
						$printer->bitImage($logo);
						$printer->setTextSize(1, 2);
						$printer->text("Calle 9 y 10 Avenida 28 Tel: 633-121-0748\n Agua Prieta Son.\n");
						$printer->text("__________________________________________\n");
						$printer->feed();
						$printer->text("Crédito: ".$_POST['folioCompra']."\n");
						$printer->setTextSize(1, 1);
						$printer->feed();
						$printer->text("Ticket #".$abono[count($abono)-1]["folio_pago"] ."    Fecha: ".$fechaActual."\n");
						$printer->text("Cliente: ".$_POST['id_cliente']." - ". $cliente["nombre"] ."\n");
						$printer->text("________________________________________________\n");
						$printer->text("No. pago: ".$_POST['nAbono']."  Fecha de vencimiento: ".$_POST['fechaVence']."\n");
						$printer->text("Abono ······················· $".$abono[count($abono)-1]["cantidad"] ."\n");
						if (isset($_POST['descuentoP'])) {
							$printer->text("Descuento ··················· $".$_POST['descuentoTotal']."\n");
						}else{
							$printer->text("Descuento ··················· $0.00\n");
						}
						$printer->text("________________________________________________\n");
						$printer->text("Total a pagar ·············· $".$_POST['abono']."\n");
						$printer->text("Pagó con ··················· $".$_POST['efectivo']."\n");
						$printer->text("Su cambio ·················· $".$_POST['cambio']."\n");
						$printer->feed(2);
						$printer->text("\n");
						$printer->text("Saldo actual ·········· $".$abono[count($abono)-1]["saldo"]."\n");
						$printer->text("Saldo anterior ········ $".$_POST['ultimoSaldo']."\n");
						$printer->text("Fecha de próximo pago: ".$_POST['fechaProximo']."\n");
						$printer->feed(2);
						$printer->setTextSize(1, 2);
						$printer->text("Gracias por su preferencia!\n");
						$printer->text("--- CUIDE SU CRÉDITO ---\n\n\n\n");

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
					Helpers::imprimirMensaje("suceess","Se abonó correctamente.","abonos");
				}
				else
				{
					Helpers::imprimirMensaje("error","No se pudo crear el abono.","abonos");
				}
			}
			else
			{
				Helpers::imprimirMensaje("error","No se pudo modificar el saldo en la venta.","abonos");
			}
		}

 	}
}



?>