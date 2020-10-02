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

		$res = [];

		foreach($respuesta as $key => $value)
		{		
			$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$value["Id_cliente"],0);


			array_push($res, [
				"#" => ($key+1),
				"Folio" => $value["Folio"],
				"Nombre" => $cliente["nombre"],
				"Direccion" => $cliente["direccion"]!=null?$cliente["direccion"]:"N/A",
				"Telfono" => $cliente["telefono_casa"]!=null?$cliente["telefono_casa"]:"N/A",
				"Fecha" => $value["Fecha"].$value["Hora"],
				"Total" => "$".number_format($value["TotalVenta"],2),
			]);
		}	
		return $res;
	}

}

$receta = new printReport();
$receta -> tipo = $_GET["tipo"];
$receta -> rango = $_GET["rango"];
$receta -> print();
