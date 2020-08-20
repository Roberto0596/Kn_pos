<?php

require_once "../../controladores/compra.controlador.php";
require_once "../../modelos/compra.modelo.php";
require_once "../../controladores/proveedores.controlador.php";
require_once "../../modelos/proveedores.modelo.php";

class TablaProveedorAjax
{
	public function MostrarTabla()
	{
		if (isset($_POST["folio"]))
		{
			$item = "Folio";
			$valor = $_POST["folio"];
			$respuesta = ControladorCompra::ctrMostrarCompras($item,$valor);
			$res = [ "data" => []];
			if ($respuesta != false)
			{
				$listaProductos = json_decode($respuesta["ListaProductos"],true);
				foreach($listaProductos as $key => $value)
				{
					$proveedor = ControladorProveedores::ctrMostrarProveedores("Id_proveedor",$respuesta["Id_proveedor"]);
					array_push($res['data'], [
						($key+1),
						$respuesta["Folio"],
						$proveedor["Nombre"],
						$proveedor["Ejecutivo"],
						$respuesta["Fecha"],
						$value["descripcion"],
						$value["cantidad"],
						$value["precio"],
						$value["total"]
					]);
				}	
			}
			echo json_encode($res);
		}
	}
}

$compras = new TablaProveedorAjax();
$compras->MostrarTabla();