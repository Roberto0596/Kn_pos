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
		$res = ["res" => [], "totals" => []];
		$count;
		$total = 0;
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
					$total = $total + $anotherDate["Abono"];
					array_push($res["res"], [
						"Folio" => $value["Folio"],
						"# Cliente" => $cliente["id_cliente"],
						"Nombre" => $cliente["nombre"],
						"Direccion" => $cliente["direccion"],
						"Numero" => $cliente["telefono_celular"],
						"Credito" => "$".number_format($abono["saldo"],2),	
						"F. Vencimiento" => $proximoAbono,
						"Total" => "$".number_format($anotherDate["Abono"],2)
					]);
				}
			} catch(Exception $e) {
				array_push($res["res"], []);
			}									
		}
		array_push($res["totals"], ["Total Abonos" => $total]);
		return $res;
	}

}

$receta = new printReport();
$receta -> tipo = $_GET["tipo"];
$receta -> print();
