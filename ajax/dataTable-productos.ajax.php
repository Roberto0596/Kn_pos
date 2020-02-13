<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class TablaProductos
{
	public function mostrarTablaProductos()
	{
	    $productos = ControladorProductos::ctrMostrarProductosT();
		if(count($productos) == 0)
		{
			echo '{"data": []}';
			return;
	  	}

		$datosJson = '{
			"data": [';

		for($i = 0; $i < count($productos); $i++)
		{
			$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["Id_producto"]."' data-toggle = 'modal' data-target = '#modalEditarProducto'><i class='fas fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["Id_producto"]."'><i class='fa fa-trash'></i></button></div>";

			$datosJson .='[
					"'.($i+1).'",
					"'.$productos[$i]["Codigo"].'",
					"'.$productos[$i]["Nombre"].'",
					"'.$productos[$i]["Precio_compra"].'",
					"'.$productos[$i]["Precio_venta"].'",
					"'.$productos[$i]["NombreProv"].'",
					"'.$botones.'"
				],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .=   ']

			}';

		echo $datosJson;
	}
}
$activar = new TablaProductos();
$activar -> mostrarTablaProductos();