<?php

require_once "../controladores/solicitud.controlador.php";
require_once "../modelos/solicitud.modelo.php";

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class AjaxVentaCredito
{
	public $idCliente;

	public function ajaxTraerSolicitud()
	{
		$valor = $this->idCliente;
		$respuesta = ControladorClientes::ctrMostrarClienteCredito($valor);
		echo json_encode($respuesta);
	}
}

if(isset($_POST["id_cliente"]))
{
	$verificar = new AjaxVentaCredito();
	$verificar->idCliente = $_POST["id_cliente"];
	$verificar->ajaxTraerSolicitud();
}