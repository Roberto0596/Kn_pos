<?php 

require_once "../../../vendor/autoload.php";
require_once "plantilla.php";
require_once "../../../controladores/abonos.controlador.php";
require_once "../../../modelos/abonos.modelo.php";
require_once "../../../controladores/crearventa.controlador.php";
require_once "../../../modelos/crearventa.modelo.php";
// error_reporting(0);

class printReport
{
	public $tipo;
	public $folio;

	public function print()
	{
		$array = $this->abonosPorClientes();
		$mpdf = new \Mpdf\Mpdf();
		$plantilla = getPlantilla($this->tipo, $array);

		$mpdf->writeHtml($plantilla,\Mpdf\HTMLParserMode::HTML_BODY);

		$mpdf->Output();
	}

	public function abonosPorClientes()
	{
		$item = "folio_venta";
		$valor = $this->folio;
		$respuesta = ControladorAbonos::ctrMostrarAbonos($item,$valor);
		$res = [];
		if ($respuesta != false)
		{
			foreach($respuesta as $key => $value)
			{		
				$venta = ControladorVentas::ctrMostrarVentas("Folio",$value["folio_venta"]);	

				$calendario = json_decode($venta["CalendarioAbonos"],true);

				array_push($res, [
					"#" => ($key+1),
					"Folio venta" => $value["folio_venta"],
					"Folio pago" => $value["folio_pago"],
					"Fecha de vencida" => $value["fecha_vencimiento"],
					"Fecha de pago" => $value["fecha_pago"],
					"Fecha Prox. pago" => $calendario[($value["numero_abono"]+1)]["Fecha"],
					"cantidad" => $value["cantidad"],
					"Saldo" => $value["saldo"],
				]);
			}	
		}
		return $res;
	}

}

$receta = new printReport();
$receta -> tipo = $_GET["tipo"];
$receta -> folio = $_GET["folio"];
$receta -> print();

?>