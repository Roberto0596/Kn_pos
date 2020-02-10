<?php 

require_once "../controladores/solicitud.controlador.php";
require_once "../modelos/solicitud.modelo.php";

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

require_once "../controladores/almacen.controlador.php";
require_once "../modelos/almacen.modelo.php";

class TablaSolicitud
{
	public function MostrarTabla()
	{
		$respuesta = ControladorSolicitud::ctrMostrarSolicitudes(null,null);
		$res = [ "data" => []];

		foreach ($respuesta as $key => $value)
		{
			$imagen = "<img src='".$value["foto"]."' width='50px'>";
			$botones =  "
			<div class='btn-group'>
				<button class='btn btn-warning btnEditarSolicitud' idSolicitud='".$value["id_solicitud"]."'>
					<i class='fas fa-pencil-alt'></i>
				</button>
				<button class='btn btn-danger  btnEliminarSolicitud'  idSolicitud='".$value["id_solicitud"]."'>
					<i class='fas fa-trash'></i>
				</button>
			</div>";

			if ($value["status"]==0)
			{
				$texto = "Pendiente";
			}

			$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$value["id_cliente"]);
			$botonEmpresa = "<button class='btn btn-warning btnMostrarEmpresa' idSolicitud='".$value["id_solicitud"]."'>
					<i class='fas fa-th'></i>
				</button>";
			$almacen = ControladorAlmacen::ctrMostrarAlmacen("id_almacen",$value["id_almacen"]);
			array_push($res['data'], [
				($key+1),
				$cliente["nombre"],
				$imagen,
				$value["num_placas"],
				$value["estado_civil"],
				$value["profesion"],
				$botonEmpresa,
		        $value["gastos_mensuales"],
		        $texto,
		        $almacen["nombre"],
        		$botones
			]);
		}
		echo json_encode($res);
	}
}

$clientes = new TablaSolicitud();
$clientes->MostrarTabla();