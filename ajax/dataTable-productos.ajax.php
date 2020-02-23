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
			$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["Id_producto"]."' data-toggle = 'modal' data-target = '#modalEditarProducto' title='Editar'><i class='fas fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["Id_producto"]."' title='Eliminar'><i class='fa fa-trash'></i></button>";
			$stock =  "<button class='btn btn-info btnAumentarStock' idProducto='".$productos[$i]["Id_producto"]."' data-toggle = 'modal' data-target = '#modalAumentarStock' title='Aumentar stock'><i class='fa fa-plus'></i></button><button class='btn btn-secondary btnDisminuirStock' idProducto='".$productos[$i]["Id_producto"]."' data-toggle = 'modal' data-target = '#modalDisminuirStock' title='Disminuir stock'><i class='fa fa-minus'></i></button></div>";

			$datosJson .='[
					"'.($i+1).'",
					"'.$productos[$i]["Codigo"].'",
					"'.$productos[$i]["Nombre"].'",
					"'.$productos[$i]["Precio_compra"].'",
					"'.$productos[$i]["Precio_venta"].'",
					"'.$productos[$i]["NombreProv"].'",
					"'.$productos[$i]["Stock"].'",
					"'.$productos[$i]["Ventas"].'",
					"'.$botones.$stock.'"
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