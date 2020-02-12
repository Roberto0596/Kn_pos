<?php 

class ControladorClientes
{
	public function ctrMostrarClientes($item,$valor)
	{
		$tabla = "cliente";
		$respuesta = ModeloClientes::mdlMostrarClientes($tabla,$item,$valor);
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
				ControladorClientes::imprimirMensaje("success","El cliente se elimino del sistema","clientes");
			}
			else
			{
				ControladorClientes::imprimirMensaje("error","No es posible eliminar este cliente","clientes");
			}
		}
	}

	public function ctrCrearCliente()
	{
		if (isset($_POST["nombre"]))
		{
			$tabla = "cliente";
			$datos = array('nombre' => $_POST["nombre"],
							'direccion' => $_POST["direccion"], 
							'codigo_postal' => $_POST["codigo_postal"],
							'telefono_casa' => $_POST["t_casa"],
							'telefono_celular' => $_POST["t_celular"],
							'ciudad' => $_POST["ciudad"],
							'edad' => $_POST["edad"],
							'tipo' => $_POST["tipo"]);
			
			$respuesta = ModeloClientes::mdlCrearCliente($tabla,$datos);
			if ($respuesta != "error")
			{
				ControladorClientes::imprimirMensaje("success","El cliente se creo correctamente","clientes");
			}
			else
			{
				ControladorClientes::imprimirMensaje("error","El cliente no se creo","clientes");
			}
		}
	}

	public function ctrEditarCliente()
	{
		if (isset($_POST["nombre"]))
		{
			$tabla = "cliente";
			$datos = array('nombre' => $_POST["nombre"],
							'direccion' => $_POST["direccion"], 
							'codigo_postal' => $_POST["codigo_postal"],
							'telefono_casa' => $_POST["t_casa"],
							'telefono_celular' => $_POST["t_celular"],
							'ciudad' => $_POST["ciudad"],
							'edad' => $_POST["edad"],
							'id_cliente' => $_POST["id_cliente"]);
			$respuesta = ModeloClientes::mdlEditarCliente($tabla,$datos);
			if ($respuesta = "ok")
			{
				ControladorClientes::imprimirMensaje("success","El cliente se edito correctamente","clientes");
			}
			else
			{
				ControladorClientes::imprimirMensaje("error","No fue posible editar el cliente","clientes");
			}
		}
	}

	public function imprimirMensaje($validador,$mensaje,$destino)
 	{
		echo 
		'<script>
		swal.fire({
			type: "'.$validador.'",
			title: "'.$mensaje.'",
			showConfirmButton: true,
			confirmButtonText: "cerrar",
			closeOnConfirm: false
			}).then((result)=>
		    {
				if(result.value)
				{
					window.location = "'.$destino.'";
				}
		    })
		</script>'; 	
 	}
}