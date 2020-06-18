<?php 
require __DIR__ . '/autoload.php';
use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

class Helpers
{
	public function ctrCrearImagen($foto,$id,$folder,$nuevoAncho,$nuevoAlto)
	{
		$ruta;
		list($ancho,$alto) = getimagesize($foto["tmp_name"]);
		mkdir("vistas/img/".$folder."/".$id,0755);	
		if ($foto["type"] == "image/jpeg")
		{
			$aleatorio = mt_rand(100,999);
			$ruta = "vistas/img/".$folder."/".$id."/".$aleatorio.".jpg";
			$origen = imagecreatefromjpeg($foto["tmp_name"]);
			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			imagejpeg($destino,$ruta);
		}
		if ($foto["type"] == "image/png")
		{
			$aleatorio = mt_rand(100,999);
			$ruta = "vistas/img/".$folder."/".$id."/".$aleatorio.".png";
			$origen = imagecreatefrompng($foto["tmp_name"]);
			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			imagepng($destino,$ruta);
		}
		return $ruta;
	}

	public function eliminarImagen($value,$folder,$foto)
	{
		unlink($foto);
		rmdir('vistas/img/'.$folder.'/'.$value);
	}

	public function imprimirMensaje($validador,$mensaje,$destino)
 	{
		echo 
		'<script>
		swal.fire({
			type: "'.$validador.'",
			title: "'.$mensaje.'",
			showConfirmButton: true,
			confirmButtonText: "cerrar",
			closeOnConfirm: false
			}).then((result)=>
		    {
				if(result.value)
				{
					window.location="'.$destino.'";
				}
		    })
		</script>'; 	
 	}

 	public function NuevoFolio($flag)
    {
    	if ($flag == "venta")
    	{
    		$respuesta = ModeloVentas::mdlNuevoFolio();
			return $respuesta;
    	}
    	else if($flag == "compra")
    	{
    		$respuesta = ModeloCompras::mdlNuevoFolio();
			return $respuesta;
    	}
    }

    public function imprimirTicketAbono($code)
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

		return "ok";
    }
}