<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

require_once "../controladores/crearventa.controlador.php";
require_once "../modelos/crearventa.modelo.php";

class AjaxComprasClientes
{
	public $idCliente;

	public function ajaxTraerCreditos()
	{
		$valor = $this->idCliente;
		$respuesta = ControladorVentas::ctrMostrarCreditos($valor);
		echo json_encode($respuesta);
	}
	public function ajaxTraerCliente()
	{
		$valor = $this->idCliente;
		$item = "id_cliente";
		$respuesta = ControladorClientes::ctrMostrarClientes($item,$valor,null);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["id_cliente"]))
{
	$verificar = new AjaxComprasClientes();
	$verificar->idCliente = $_POST["id_cliente"];
	$verificar->ajaxTraerCreditos();
}

if(isset($_POST["traerCliente"]))
{
	$verificar = new AjaxComprasClientes();
	$verificar->idCliente = $_POST["traerCliente"];
	$verificar->ajaxTraerCliente();
}