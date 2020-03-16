<?php
	require_once "controladores/main.controlador.php";
	require_once "controladores/usuarios.controlador.php";
	require_once "controladores/almacen.controlador.php";
	require_once "controladores/clientes.controlador.php";
	require_once "controladores/solicitud.controlador.php";
	include_once "controladores/proveedores.controlador.php";
	include_once "controladores/productos.controlador.php";
	include_once "controladores/crearventa.controlador.php";
	include_once "controladores/compra.controlador.php";
	require_once "controladores/helpers.php";
	require_once "modelos/usuarios.modelo.php";
	require_once "modelos/almacen.modelo.php";
	require_once "modelos/clientes.modelo.php";
	require_once "modelos/solicitud.modelo.php";
	include_once "modelos/proveedores.modelo.php";
	include_once "modelos/productos.modelo.php";
	include_once "modelos/crearventa.modelo.php";
	include_once "modelos/compra.modelo.php";
	$main = new ControladorMain();
	$main->ctrActivarMain();
 ?>