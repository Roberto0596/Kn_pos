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
			print_r($_POST);
			$ModeloAbono= new ModeloAbonos(NULL, $_POST["folioCompra"], ($this->ctrTraerUltimoFolio()+1), $_POST["fechaVence"], $fechaPago, $_POST["nAbono"], $_POST["abono"], $nuevoSaldo, 1);
			$respuesta = ModeloVentas::mdlAbonar("ventas","Folio",$_POST["folioCompra"],$nuevoSaldo);

			if ($respuesta = "ok")
			{
				$respuesta = ModeloAbonos::mdlRegistrarAbono($tabla,$ModeloAbono);
				if ($respuesta = "ok")
				{
					// registrar fecha para saber ultimo loguin
					date_default_timezone_set('America/Hermosillo');
					$fecha = date('Y-m-d');
					$hora = date('H:i:s');
					$fechaActual = $fecha.' '.$hora;

					$data = ModeloVentas::mdlMostrarVentas("Folio",$code);
					$cliente = ModeloClientes::mdlMostrarClientes("cliente","id_cliente",$data["Id_cliente"],0);
					$abono = ModeloAbonos::mdlMostrarAbonos("abonos","folio_venta",$data["Folio"]);

					$nombre_impresora = "POS-80";
					$connector = new WindowsPrintConnector($nombre_impresora);
					$printer = new Printer($connector);
					$printer->setJustification(Printer::JUSTIFY_CENTER);

					$logo = EscposImage::load("Karina.jpg", false);
					$printer->bitImage($logo);

					$printer->setTextSize(1, 2);
					$printer->text("Calle 10 Avenida 28 Tel: 633-121-0748\n Agua Prieta Son.\n");
					$printer->text("______________________________________\n");
					$printer->feed();
					$printer->setTextSize(1, 1);
					$printer->feed();
					$printer->text("No. Cliente: 24          Fecha: ".$fechaActual."\n");
					$printer->text("Credito: 2\n");
					$printer->text("Cliente: Diana Luara Lopez B". $cliente["nombre"] .".\n");
					$printer->text("______________________________________\n");
					$printer->text("No. pago: 4     Fecha: 23/01/2020\n");
					$printer->text("Abono________________________$".$abono[count($abono)-1]["cantidad"] ."\n");
					$printer->text("Intereses_____________________$0.00\n");
					$printer->text("Descuento_____________________$0.00\n");
					$printer->text("______________________________________\n");
					$printer->text("Total a pagar_________________$200.00\n");
					$printer->feed();
					$printer->text("Saldo actual___________$".$abono[count($abono)-1]["saldo"]."\n");
					$printer->text("Saldo anterior___________$".$abono[count($abono)-1]["saldo"] + $abono[count($abono)-1]["cantidad"]."\n");
					
					$printer->text("Proximo pago :23/02/2020\n");
					$printer->feed();
					$printer->setTextSize(1, 2);
					$printer->text("Gracias por su preferencia\n");
					$printer->text("---CUIDE SU CREDITO---");

					$printer->feed(3);
					$printer->cut();
					$printer->pulse();
					$printer->close();
					Helpers::imprimirMensaje("suceess","todo bien","abonos");
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