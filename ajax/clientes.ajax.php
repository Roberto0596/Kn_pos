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

	public  $telefono;
	
	public function ajaxValidadCliente()
	{
		$item = "telefono_celular";
		$valor = $this->telefono;
		$respuesta = ControladorClientes::ctrValidarCliente($item, $valor,0);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["idCliente"]))
{
	$editar = new AjaxClientes();
	$editar -> idCliente = $_POST["idCliente"];
	$editar -> ajaxEditarCliente();
}

if (isset($_POST["telefono"]))
{
	$valUsuario = new AjaxClientes();
	$valUsuario -> telefono = $_POST["telefono"];
	$valUsuario -> ajaxValidadCliente();
}
