<?php

require_once "../../controladores/crearventa.controlador.php";
require_once "../../modelos/crearventa.modelo.php";
require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

class TablaCreditasVentas
{
	public function MostrarTabla()
	{
		if (isset($_POST["init"]))
		{
			if ($_POST["init"] == null) {
				$respuesta = ControladorVentas::ctrMostrarVentas(null,null);
			} else {
				$valor1 = $_POST["init"];
				$valor2 = $_POST["final"];
				$respuesta = ControladorVentas::ctrMostrarVentasPorFecha($valor1,$valor2);
			}
			
			$res = [ "data" => []];
			if ($respuesta != false)
			{
				foreach($respuesta as $key => $value)
				{
					$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$value["Id_cliente"],0);
					$button = "<div class='btn-group'><button class='btn btn-success verProductos' folio='".$value["Folio"]."' data-toggle='modal' data-target = '#modalLaracast'>Ver productos</button></div>";
					array_push($res['data'], [
						($key+1),
						$value["Folio"],
						$cliente["nombre"],
						$cliente["direccion"],
						$cliente["telefono_celular"],
						$button,
						$value["Fecha"],
						"$".number_format($value["TotalVenta"],2)
					]);
				}
			}
			echo json_encode($res);
		}
	}
}

$compras = new TablaCreditasVentas();
$compras->MostrarTabla();