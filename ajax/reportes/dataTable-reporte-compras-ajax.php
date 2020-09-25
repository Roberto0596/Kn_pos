<?php

require_once "../../controladores/compra.controlador.php";
require_once "../../modelos/compra.modelo.php";
require_once "../../controladores/proveedores.controlador.php";
require_once "../../modelos/proveedores.modelo.php";

class TablaProveedorAjax
{
	public function MostrarTabla()
	{
		if (isset($_POST["init"]))
		{
			if ($_POST["init"] == null) {
				$respuesta = ControladorCompra::ctrMostrarCompras(null,null);
			} else {
				$valor1 = $_POST["init"];
				$valor2 = $_POST["final"];
				$respuesta = ControladorCompra::ctrMostrarComprasPorFecha(null,$valor1,$valor2);
			}
			
			$res = [ "data" => []];
			if ($respuesta != false)
			{
				foreach($respuesta as $key => $value)
				{
					$proveedor = ControladorProveedores::ctrMostrarProveedores("Id_proveedor",$value["Id_proveedor"]);

					array_push($res['data'], [
						($key+1),
						$value["Folio"],
						$proveedor["Nombre"],
						$proveedor["Ejecutivo"],
						$value["Fecha"],
						"$".number_format($value["TotalVenta"],2)
					]);
				}
			}
			echo json_encode($res);
		}
	}
}

$compras = new TablaProveedorAjax();
$compras->MostrarTabla();