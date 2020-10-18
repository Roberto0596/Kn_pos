<?php 
require_once "../../../controladores/crearventa.controlador.php";
require_once "../../../modelos/crearventa.modelo.php";
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
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
		$res = ["res"=>[], "totals" => []];
		if ($this->init == "null") {
			$respuesta = ControladorVentas::ctrMostrarVentas(null,null);
		} else {
			$valor1 = $this->init;
			$valor2 = $this->init;
			$respuesta = ControladorVentas::ctrMostrarVentasPorFecha($valor1,$valor2);
		}

		if ($respuesta != false)
		{
			$enganche = 0;
			foreach($respuesta as $key => $value)
			{
				$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$value["Id_cliente"],0);
				if ($value["TotalPago"] != "") {
					$enganche = $enganche + intval($value["TotalPago"]);
				}	var_dump($cliente["telefono_celular"]);
				
				array_push($res["res"], [
					"Folio" => $value["Folio"],
					"CR" => $value["FolioFact"] != null ? $value["FolioFact"] : "N/A",
					"Nombre" => $cliente["nombre"],
					"Direccion" => $cliente["direccion"],
					"Telefono" => $cliente["telefono_celular"] != "" ?  $cliente["telefono_celular"] : "N/A",
					"Enganche" => $value["TotalPago"] != "" ? $value["TotalPago"] : "N/A",
					"Total" => "$".number_format($value["TotalVenta"],2)
				]);
			}
			array_push($res["totals"], ["Total Enganche" => $enganche]);
		}
		return $res;
	}

}

$receta = new printReport();
$receta -> tipo = $_GET["tipo"];
$receta -> init = $_GET["init"];
$receta -> finald = $_GET["final"];
$receta -> print();
