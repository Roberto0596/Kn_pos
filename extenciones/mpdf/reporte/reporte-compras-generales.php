<?php 
require_once "../../../controladores/compra.controlador.php";
require_once "../../../modelos/compra.modelo.php";
require_once "../../../controladores/proveedores.controlador.php";
require_once "../../../modelos/proveedores.modelo.php";

require_once "../../../vendor/autoload.php";
require_once "plantilla.php";

class printReport
{
	public $tipo;
	public $init;
	public $final;

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
		if ($this->init == null) {
			$respuesta = ControladorCompra::ctrMostrarCompras(null,null);
		} else {
			$valor1 = $this->init;
			$valor2 = $this->final;
			$respuesta = ControladorCompra::ctrMostrarComprasPorFecha(null,$valor1,$valor2);
		}
		
		$res = [ "res" => [], "totals" => []];
		$total = 0;
		if ($respuesta != false)
		{
			foreach($respuesta as $key => $value)
			{
				$total = $total + $value["TotalVenta"];
				$proveedor = ControladorProveedores::ctrMostrarProveedores("Id_proveedor",$value["Id_proveedor"]);

				array_push($res['res'], [
					"Folio" => $value["Folio"],
					"Nombre" => $proveedor["Nombre"],
					"Ejecutivo" => $proveedor["Ejecutivo"],
					"Fecha" => $value["Fecha"],
					"Total" => "$".number_format($value["TotalVenta"],2)
				]);
			}
			array_push($res["totals"], ["Total" => $total]);
		}
		return $res;
		
	}
}

$receta = new printReport();
$receta->tipo = $_GET["tipo"];
$receta->init = $_GET["init"];
$receta->final = $_GET["final"];
$receta -> print();
