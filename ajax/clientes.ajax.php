<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxClientes
{
	public $idCliente;
	public function ajaxEditarCliente()
	{
		$item = "id_cliente";
		$valor = $this->idCliente;
		$respuesta = ControladorClientes::ctrMostrarClientes($item,$valor,null);
		echo json_encode($respuesta);
	}

	public  $validarUsuario;
	public function ajaxValidarUsuario()
	{
		$item = "usuario";
		$valor = $this->validarUsuario;
		$respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["idCliente"]))
{
	$editar = new AjaxClientes();
	$editar -> idCliente = $_POST["idCliente"];
	$editar -> ajaxEditarCliente();
}

if (isset($_POST["validarUsuario"]))
{
	$valUsuario = new AjaxClientes();
	$valUsuario -> validarUsuario = $_POST["validarUsuario"];
	$valUsuario -> ajaxValidarUsuario();
}
