<?php

Class ControladorSolicitud
{
	public function ctrMostrarSolicitudes($item,$valor,$tipo)
	{
		$tabla = "solicitud_credito";
		$respuesta = ModeloSolicitud::mdlMostrarSolicitudes($tabla,$item,$valor,$tipo);
		return $respuesta;
	}

	public function ctrMostrarTablaSolicitudes($status,$almacen,$tipo)
	{
		$tabla = "solicitud_credito";
		$respuesta = ModeloSolicitud::mdlMostrarTablaSolicitudes($tabla,$status,$almacen,$tipo);
		return $respuesta;
	}

	public function ctrMostrarReferencias($item,$valor)
	{
		$tabla = "referencias";
		$respuesta = ModeloSolicitud::mdlMostrarReferencias($tabla,$item,$valor);
		return $respuesta;
	}

	public function ctrEliminarSolicitud()
	{
		if (isset($_GET["idSolicitud"]))
		{
			$tabla = "solicitud_credito";
			$tablaRelacion = "cliente_conyuge";
			if ($_GET["fotoCliente"]!= "vistas/img/solicitudes/default/anonymous.png")
			{
				Helpers::eliminarImagen($_GET["idSolicitud"],"solicitudes",$_GET["fotoCliente"]);
			}

			$relacion = ModeloSolicitud::mdlMostrarSolicitudes($tablaRelacion,"id_solicitud_cliente",$_GET["idSolicitud"],null);

			$solicitudConyuge = ControladorSolicitud::ctrMostrarSolicitudes("id_solicitud",$relacion["id_solicitud_conyuge"],null);

			$eliminarConyuge = ModeloClientes::mdlEliminarCliente("cliente","id_cliente",$solicitudConyuge["id_cliente"]);

			$eliminarSolicitudConyuge = ModeloSolicitud::mdlEliminarSolicitud($tabla,"id_solicitud",$solicitudConyuge["id_solicitud"]);

			$eliminarSolicitudCliente = ModeloSolicitud::mdlEliminarSolicitud($tabla,"id_solicitud",$_GET["idSolicitud"]);

			$eliminarRelacion = ModeloSolicitud::mdlEliminarSolicitud($tablaRelacion,"id",$relacion["id"]);

			if ($eliminarSolicitudCliente=="ok" && $eliminarConyuge=="ok")
			{
				ModeloClientes::mdlCreditoCliente("0",$_GET["clienteEl"]);
				Helpers::imprimirMensaje("success","Se Elimino la solicitud","solicitud");
			}
			else
			{
				Helpers::imprimirMensaje("error","No se puede borrar la solicitud","solicitud");
			}
		}
	}

	public function ctrEditarSolicitud()
	{
		if (isset($_POST["idSolicitud"]))
		{
			$tabla = "solicitud_credito";

			$datos = array('num_placas'=> strtoupper($_POST["num_placas"]),
					'estado_civil'=> $_POST["estado_civil"],
					'casa'=> $_POST["casa"],
					'tiempo_casa'=> $_POST["tiempo_casa"],
					'gastos_mensuales'=> $_POST["gastos_mensuales"],
					'nombre_empresa'=> ucfirst($_POST["nombre_empresa"]),
					'dom_empresa'=> ucfirst($_POST["dom_empresa"]),
					'tel_empresa'=> $_POST["tel_empresa"],
					'puesto'=> ucfirst($_POST["puesto"]),
					'sueldo'=> $_POST["sueldo"],
					'id_solicitud'=> $_POST["idSolicitud"],
					'antiguedad'=> $_POST["antiguedad"],
					'profesion'=> ucfirst($_POST["profesion"]),
					'foto'=> $_POST["fotoVieja"]);

			$actualizarSolicitudCliente = ModeloSolicitud::mdlEditarSolicitud($tabla,$datos);

			if ($_POST["idSolicitudConyuge"] != 0)
			{
				$tablaCliente = "cliente";
				$datosCliente = array(
					'nombre' => ucfirst($_POST["nombre_aval"]),
					'direccion' => ucfirst($_POST["direccion_aval"]),
					'codigo_postal' => "ninguno",
					'asentamiento' => "ninguno",
					'telefono_casa' => $_POST["t_casa_aval"],
					'telefono_celular' => $_POST["t_celular_aval"],
					'ciudad' => ucfirst($_POST["ciudad_aval"]),
					'edad' => $_POST["edad_aval"],
					'Credito' => "nunguno",
					'historial' => "ninguno",
					'tipo' => $_POST["tipo_aval"],
					'id_cliente'=>$_POST["id_cliente_aval"]); 

				$actualizarClienteAval = ModeloClientes::mdlEditarCliente($tablaCliente,$datosCliente);

				$datosSolicitud = array(
					'num_placas'=> strtoupper($_POST["num_placas_aval"]),
					'estado_civil'=> $_POST["estado_civil_aval"],
					'casa'=> $_POST["casa_aval"],
					'tiempo_casa'=> $_POST["tiempo_casa_aval"],
					'gastos_mensuales'=> $_POST["gastos_mensuales_aval"],
					'nombre_empresa'=> ucfirst($_POST["nombre_empresa_aval"]),
					'dom_empresa'=> ucfirst($_POST["dom_empresa_aval"]),
					'tel_empresa'=> $_POST["tel_empresa_aval"],
					'puesto'=> ucfirst($_POST["puesto_aval"]),
					'sueldo'=> $_POST["sueldo_aval"],
					'id_solicitud'=> $_POST["idSolicitudConyuge"],
					'antiguedad'=> $_POST["antiguedad_aval"],
					'profesion'=> ucfirst($_POST["profesion_aval"]),
					'foto'=> $_POST["fotoVieja"]);

				$actualizarSolicitudCliente = ModeloSolicitud::mdlEditarSolicitud($tabla,$datosSolicitud);

				$tablaReferencia = "referencias";
				
				if (isset($_POST["id_papa_ref"]))
				{
					$datosPadre = array(
					'nombre'=> ucfirst($_POST["nombre_papa"]),
					'direccion'=> $_POST["direccion_papa"],
					'telefono'=> $_POST["telefono_papa"],
					'id_referencia'=> $_POST["id_papa_ref"]);
					var_dump($datosPadre);
					$editarPapa = ModeloSolicitud::mdlEditarReferencia($tablaReferencia,$datosPadre);
					var_dump($editarPapa);
				}

				if (isset($_POST["id_mama_ref"]))
				{
					$datosMama = array(
					'nombre'=> ucfirst($_POST["nombre_mama"]),
					'direccion'=> $_POST["direccion_mama"],
					'telefono'=> $_POST["telefono_mama"],
					'id_referencia'=> $_POST["id_mama_ref"]);
					$editarMama = ModeloSolicitud::mdlEditarReferencia($tablaReferencia,$datosMama);
				}
			}

			if ($actualizarSolicitudCliente=="ok") 
			{
				//Helpers::imprimirMensaje("success","Se modifico adecuadamente","solicitud");
			}
			else
			{
				Helpers::imprimirMensaje("error","No se modifico adecuadamente","solicitud");
			}
		}
		
	}

	public function ctrCrearSolicitud()
	{
		if (isset($_POST["id_cliente"]))
		{
			if ($_FILES["nuevaFoto"]["name"] != "")
			{
				$ruta = Helpers::ctrCrearImagen($_FILES["nuevaFoto"],$_POST["id_cliente"],"solicitudes",1000,1000);
			}
			else
			{
				$ruta = "vistas/img/solicitudes/default/anonymous.png";
			}

			$referenciaConyuge = "ok";

			$solicitudCliente = ControladorSolicitud::ctrAgregarSolicitud($_POST["id_cliente"],$_POST["num_placas"],$_POST["estado_civil"],$_POST["casa"],$_POST["tiempo_casa"],$_POST["gastos_mensuales"],$_POST["nombre_empresa"],$_POST["dom_empresa"],$_POST["tel_empresa"],$_POST["puesto"],$_POST["sueldo"],$_POST["antiguedad"],$_POST["profesion"],$ruta,0);
			ModeloClientes::mdlCreditoCliente("1",$_POST["id_cliente"]);

			if (isset($_POST["nombre_aval"]))
			{
				$datosConyuge = array(
					'nombre' => ucfirst($_POST["nombre_aval"]),
					'direccion' => ucfirst($_POST["direccion_aval"]),
					'codigo_postal' => "ninguno",
					'asentamiento' => "ninguno",
					'telefono_casa' => $_POST["t_casa_aval"],
					'telefono_celular' => $_POST["t_celular_aval"],
					'ciudad' => ucfirst($_POST["ciudad_aval"]),
					'edad' => $_POST["edad_aval"],
					'Credito' => "nunguno",
					'historial' => "ninguno",
					'tipo' => $_POST["tipo_aval"]);

				$crearConyuge = ModeloClientes::mdlCrearCliente("cliente",$datosConyuge);

				$solicitudConyuge = ControladorSolicitud::ctrAgregarSolicitud($crearConyuge,$_POST["num_placas_aval"],$_POST["estado_civil_aval"],$_POST["casa_aval"],$_POST["tiempo_casa_aval"],$_POST["gastos_mensuales_aval"],$_POST["nombre_empresa_aval"],$_POST["dom_empresa_aval"],$_POST["tel_empresa_aval"],$_POST["puesto_aval"],$_POST["sueldo_aval"],$_POST["antiguedad_aval"],$_POST["profesion_aval"],$ruta,1);

				$crearRelacion = ModeloSolicitud::mdlCrearRelacion($solicitudCliente,$solicitudConyuge);


				$referenciaConyuge = ControladorSolicitud::ctrCrearUnaReferencia($_POST["nombre_papa_aval"],$_POST["direccion_papa_aval"],$_POST["telefono_papa_aval"],$_POST["referencia_padre_aval"],$_POST["nombre_mama_aval"],$_POST["direccion_mama_aval"],$_POST["telefono_mama_aval"],$_POST["referencia_mama_aval"],$_POST["nombre_familiar_aval"],$_POST["direccion_familiar_aval"],$_POST["telefono_familiar_aval"],$_POST["nombre_amistad_aval"],$_POST["direccion_amistad_aval"],$_POST["telefono_amistad_aval"],$solicitudConyuge);
			}

			if ($solicitudCliente!="error")
			{
				if (isset($_POST["nombre_d_aval"]))
				{
					 $referenciaAval = ControladorSolicitud::ctrAgregarReferencia($_POST["nombre_d_aval"] ,$_POST["direccion_d_aval"] ,$_POST["telefono_d_aval"] ,4,$solicitudCliente);
				}

				$fererenciaCliente = ControladorSolicitud::ctrCrearUnaReferencia($_POST["nombre_papa"],$_POST["direccion_papa"],$_POST["telefono_papa"],$_POST["referencia_padre"],$_POST["nombre_mama"],$_POST["direccion_mama"],$_POST["telefono_mama"],$_POST["referencia_mama"],$_POST["nombre_familiar"],$_POST["direccion_familiar"],$_POST["telefono_familiar"],$_POST["nombre_amistad"],$_POST["direccion_amistad"],$_POST["telefono_amistad"],$solicitudCliente);

				if ($referenciaConyuge == "ok" && $fererenciaCliente == "ok")
				{

					Helpers::imprimirMensaje("success","La solicitud fue creada correctamente","solicitud");
				}
				else
				{
					Helpers::imprimirMensaje("error","No se completaron algunas fases, favor de editar la solicitud y llenar los datos faltantes","solicitud");
				}
			}
			else
			{
				Helpers::imprimirMensaje("error","No fue posible crear la solicitud","solicitud");
			}
		}
	}

	public function ctrAgregarSolicitud($id_cliente,$num_placas,$estado_civil,$casa,$tiempo_casa,$gastos_mensuales,$nombre_empresa,$dom_empresa,$tel_empresa,$puesto,$sueldo,$antiguedad,$profesion,$ruta,$tipo)
	{
		$tabla = "solicitud_credito";
		date_default_timezone_set('America/Hermosillo');
		$fecha = date('Y-m-d');
		$hora = date('H:i:s');
		$fechaNueva = $fecha.' '.$hora;

		$datos = array('id_cliente' => $id_cliente,
							'num_placas'=> strtoupper($num_placas),
							'estado_civil'=> $estado_civil,
							'casa'=> $casa,
							'tiempo_casa'=> $tiempo_casa,
							'gastos_mensuales'=> $gastos_mensuales,
							'nombre_empresa'=> ucfirst($nombre_empresa),
							'dom_empresa'=> ucfirst($dom_empresa),
							'tel_empresa'=> $tel_empresa,
							'puesto'=> ucfirst($puesto),
							'sueldo'=> $sueldo,
							'antiguedad'=> $antiguedad,
							'profesion'=> ucfirst($profesion),
							'fecha'=> $fechaNueva,
							'foto'=> $ruta,
							'id_almacen'=>$_SESSION["almacen"],
							'tipo'=>$tipo);

			$respuesta = ModeloSolicitud::mdlCrearSolicitud($tabla,$datos);
			if ($respuesta !="error")
			{
				return $respuesta;
			}
			else
			{
				return "error";
			}
	}

	public function ctrCrearUnaReferencia($nombrePapa,$direccionPapa,$telefonoPapa,$tipoPapa,$nombreMama,$direccionMama,$telefonoMama,$tipoMama,$arrayNombreFamiliar,$arrayDireccionFamiliar,$arrayTelefonoFamiliar,$arrayNombreAmistad,$arrayDireccionAmistad,$arrayTelefonoAmistad,$idSolicitud)
	{
		$padreReferencia= ControladorSolicitud::ctrAgregarReferencia($nombrePapa,$direccionPapa,$telefonoPapa,$tipoPapa,$idSolicitud);

		$madreReferencia= ControladorSolicitud::ctrAgregarReferencia($nombreMama,$direccionMama,$telefonoMama,$tipoMama,$idSolicitud);

		foreach ($arrayNombreFamiliar as $key => $value)
		{
			$familiarReferencia= ControladorSolicitud::ctrAgregarReferencia($value,$arrayDireccionFamiliar[$key],$arrayTelefonoFamiliar[$key],$_POST["referencia_familiar"],$idSolicitud);
		}

		foreach ($arrayNombreAmistad as $key => $value)
		{
			$amistadReferencia = ControladorSolicitud::ctrAgregarReferencia($value,$arrayDireccionAmistad[$key],$arrayTelefonoAmistad[$key],$_POST["referencia_amistad"],$idSolicitud);
		}

		if ($padreReferencia == "ok" && $madreReferencia == "ok" && $familiarReferencia == "ok" && $amistadReferencia == "ok")
		{
			return "ok";
		}
		else
		{
			return "error";
		}
	}

	public function ctrAgregarReferencia($nombre,$direccion,$telefono,$tipo,$id)
 	{
 		$tabla = "referencias";
		$datos= array('nombre' => ucfirst($nombre),
					'direccion' => ucfirst($direccion),
					'telefono' => $telefono,
					'tipo' => $tipo,
					'id_solicitud' => $id);
		return ModeloSolicitud::mdlCrearReferencia($tabla,$datos);
 	}
}