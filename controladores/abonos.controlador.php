<?php
require __DIR__ . '/autoload.php';
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;
class ControladorAbonos
{
	public $abonosDados = array(array("fechaVence", "Cantidad"));

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

	public function ctrAbonar($modeloVentas, $abonoT, $fecha, $folio){
		//print_r($modeloVentas);
		$calendarioAbonos = json_decode($modeloVentas['CalendarioAbonos']);
		// Estado 0: Activo, 1: Modificado, 2: Liquidado

        foreach ($calendarioAbonos as $numero => $valor) {
			if($abonoT == 0){
				if($calendarioAbonos[$numero]->Cantidad == 0){
					array_push($this->abonosDados, array($calendarioAbonos[$numero]->Fecha, $calendarioAbonos[$numero]->Abono));
				}else{
					array_push($this->abonosDados, array($calendarioAbonos[$numero-1]->Fecha, $calendarioAbonos[$numero-1]->Abono));
				}
				break;
			}

			if($calendarioAbonos[$numero]->Estado == 0 || $calendarioAbonos[$numero]->Estado == 1){
				$abonoT = round($abonoT, 2);
				$diferencia = $abonoT - $calendarioAbonos[$numero]->Abono;
				$diferencia = round($diferencia, 2);
				if($diferencia == 0){
					array_push($this->abonosDados, array($calendarioAbonos[$numero]->Fecha, $calendarioAbonos[$numero]->Abono));

					$calendarioAbonos[$numero]->Cantidad = $calendarioAbonos[$numero]->Abono;
					$calendarioAbonos[$numero]->Abono = 0;
					$calendarioAbonos[$numero]->Estado = 2;
					$abonoT = 0;

				}elseif($diferencia < 0){
					array_push($this->abonosDados, array($calendarioAbonos[$numero]->Fecha, $abonoT));
					$calendarioAbonos[$numero]->Cantidad = $abonoT;
					$calendarioAbonos[$numero]->Abono = $calendarioAbonos[$numero]->Abono - $abonoT;
					$calendarioAbonos[$numero]->Estado = 1;
					$abonoT = 0;
				}else{
					array_push($this->abonosDados, array($calendarioAbonos[$numero]->Fecha, $calendarioAbonos[$numero]->Abono));
					if($calendarioAbonos[$numero]->Estado == 1){
						$calendarioAbonos[$numero]->Cantidad = $calendarioAbonos[$numero]->Abono + $calendarioAbonos[$numero]->Cantidad;
					}else{
						$calendarioAbonos[$numero]->Cantidad = $calendarioAbonos[$numero]->Abono;
					}

					$calendarioAbonos[$numero]->Abono = 0;
					$calendarioAbonos[$numero]->Estado = 2;
					$abonoT = $diferencia;
				}
				$calendarioAbonos[$numero]->FechaPago = $fecha;
				if($calendarioAbonos[$numero]->Folio == "0"){
					$calendarioAbonos[$numero]->Folio = $folio;
				}else{
					$calendarioAbonos[$numero]->Folio = $calendarioAbonos[$numero]->Folio.",".$folio;
				}

			}
		}
		return json_encode($calendarioAbonos);
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
					$nuevoCalendario = $this->ctrAbonar($data, $_POST["abono"], $fechaPago,$abono[count($abono)-1]["folio_pago"]);
					$modiVent = ModeloVentas::mdlMCalendario("Folio",$_POST["folioCompra"],$nuevoCalendario);

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
						$ultimaL = 0;
						foreach ($this->abonosDados as $numero => $valor) {
							if($numero > 0){
								if($numero == count($this->abonosDados)-1){
									$ultimaL = $numero;
									break;
								}
								$printer->text("Fecha abonada: ".$valor[0]." Cantidad $".$valor[1]."\n");
							}
                        }
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
						$printer->text("Fecha de próximo pago: ".$this->abonosDados[$ultimaL][1]."\n");
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