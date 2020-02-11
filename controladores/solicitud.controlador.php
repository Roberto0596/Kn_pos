<?php 

Class ControladorSolicitud
{
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

	public function ctrCrearSolicitud()
	{
		if (isset($_POST["id_cliente"])) 
		{
			$tabla = "solicitud_credito";

			date_default_timezone_set('America/Hermosillo');
			$fecha = date('Y-m-d');
			$hora = date('H:i:s');
			$fechaNueva = $fecha.' '.$hora;
			$ruta = Helpers::ctrCrearImagen($_FILES["nuevaFoto"],$_POST["id_cliente"],"solicitudes",1000,1000);	

			$datosFaseUno = array('id_cliente' => $_POST["id_cliente"],
							'num_placas'=> $_POST["num_placas"],
							'estado_civil'=> $_POST["estado_civil"],
							'casa'=> $_POST["casa"],
							'tiempo_casa'=> $_POST["tiempo_casa"],
							'gastos_mensuales'=> $_POST["gastos_mensuales"],
							'nombre_empresa'=> $_POST["nombre_empresa"],
							'dom_empresa'=> $_POST["dom_empresa"],
							'tel_empresa'=> $_POST["tel_empresa"],
							'puesto'=> $_POST["puesto"],
							'num_placas'=> $_POST["num_placas"],
							'sueldo'=> $_POST["sueldo"],
							'antiguedad'=> $_POST["antiguedad"],
							'profesion'=> $_POST["profesion"],
							'fecha'=> $fechaNueva,
							'foto'=> $ruta,
							'id_almacen'=>$_SESSION["almacen"]);

			$respuestaFaseUno = ModeloSolicitud::mdlCrearSolicitud($tabla,$datosFaseUno);
			$faseUno = ($respuestaFaseUno!="error")?true:false;
			if ($faseUno)
			{
				$tablaFaseDos = "referencias";

				//primera referecia del nombre del padre
				$padreReferencia= ControladorSolicitud::ctrCrearReferencia($tablaFaseDos,$_POST["nombre_papa"],$_POST["direccion_papa"],$_POST["telefono_papa"],$_POST["referencia_padre"],$faseUno);

				//primera referecia del nombre de la madre
				$madreReferencia= ControladorSolicitud::ctrCrearReferencia($tablaFaseDos,$_POST["nombre_mama"],$_POST["direccion_mama"],$_POST["telefono_mama"],$_POST["referencia_mama"],$faseUno);

				//referencias familiares del cliente
				$arrayNombreReferenciaFamiliar = $_POST["nombre_familiar"];
				$arrayDireccionReferenciaFamiliar = $_POST["direccion_familiar"];
				$arrayTelefonoReferenciaFamiliar = $_POST["telefono_familiar"];
				foreach ($arrayNombreReferenciaFamiliar as $key => $value)
				{
					$familiarReferencia= ControladorSolicitud::ctrCrearReferencia($tablaFaseDos,$value,$arrayDireccionReferenciaFamiliar[$key],$arrayTelefonoReferenciaFamiliar[$key],$_POST["referencia_familiar"],$faseUno);
				}

				//referencias amistades del cliente
				$arrayNombreReferenciaAmistad = $_POST["nombre_amistad"];
				$arrayDireccionReferenciaAmistad = $_POST["direccion_amistad"];
				$arrayTelefonoReferenciaAmistad = $_POST["telefono_amistad"];
				foreach ($arrayNombreReferenciaAmistad as $key => $value)
				{
					$amistadReferencia = ControladorSolicitud::ctrCrearReferencia($tablaFaseDos,$value,$arrayDireccionReferenciaAmistad[$key],$arrayTelefonoReferenciaAmistad[$key],$_POST["referencia_amistad"],$faseUno);
				}

				if ($padreReferencia == "ok" && $madreReferencia == "ok" && $familiarReferencia == "ok" && $amistadReferencia = "ok")
				{
					Helpers::imprimirMensaje("success","Se completaron las primeras dos fases","solicitud");
				}

			}
			else
			{
				Helpers::imprimirMensaje("error","No se completo la primera fase","solicitud");
			}
		}
	}

	public function ctrCrearReferencia($tabla,$nombre,$direccion,$telefono,$tipo,$id)
 	{
		$datos= array('nombre' => $nombre,
					'direccion' => $direccion,
					'telefono' => $telefono,
					'tipo' => $tipo,
					'id_solicitud' => $id);
		return ModeloSolicitud::mdlCrearReferencia($tabla,$datos);	
 	}
}