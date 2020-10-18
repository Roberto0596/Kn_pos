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
	public $folio;

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
		$item = "Folio";
		$valor = $this->folio;
		$respuesta = ControladorCompra::ctrMostrarCompras($item,$valor);
		if ($respuesta != false)
		{
			$total = 0;
			$listaProductos = json_decode($respuesta["ListaProductos"],true);
			foreach($listaProductos as $key => $value)
			{
				$total = $total + $value["total"];
				$proveedor = ControladorProveedores::ctrMostrarProveedores("Id_proveedor",$respuesta["Id_proveedor"]);
				array_push($res['res'], [
					"Folio" => $respuesta["Folio"],
					"Nombre" => $proveedor["Nombre"],
					"Ejecutivo" => $proveedor["Ejecutivo"],
					"Fecha" => $respuesta["Fecha"],
					"Descripcion" => $value["descripcion"],
					"Cantidad" => $value["cantidad"],
					"Precio" => "$".number_format($value["precio"],2),
					"Total" => "$".number_format($value["total"],2)
				]);
			}	
		}
		array_push($res["totals"], ["Total" => $total]);
		return $res;
	}
}

$receta = new printReport();
$receta -> tipo = $_GET["tipo"];
$receta -> folio = $_GET["folio"];
$receta -> print();
