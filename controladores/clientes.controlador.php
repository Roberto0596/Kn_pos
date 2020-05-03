<?php

class ControladorClientes
{
	public function ctrMostrarClientes($item,$valor,$tipo)
	{
		$tabla = "cliente";
		$respuesta = ModeloClientes::mdlMostrarClientes($tabla,$item,$valor,$tipo);
		return $respuesta;
	}

	public function ctrMostrarClienteReporteCredito($item,$valor)
	{
		$tabla = "cliente";
		$respuesta = ModeloClientes::mdlMostrarClienteReporteCredito($tabla,$item,$valor);
		return $respuesta;
	}

	public function ctrMostrarClientesCredito($valor)
	{
		$respuesta = ModeloClientes::mdlMostrarClientesCredito($valor);
		return $respuesta;
	}

	public function ctrMostrarClienteCredito($idCliente)
	{
		$respuesta = ModeloClientes::mdlMostrarClienteCredito($idCliente);
		return $respuesta;
	}

	public function ctrValidarCliente($item1, $valor1,$item2, $valor2,$tipo)
	{
		$tabla = "cliente";
		$respuesta = ModeloClientes::mdlValidarCliente($tabla,$item1, $valor1,$item2,$valor2,$tipo);
		return $respuesta;
	}

	public function ctrEliminarCliente()
	{
		if (isset($_GET["idCliente"]))
		{
			$tabla = "cliente";
			$respuesta = ModeloClientes::mdlEliminarCliente($tabla,"id_cliente",$_GET["idCliente"]);
			if ($respuesta = "ok")
			{
				Helpers::imprimirMensaje("success","El cliente se elimino del sistema","clientes");
			}
			else
			{
				Helpers::imprimirMensaje("error","No es posible eliminar este cliente","clientes");
			}
		}
	}

	public function ctrCrearCliente()
	{
		if (isset($_POST["nombre"]))
		{
			$tabla = "cliente";
			$datos = array('nombre' => ucfirst($_POST["nombre"]),
							'direccion' => ucfirst($_POST["direccion"]),
							'codigo_postal' => $_POST["codigo_postal"],
							'telefono_casa' => $_POST["t_casa"],
							'telefono_celular' => $_POST["t_celular"],
							'ciudad' => ucfirst($_POST["ciudad"]),
							'edad' => $_POST["edad"],
							'tipo' => $_POST["tipo"],
							'Credito' => $_POST["credito"],
							'historial' => $_POST["historial"],
							'asentamiento' => $_POST["asentamiento"]);

			$respuesta = ModeloClientes::mdlCrearCliente($tabla,$datos);
			if ($respuesta != "error")
			{
				Helpers::imprimirMensaje("success","El cliente se creo correctamente","clientes");
			}
			else
			{
				Helpers::imprimirMensaje("error","El cliente no se creo","clientes");
			}
		}
	}

	public function ctrEditarCliente()
	{
		if (isset($_POST["nombre"]))
		{
			$tabla = "cliente";
			$datos = array('nombre' => ucfirst($_POST["nombre"]),
							'direccion' => ucfirst($_POST["direccion"]),
							'codigo_postal' => $_POST["codigo_postal_enviar"],
							'telefono_casa' => $_POST["t_casa"],
							'telefono_celular' => $_POST["t_celular"],
							'ciudad' => ucfirst($_POST["ciudad_enviar"]),
							'asentamiento' => ucfirst($_POST["asentamiento_enviar"]),
							'edad' => $_POST["edad"],
							'Credito' => $_POST["credito"],
							'historial' => $_POST["historial"],
							'id_cliente' => $_POST["id_cliente"]);

			$respuesta = ModeloClientes::mdlEditarCliente($tabla,$datos);
			if ($respuesta = "ok")
			{
				Helpers::imprimirMensaje("success","El cliente se edito correctamente","clientes");
			}
			else
			{
				Helpers::imprimirMensaje("error","No fue posible editar el cliente","clientes");
			}
		}
	}
}