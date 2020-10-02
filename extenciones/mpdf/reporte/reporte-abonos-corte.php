<?php 

require_once "../../../vendor/autoload.php";
require_once "plantilla.php";
require_once "../../../controladores/abonos.controlador.php";
require_once "../../../modelos/abonos.modelo.php";
require_once "../../../controladores/crearventa.controlador.php";
require_once "../../../modelos/crearventa.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
// error_reporting(0);

class printReport
{
	public $tipo;
	public $fecha;

	public function print()
	{
		$array = $this->MostrarTabla();
		$mpdf = new \Mpdf\Mpdf();
		$plantilla = getPlantilla($this->tipo, $array);

		$mpdf->writeHtml($plantilla,\Mpdf\HTMLParserMode::HTML_BODY);

		$mpdf->Output();
	}

	public function MostrarTabla()
	{
		$res = [];
		if ($this->fecha == null)
		{
			date_default_timezone_set('America/Hermosillo');
			$fecha = date("Y-m-d");
			$item = "fecha_pago";
			$respuesta = ControladorAbonos::ctrMostrarAbonos($item,$fecha);
		}
		else
		{
			$fechas = explode("|", $this->fecha);
			if (count($fechas)==2) {
				$respuesta = ModeloAbonos::mdlMostrarAbonosPorFecha($fechas[0],$fechas[1]);
			}else{
				$respuesta = ModeloAbonos::mdlMostrarAbonosPorFecha(null,$fechas[0]);
			}				
		}
		foreach ($respuesta as $key => $value) 
		{
			$venta = ControladorVentas::ctrMostrarVentas("Folio",$value["folio_venta"]);

			$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$venta["Id_cliente"],null);

			array_push($res, [
				"#" => ($key+1),
				"Folio Venta" => $value["folio_venta"],
				"Nombre" => $cliente["nombre"],
				"Direccion" => $cliente["direccion"]!=null?$cliente["direccion"]:"N/A",
				"Telefono" => $cliente["telefono_casa"]!=null?$cliente["telefono_casa"]:"N/A",
				"F. de pago" => $value["fecha_pago"],
				"Cantidad" => "$".number_format($value["cantidad"],2),
				"Saldo" =>"$".number_format($value["saldo"],2)
			]);
		}
		return $res;		
	}

}

$receta = new printReport();
$receta -> tipo = $_GET["tipo"];
$receta -> fecha = $_GET["fecha"];
$receta -> print();

?>