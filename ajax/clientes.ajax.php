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
	public  $nombre;

	public function ajaxValidadCliente()
	{
		$item1 = "telefono_celular";
		$valor1 = $this->telefono;
		$item2 = "nombre";
		$valor2 = $this->nombre;
		$respuesta = ControladorClientes::ctrValidarCliente($item1, $valor1,$item2, $valor2,0);
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
	$valUsuario -> nombre = $_POST["nombre"];
	$valUsuario -> ajaxValidadCliente();
}
