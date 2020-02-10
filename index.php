<?php 
	require_once "controladores/main.controlador.php";
	require_once "controladores/usuarios.controlador.php";
	require_once "controladores/almacen.controlador.php";
	require_once "controladores/clientes.controlador.php";
	require_once "controladores/solicitud.controlador.php";
	require_once "modelos/usuarios.modelo.php";
	require_once "modelos/almacen.modelo.php";
	require_once "modelos/clientes.modelo.php";
	require_once "modelos/solicitud.modelo.php";
	$main = new ControladorMain();
	$main->ctrActivarMain();
 ?>