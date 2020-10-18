<?php 

require_once "../../../vendor/autoload.php";
require_once "plantilla.php";
require_once "../../../controladores/abonos.controlador.php";
require_once "../../../modelos/abonos.modelo.php";
require_once "../../../controladores/crearventa.controlador.php";
require_once "../../../modelos/crearventa.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
error_reporting(0);

class printReport
{
	public $tipo;
	public $fecha;

	public function print()
	{
		$array = $this->MostrarTabla($this->fecha);
		$mpdf = new \Mpdf\Mpdf();
		$plantilla = getPlantilla($this->tipo, $array);

		$mpdf->writeHtml($plantilla,\Mpdf\HTMLParserMode::HTML_BODY);

		$mpdf->Output();
	}

	public function MostrarTabla($fecha)
	{
		$res = ["res"=>[], "totals" => []];
		$data = [];
		if ($fecha == "null")
		{
			date_default_timezone_set('America/Hermosillo');
			$fecha = date("Y-m-d");
			$item = "fecha_pago";
			$respuesta = ControladorAbonos::ctrMostrarAbonos($item,$fecha);
			$folios = ModeloAbonos::getAbonosAgrupadosIndividial($fecha);
		}
		else
		{
			$fechas = explode("|", $this->fecha);
			if (count($fechas)==2) {
				$respuesta = ModeloAbonos::mdlMostrarAbonosPorFecha($fechas[0],$fechas[1]);
				$folios = ModeloAbonos::getAbonosAgrupados($fechas[0],$fechas[1]);	
			}else{
				$respuesta = ModeloAbonos::mdlMostrarAbonosPorFecha(null,$fechas[0]);
				$folios = ModeloAbonos::getAbonosAgrupados(null,$fechas[0]);
			}			
		}
		$total = 0;
		$saldo = 0;
		//sumar totales
		foreach ($folios as $key => $value) {
			$r = ModeloAbonos::getUltimoAbonoPorfolio($value["folio_venta"]);
			// var_dump($r);
			$saldo = $saldo + $r["saldo"];
		}

		foreach ($respuesta as $key => $value) 
		{
			$venta = ControladorVentas::ctrMostrarVentas("Folio",$value["folio_venta"]);

			$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$venta["Id_cliente"],null);
			$total = $total + $value["cantidad"];
			array_push($res["res"], [
				"Folio Venta" => $value["folio_venta"],
				"F. de pago" => $value["fecha_pago"],
				"# Cliente" => $cliente["id_cliente"],
				"Nombre" => $cliente["nombre"],
				"Saldo" =>"$".number_format($value["saldo"],2),
				"Abono" => "$".number_format($value["cantidad"],2)
			]);
		}
		array_push($res["totals"], ["Total saldo" => $saldo, "Total Abono" => $total]);
		return $res;		
	}

}

$receta = new printReport();
$receta -> tipo = $_GET["tipo"];
$receta -> fecha = $_GET["fecha"];
$receta -> print();

?>