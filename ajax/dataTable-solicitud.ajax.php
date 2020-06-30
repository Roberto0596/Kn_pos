<?php

require_once "../controladores/solicitud.controlador.php";
require_once "../modelos/solicitud.modelo.php";

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

require_once "../controladores/almacen.controlador.php";
require_once "../modelos/almacen.modelo.php";
error_reporting(0);
class TablaSolicitud
{
	public function MostrarTabla()
	{
			$respuesta = ControladorSolicitud::ctrMostrarSolicitudes(null,null,0);

			$res = [ "data" => []];

			foreach ($respuesta as $key => $value)
			{
				$imagen = "<img src='".$value["foto"]."' width='50px'>";

				$botones =  "
				<div class='btn-group'>
					<button class='btn btn-warning btnEditarSolicitud' title='Ver datos' idSolicitud='".$value["id_solicitud"]."'>
						<i class='fas fa-eye'></i>
					</button>
					<button class='btn btn-danger  btnEliminarSolicitud' clienteEl='".$value["id_cliente"]."' foto='".$value["foto"]."' idSolicitud='".$value["id_solicitud"]."'>
						<i class='fas fa-trash'></i>
					</button>
				</div>";

				$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$value["id_cliente"],null);
				$botonEmpresa = "<button class='btn btn-warning btnMostrarEmpresa' idSolicitud='".$value["id_solicitud"]."'>
						<i class='fas fa-th'></i>
					</button>";
				$almacen = ControladorAlmacen::ctrMostrarAlmacen("id_almacen",$value["id_almacen"]);
				array_push($res['data'], [
					($key+1),
					$cliente["nombre"],
					$imagen,
			        $almacen["nombre"],
	        		$botones
				]);
			}
			echo json_encode($res);

	}
}

$clientes = new TablaSolicitud();
$clientes->MostrarTabla();