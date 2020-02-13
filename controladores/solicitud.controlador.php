<?php 

Class ControladorSolicitud
{
	public function ctrCrearSolicitud()
	{
		if (isset($_POST["id_cliente"])) 
		{
			$ruta = Helpers::ctrCrearImagen($_FILES["nuevaFoto"],$_POST["id_cliente"],"solicitudes",1000,1000);

			$respuestaFaseUno = ControladorSolicitud::ctrAgregarSolicitud($_POST["id_cliente"],$_POST["num_placas"],$_POST["estado_civil"],$_POST["casa"],$_POST["tiempo_casa"],$_POST["gastos_mensuales"],$_POST["nombre_empresa"],$_POST["dom_empresa"],$_POST["tel_empresa"],$_POST["puesto"],$_POST["sueldo"],$_POST["antiguedad"],$_POST["profesion"],$ruta,0);

			if ($respuestaFaseUno!="error")
			{
				$faseDos = ControladorSolicitud::ctrCrearUnaReferencia($_POST["nombre_papa"],$_POST["direccion_papa"],$_POST["telefono_papa"],$_POST["referencia_padre"],$_POST["nombre_mama"],$_POST["direccion_mama"],$_POST["telefono_mama"],$_POST["referencia_mama"],$_POST["nombre_familiar"],$_POST["direccion_familiar"],$_POST["telefono_familiar"],$_POST["nombre_amistad"],$_POST["direccion_amistad"],$_POST["telefono_amistad"],$respuestaFaseUno);

				if ($faseDos == "ok")
				{
					$datosAval = array('nombre' => $_POST["nombre_aval"],
							'direccion' => $_POST["direccion_aval"], 
							'codigo_postal' => $_POST["codigo_postal_aval"],
							'telefono_casa' => $_POST["t_casa_aval"],
							'telefono_celular' => $_POST["t_celular_aval"],
							'ciudad' => $_POST["ciudad_aval"],
							'edad' => $_POST["edad_aval"],
							'tipo' => $_POST["tipo_aval"]);

					$faseTres = ModeloClientes::mdlCrearCliente("cliente",$datosAval);

					if ($faseTres != "error")
					{
						$respuestaFaseCuatro = ControladorSolicitud::ctrAgregarSolicitud($faseTres,$_POST["num_placas_aval"],$_POST["estado_civil_aval"],$_POST["casa_aval"],$_POST["tiempo_casa_aval"],$_POST["gastos_mensuales_aval"],$_POST["nombre_empresa_aval"],$_POST["dom_empresa_aval"],$_POST["tel_empresa_aval"],$_POST["puesto_aval"],$_POST["sueldo_aval"],$_POST["antiguedad_aval"],$_POST["profesion_aval"],$ruta,0);

						if ($respuestaFaseCuatro != "error")
						{
							$faseCinco = ControladorSolicitud::ctrCrearUnaReferencia($_POST["nombre_papa_aval"],$_POST["direccion_papa_aval"],$_POST["telefono_papa_aval"],$_POST["referencia_padre_aval"],$_POST["nombre_mama_aval"],$_POST["direccion_mama_aval"],$_POST["telefono_mama_aval"],$_POST["referencia_mama_aval"],$_POST["nombre_familiar_aval"],$_POST["direccion_familiar_aval"],$_POST["telefono_familiar_aval"],$_POST["nombre_amistad_aval"],$_POST["direccion_amistad_aval"],$_POST["telefono_amistad_aval"],$respuestaFaseCuatro);
							if ($faseCinco == "ok")
							{
								Helpers::imprimirMensaje("success","Se completaron todas las fases satisfactoriamente","solicitud");
							}
							else
							{
								Helpers::imprimirMensaje("error","No se completo la fase cinto, agregacion de referencias del aval","solicitud");
							}
						}
						else
						{
							Helpers::imprimirMensaje("error","No se completo la fase cuatro, agregacion de informacion extra del aval","solicitud");
						}
					}
					else
					{
						Helpers::imprimirMensaje("error","No se completo la fase tres, agregacion del aval","solicitud");
					}
				}

			}
			else
			{
				Helpers::imprimirMensaje("error","No se completo la primera fase","solicitud");
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
							'num_placas'=> $num_placas,
							'estado_civil'=> $estado_civil,
							'casa'=> $casa,
							'tiempo_casa'=> $tiempo_casa,
							'gastos_mensuales'=> $gastos_mensuales,
							'nombre_empresa'=> $nombre_empresa,
							'dom_empresa'=> $dom_empresa,
							'tel_empresa'=> $tel_empresa,
							'puesto'=> $puesto,
							'sueldo'=> $sueldo,
							'antiguedad'=> $antiguedad,
							'profesion'=> $profesion,
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
		//primera referecia del nombre del padre
		$padreReferencia= ControladorSolicitud::ctrAgregarReferencia($nombrePapa,$direccionPapa,$telefonoPapa,$tipoPapa,$idSolicitud);

		//primera referecia del nombre de la madre
		$madreReferencia= ControladorSolicitud::ctrAgregarReferencia($nombreMama,$direccionMama,$telefonoMama,$tipoMama,$idSolicitud);

		//referencias familiares del cliente
		foreach ($arrayNombreFamiliar as $key => $value)
		{
			$familiarReferencia= ControladorSolicitud::ctrAgregarReferencia($value,$arrayDireccionFamiliar[$key],$arrayTelefonoFamiliar[$key],$_POST["referencia_familiar"],$idSolicitud);
		}

		//referencias amistades del cliente
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
		$datos= array('nombre' => $nombre,
					'direccion' => $direccion,
					'telefono' => $telefono,
					'tipo' => $tipo,
					'id_solicitud' => $id);
		return ModeloSolicitud::mdlCrearReferencia($tabla,$datos);	
 	}

 	public function ctrMostrarSolicitudes($item,$valor)
	{
		$tabla = "solicitud_credito";
		$respuesta = ModeloSolicitud::mdlMostrarSolicitudes($tabla,$item,$valor);
		return $respuesta;
	}

	public function ctrEliminarSolicitud()
	{
		if (isset($_GET["idSolicitud"]))
		{
			$tabla = "solicitud_credito";
			Helpers::eliminarImagen($_GET["idSolicitud"],"solicitudes",$_GET["fotoCliente"]);
			$respuesta = ModeloSolicitud::mdlEliminarSolicitud($tabla,"id_solicitud",$_GET["idSolicitud"]);
			if ($respuesta=="ok")
			{
				Helpers::imprimirMensaje("success","Se Elimino la solicitud","solicitud");
			}
			else
			{
				Helpers::imprimirMensaje("error","No se puede borrar la solicitud","solicitud");
			}
		}
	}
}