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
		if ($this->init == "null") {
			$respuesta = ControladorVentas::ctrMostrarVentas(null,null);
		} else {
			$valor1 = $this->init;
			$valor2 = $this->init;
			$respuesta = ControladorVentas::ctrMostrarVentasPorFecha($valor1,$valor2);
		}
		
		$res = [];
		if ($respuesta != false)
		{
			foreach($respuesta as $key => $value)
			{
				$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$value["Id_cliente"],0);

				array_push($res, [
					"#" => ($key+1),
					"Folio" => $value["Folio"],
					"Nombre" => $cliente["nombre"],
					"Direccion" => $cliente["direccion"],
					"Telefono" => $cliente["telefono_celular"],
					"Fecha" => $value["Fecha"],
					"Total" => "$".number_format($value["TotalVenta"],2)
				]);
			}
		}
		return $res;
	}

}

$receta = new printReport();
$receta -> tipo = $_GET["tipo"];
$receta -> init = $_GET["init"];
$receta -> finald = $_GET["final"];
$receta -> print();
