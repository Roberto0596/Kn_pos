<?php

require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";

class Ajax
{
	public $data_library;

	public function ajaxCrearProducto()
	{

		$item = "id_almacen";
		$valor = $this->idAlmacen;
		$respuesta = ControladorAlmacen::ctrMostrarAlmacen($item, $valor);
		echo json_encode($respuesta);
	}

}

if(isset($_POST["data_library"]))
{
	$crear = new Ajax();
	$crear -> data_library = $_POST["data_library"];
	$crear -> ajaxCrearProducto();
}

