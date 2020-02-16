<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class AjaxProductos
{
	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	public $idProducto;

	public function ajaxEditarProducto()
	{

		$item = "Id_producto";
		$valor = $this->idProducto;
		$respuesta = ControladorProductos::ctrMostrarProductos($item, $valor);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["idProducto"]))
{

	$editar = new AjaxProductos();
	$editar->idProducto = $_POST["idProducto"];
	$editar->ajaxEditarProducto();

}



