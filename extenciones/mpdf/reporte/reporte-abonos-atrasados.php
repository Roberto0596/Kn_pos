<?php 
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/crearventa.controlador.php";
require_once "../../../modelos/crearventa.modelo.php";
require_once "../../../controladores/abonos.controlador.php";
require_once "../../../modelos/abonos.modelo.php";
require_once "plantilla.php";
require_once "../../../vendor/autoload.php";

class printReport
{
	public $tipo;
	public $init;
	public $finald;

	public function print()
	{
		$array = $this->mostrarTabla();
		$mpdf = new \Mpdf\Mpdf();
		$plantilla = getPlantilla($this->tipo, $array);

		$mpdf->writeHtml($plantilla,\Mpdf\HTMLParserMode::HTML_BODY);

		$mpdf->Output();
	}

	public function mostrarTabla()
	{
		$ventas = ControladorVentas::ctrMostrarVentasCredito(null,null,0);
		$res = [];
		$count;
		foreach ($ventas as $key1 => $value)
		{
			try {
				$cliente = ControladorClientes::ctrMostrarClientes("id_cliente", $value["Id_cliente"], null);	
				$abono = ControladorAbonos::ctrUltimoAbono("folio_venta", $value["Folio"]);	
				$calendario = json_decode($value["CalendarioAbonos"],true);
				$anotherDate = [];
				foreach ($calendario as $key => $value2) {
					if ($value2["Estado"] == 0) {
						$anotherDate = $value2;
						break;
					}
				}

				$proximoAbono = $anotherDate["Fecha"];
				date_default_timezone_set('America/Hermosillo');
				$fecha = date('Y-m-d');
				if ($fecha > $proximoAbono) {
					array_push($res, [
						"#" => ($key+1),
						"Nombre" => $cliente["nombre"],
						"Folio" => $value["Folio"],
						"Abono" => $anotherDate["Abono"],
						"Prox. abono" => $proximoAbono,
						"Fecha" => $fecha,
						"Prox. fecha" => $calendario[$key+1]["Fecha"],
					]);
				}
			} catch(Exception $e) {
				array_push($res, []);
			}									
		}
		return $res;
	}

}

$receta = new printReport();
$receta -> tipo = $_GET["tipo"];
$receta -> print();
