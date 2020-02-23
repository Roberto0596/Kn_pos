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



