<?php

require_once "../controladores/solicitud.controlador.php";
require_once "../modelos/solicitud.modelo.php";

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxSolicitud
{
	public $idSolicitud;

	public function ajaxTraerSolicitud()
	{
		$item = "id_solicitud";
		$valor = $this->idSolicitud;
		$respuesta = ControladorSolicitud::ctrMostrarSolicitudes($item,$valor,0);
		$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$respuesta["id_cliente"],0);
		array_push($respuesta,$cliente);
		echo json_encode($respuesta);
	}

	public $idSolicitud_ref;

	public function ajaxTraerReferencias()
	{
		$item = "id_solicitud";
		$valor = $this->idSolicitud_ref;
		$respuesta = ControladorSolicitud::ctrMostrarReferencias($item,$valor);
		echo json_encode($respuesta);
	}

	public $id_cliente;

	public function ajaxValidarSolicitud()
	{
		$item = "id_cliente";
		$valor = $this->id_cliente;
		$respuesta = ControladorSolicitud::ctrMostrarSolicitudes($item,$valor,0);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["idSolicitud"]))
{
	$actualizar = new AjaxSolicitud();
	$actualizar->idSolicitud = $_POST["idSolicitud"];
	$actualizar->ajaxTraerSolicitud();
}

if(isset($_POST["idSolicitud_ref"]))
{
	$actualizar = new AjaxSolicitud();
	$actualizar->idSolicitud_ref = $_POST["idSolicitud_ref"];
	$actualizar->ajaxTraerReferencias();
}

if(isset($_POST["id_cliente"]))
{
	$actualizar = new AjaxSolicitud();
	$actualizar->id_cliente = $_POST["id_cliente"];
	$actualizar->ajaxValidarSolicitud();
}