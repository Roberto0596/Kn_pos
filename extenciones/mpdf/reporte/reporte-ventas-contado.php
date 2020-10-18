<?php 
require_once "../../../controladores/clientes.controlador.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../controladores/crearventa.controlador.php";
require_once "../../../modelos/crearventa.modelo.php";
require_once "../../../vendor/autoload.php";
require_once "plantilla.php";

class printReport
{
	public $tipo;
	public $rango;

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
		if ($this->rango == "null")
		{
			$respuesta = ModeloVentas::mdlMostrarVentasContado();		
		}
		else
		{
			$fechas = explode("|", $this->rango);
			$valor1 = $fechas[0];
			$valor2=$fechas[1];
			$respuesta = ModeloVentas::mdlMostrarVentasContadoPorFecha($valor1,$valor2);
		}
		$total = 0;
		foreach($respuesta as $key => $value)
		{	
			$total = $total + $value["TotalVenta"];
			$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$value["Id_cliente"],0);


			array_push($res["res"], [
				"Folio" => $value["Folio"],
				"# Cliente" => $cliente["id_cliente"],
				"Nombre" => $cliente["nombre"],
				"Direccion" => $cliente["direccion"]!=null?$cliente["direccion"]:"N/A",
				"Telefono" => $cliente["telefono_casa"]!=null?$cliente["telefono_casa"]:"N/A",
				"Fecha" => $value["Fecha"],
				"Total" => "$".number_format($value["TotalVenta"],2),
			]);
		}
		array_push($res["totals"], ["Total" => $total]);	
		return $res;
	}

}

$receta = new printReport();
$receta -> tipo = $_GET["tipo"];
$receta -> rango = $_GET["rango"];
$receta -> print();
