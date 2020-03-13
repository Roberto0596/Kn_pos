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
}

if(isset($_POST["idSolicitud"]))
{
	$actualizar = new AjaxSolicitud();
	$actualizar->idSolicitud = $_POST["idSolicitud"];
	$actualizar->ajaxTraerSolicitud();
}