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
			$onclick = 'printBarcode('.$productos[$i]["Codigo"].')';
			$botones =  "<div class='btn-group'><button class='btn btn-primary' onClick='".$onclick."' title='Imprimir codigo'><i class='fa fa-barcode'></i></button><button class='btn btn-success btnAumentarStock' idProducto='".$productos[$i]["Id_producto"]."' data-toggle = 'modal' data-target = '#modalAumentarStock' title='Aumentar stock'><i class='fa fa-plus'></i></button><button class='btn btn-secondary btnDisminuirStock' idProducto='".$productos[$i]["Id_producto"]."' data-toggle = 'modal' data-target = '#modalDisminuirStock' title='Disminuir stock'><i class='fa fa-minus'></i></button><button class='btn btn-warning btnEditarProducto' idProducto='".$productos[$i]["Id_producto"]."' data-toggle = 'modal' data-target = '#modalEditarProducto' title='Editar'><i class='fas fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarProducto' idProducto='".$productos[$i]["Id_producto"]."' title='Eliminar'><i class='fa fa-trash'></i></button></div>";
	
			$datosJson .='[
					"'.($i+1).'",
					"'.$productos[$i]["Codigo"].'",
					"'.$productos[$i]["Nombre"].'",
					"'.$productos[$i]["Precio_compra"].'",
					"'.$productos[$i]["Precio_venta"].'",
					"'.$productos[$i]["NombreProv"].'",
					"'.$productos[$i]["Stock"].'",
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