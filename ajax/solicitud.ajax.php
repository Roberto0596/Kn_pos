<?php

require_once "../controladores/solicitud.controlador.php";
require_once "../modelos/solicitud.modelo.php";

class AjaxSolicitud
{
	public $idSolicitud;
	public $nuevoStatus;
	public function ajaxCambiarStatus()
	{
		$item2 = "id_solicitud";
		$valor2 = $this->idSolicitud;
		$item1 = "status";
		$valor1 = $this->nuevoStatus;
		$respuesta = ModeloSolicitud::mdlActualizarSolicitud("solicitud_credito",$item1,$valor1,$item2,$valor2);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["idSolicitud"]))
{
	$actualizar = new AjaxSolicitud();
	$actualizar->idSolicitud = $_POST["idSolicitud"];
	$actualizar->nuevoStatus = $_POST["status"];
	$actualizar->ajaxCambiarStatus();
}