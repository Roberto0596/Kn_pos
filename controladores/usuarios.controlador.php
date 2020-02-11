<?php
class ControladorUsuarios
{

	static public function ctrIngresoUsuario()
	{
		if (isset($_POST["usuario"])) 
		{
			if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["usuario"]) && preg_match('/^[a-zA-Z0-9]+$/', $_POST["password"])) 
			{
				$respuesta = modeloUsuarios::mdlMostrarUsuarios("usuarios","usuario",$_POST["usuario"]);
				$respuesta2 = ModeloAlmacen::mdlMostrarAlmacen("almacen","id_almacen",$respuesta["almacen"]);

				if($respuesta["usuario"] == $_POST["usuario"] && $respuesta["password"] == $_POST["password"])
				{
					if ($respuesta["estado"] == 1 && $respuesta2["estado"] == 1) 
					{
						$_SESSION["iniciarSesion"] = "ok";
						$_SESSION["id"] = $respuesta["id"];
						$_SESSION["nombre"] = $respuesta["nombre"];
						$_SESSION["usuario"] = $respuesta["usuario"];
						$_SESSION["almacen"]=$respuesta["almacen"];
						$_SESSION["foto"] = $respuesta["foto"];
						$_SESSION["perfil"] = $respuesta["perfil"];

						// registrar fecha para saber ultimo loguin
						date_default_timezone_set('America/Hermosillo');
						$fecha = date('Y-m-d');
						$hora = date('H:i:s');
						$fechaActual = $fecha.' '.$hora;
						$item1 = "ultimo_login";
						$valor1 = $fechaActual;
						$item2 = "id";
						$valor2 = $respuesta["id"];							
						$ultimoLogin = modeloUsuarios::mdlActualizarUsuario("usuarios",$item1,$valor1,$item2,$valor2);

						if ($ultimoLogin == "ok")
						{
							if ($respuesta["perfil"]!="Gerente General")
							{
								echo '<script> window.location = "crear-venta"; </script>';
							}
							else
							{
								echo '<script> window.location = "inicio"; </script>';
							}								
						}
					}
					else
					{
						echo '<br><div class=" alert alert-danger">¡El usuario o el almacen no estan activados!</div>';
					}
 				}
				else
				{
					echo '<br><div class=" alert alert-danger">La contraseña o el usuario no coinciden con nuestro registro</div>';
				}

			}
		}
	}


	static public function ctrCrearUsuario()
	{
		if (isset($_POST["nuevoUsuario"]))
	 	{
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoNombre"]))
			{
				$ruta = "vistas/img/usuarios/default/anonymous.png";
				
				//validar foto
				if (isset($_FILES["nuevaFoto"]["tmp_name"])) 
				{
					list($ancho,$alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;

					//crear directorio para guardar la foto
					$directorio = "vistas/img/usuarios/".$_POST["nuevoUsuario"];
					mkdir($directorio,0755);
					
					//de acuerdo a la imagen hacemos lo siquguiente
					if ($_FILES["nuevaFoto"]["type"] == "image/jpeg")
					{
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino,$ruta);
					}
					if ($_FILES["nuevaFoto"]["type"] == "image/png")
					{
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["nuevoUsuario"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpng($destino,$ruta);
					}
				}

				$tabla = "usuarios";
				
				$datos = array("nombre" => trim($_POST["nuevoNombre"]),
					           "usuario" => trim($_POST["nuevoUsuario"]),
					           "password" => trim($_POST["nuevoPassword"]),
					           "perfil" => trim($_POST["nuevoPerfil"]),
					           "foto"=> trim($ruta),
					       	   "almacen"=>trim($_POST["nuevoAlmacen"]));

				$respuesta = modeloUsuarios::mdlIngresarUsuario($tabla,$datos);

				if ($respuesta == "ok")
				{
					Helpers::imprimirMensaje("success","El usuario a sido guardado correctamente","usuarios");
				}
			}
			else
			{
				Helpers::imprimirMensaje("error","¡El usuario no puede ir vacío o llevar caracteres especiales!","usuarios");
			}
		}
	}

	public static function ctrMostrarUsuarios($item,$valor)
	{
		$tabla = "usuarios";
		$respuesta = modeloUsuarios::mdlMostrarUsuarios($tabla,$item,$valor);
		return $respuesta;
	}

	public static function ctrMostrarUsuariosAlmacen($item,$valor)
	{
		$tabla = "usuarios";
		$respuesta = modeloUsuarios::mdlMostrarUsuariosAlmacen($tabla,$item,$valor);
		return $respuesta;
	}
	
	public static function ctrMostrarUsuariosMenosUno($almacen)
	{
		$tabla = "usuarios";
		$respuesta = modeloUsuarios::mdlMostrarUsuariosMenosUno($tabla,$almacen);
		return $respuesta;
	}


	public function ctrEditarUsuario()
	{
		if (isset($_POST["editarUsuario"]))
		{
			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["editarNombre"]))
			{
				//validar imagen
				$ruta = $_POST["fotoActual"];

				if (isset($_FILES["editarFoto"]["tmp_name"]) && !empty($_FILES["editarFoto"]["tmp_name"]))
				{
					list($ancho,$alto) = getimagesize($_FILES["editarFoto"]["tmp_name"]);
					$nuevoAncho = 500;
					$nuevoAlto = 500;
					//crear directorio para guardar la foto
					$directorio = "vistas/img/usuarios/".$_POST["editarUsuario"];

					if (!empty($_POST["fotoActual"]))
					{
						unlink($_POST["fotoActual"]);
					}
					else
					{
						mkdir($directorio,0755);
					}
					//de acuerdo a la imagen hacemos lo siquguiente
					if ($_FILES["editarFoto"]["type"] == "image/jpeg")
					{
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".jpg";
						$origen = imagecreatefromjpeg($_FILES["editarFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpeg($destino,$ruta);
					}
					if ($_FILES["editarFoto"]["type"] == "image/png")
					{
						$aleatorio = mt_rand(100,999);
						$ruta = "vistas/img/usuarios/".$_POST["editarUsuario"]."/".$aleatorio.".png";
						$origen = imagecreatefrompng($_FILES["editarFoto"]["tmp_name"]);
						$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
						imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
						imagejpng($destino,$ruta);
					}
				}
				$tabla = "usuarios";
				$contraseña;

				if ($_POST["editarPassword"] != "")
				{
					if (preg_match('/^[a-zA-Z0-9]+$/', $_POST["editarPassword"])) 
					{
						$contraseña = $_POST["editarPassword"];
					}
					else
					{
						Helpers::imprimirMensaje("error","¡la contraseña no puede ir vacío o llevar caracteres especiales!","usuarios");
					}
				}
				else
				{
					$contraseña = $_POST["passwordActual"];
				}

				$datos = array("nombre" => trim($_POST["editarNombre"]),
					           "usuario" => trim($_POST["editarUsuario"]),
					           "password" => trim($contraseña),
					           "perfil" => trim($_POST["editarPerfil"]),
					           "foto"=> trim($ruta),
					       	   "almacen"=>trim($_POST["editarAlmacen"]));

				$respuesta = modeloUsuarios::mdlEditarUsuario($tabla,$datos);

				if ($respuesta == "ok")
				{
					Helpers::imprimirMensaje("success","El usuario a sido modificado correctamente","usuarios");
				}
			}
			else
			{
				Helpers::imprimirMensaje("error","¡El nombre no puede ir vacio!","usuarios");
			}
		}
	}

	static public function ctrBorrarUsuario()
	{
		if (isset($_GET["idUsuario"]))
		{
			$tabla = "usuarios";
			$datos = $_GET["idUsuario"];

			if ($_GET["fotoUsuario"] != "") 
			{
				Helpers::eliminarImagen($_GET["usuario"],"usuarios",$_GET["fotoUsuario"]);
			}
			
			$respuesta = modeloUsuarios::mdlBorrarUsuario($tabla,$datos);
			if ($respuesta == "ok")
			{
				Helpers::imprimirMensaje("success","El usuario a sido eliminado correctamente","usuarios");
			}
			else
			{
				Helpers::imprimirMensaje("error","Ocurrio un problema, intente mas tarde","usuarios");
			}
		}
	}
}



	

