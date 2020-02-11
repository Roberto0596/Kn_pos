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
				ControladorClientes::imprimirMensaje("success","Se Elimino la solicitud","solicitud");
			}
			else
			{
				ControladorClientes::imprimirMensaje("error","No se puede borrar la solicitud","solicitud");
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
			$ruta = "vistas/img/solicitudes/default/anonymous.png";

			if (isset($_FILES["nuevaFoto"]["tmp_name"])) 
			{
				list($ancho,$alto) = getimagesize($_FILES["nuevaFoto"]["tmp_name"]);
				$nuevoAncho = 500;
				$nuevoAlto = 500;
				$directorio = "vistas/img/solicitudes/".$_POST["id_cliente"];
				mkdir($directorio,0755);
				
				if ($_FILES["nuevaFoto"]["type"] == "image/jpeg")
				{
					$aleatorio = mt_rand(100,999);
					$ruta = "vistas/img/solicitudes/".$_POST["id_cliente"]."/".$aleatorio.".jpg";
					$origen = imagecreatefromjpeg($_FILES["nuevaFoto"]["tmp_name"]);
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagejpeg($destino,$ruta);
				}
				if ($_FILES["nuevaFoto"]["type"] == "image/png")
				{
					$aleatorio = mt_rand(100,999);
					$ruta = "vistas/img/solicitudes/".$_POST["id_cliente"]."/".$aleatorio.".png";
					$origen = imagecreatefrompng($_FILES["nuevaFoto"]["tmp_name"]);
					$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
					imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
					imagejpng($destino,$ruta);
				}
			}

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
			var_dump($faseUno);
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
					ControladorClientes::imprimirMensaje("success","Se completaron las primeras dos fases","solicitud");
				}

			}
			else
			{
				ControladorClientes::imprimirMensaje("error","No se completo la primera fase","solicitud");
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
					
				}
		    })
		</script>'; 	
 	}
}