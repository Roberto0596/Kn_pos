<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos
{
	public $idProducto;

	public function ajaxEditarProducto()
	{
		$item = "Id_producto";
		$valor = $this->idProducto;
		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
		echo json_encode($respuesta);
	}

	public $idProductoVenta;

	public function ajaxVerProducto()
	{
		$item = "Id_producto";
		$valor = $this->idProductoVenta;
		$respuesta = ControladorProductos::ctrMostrarProductos($item,$valor);
		if ($respuesta)
		{
			echo json_encode($respuesta);
		}
		else
		{
			echo json_encode("error");
		}
	}

	public $data_library;

	public function ajaxCrearProducto()
	{
		$listaDatos = json_decode($this->data_library, true);
		$ModeloProductos = new ModeloProductos(NULL, $listaDatos[0]["codigo"], $listaDatos[0]["nombre"], $listaDatos[0]["precio_compra"], $listaDatos[0]["precio_venta"],$listaDatos[0]["idProveedor"], $listaDatos[0]["stock"], 0, "1");
		$respuesta = ModeloProductos::mdlCrearProducto("productos",$ModeloProductos);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["idProducto"]))
{
	$editar = new AjaxProductos();
	$editar->idProducto = $_POST["idProducto"];
	$editar->ajaxEditarProducto();
}

if (isset($_POST["idProductoVenta"]))
{
	$validar = new AjaxProductos();
	$validar -> idProductoVenta = $_POST["idProductoVenta"];
	$validar -> ajaxVerProducto();
}

if(isset($_POST["data_library"]))
{
	$crear = new AjaxProductos();
	$crear -> data_library = $_POST["data_library"];
	$crear -> ajaxCrearProducto();
}



