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
		if (isset($_POST["status"]))
		{
			$almacen = $_POST["almacen"];
			$status = $_POST["status"];
			$respuesta = ControladorSolicitud::ctrMostrarTablaSolicitudes($status,$almacen,0);
			$res = [ "data" => []];

			foreach ($respuesta as $key => $value)
			{
				$imagen = "<img src='".$value["foto"]."' width='50px'>";
				$botones =  "
				<div class='btn-group'>
					<button class='btn btn-warning btnEditarSolicitud' idSolicitud='".$value["id_solicitud"]."'>
						<i class='fas fa-pencil-alt'></i>
					</button>
					<button class='btn btn-danger  btnEliminarSolicitud' foto='".$value["foto"]."' idSolicitud='".$value["id_solicitud"]."'>
						<i class='fas fa-trash'></i>
					</button>
				</div>";

				switch ($value["status"])
				 {
					case 0:
						$botonEstado = "<button class='btnCambiarStatus btn btn-default' valorActual='0' idSolicitud='".$value["id_solicitud"]."'>S/E</button>";
						break;
					case 1:
						$botonEstado = "<button class='btnElegirEstado btn btn-warning' valorActual='1' idSolicitud='".$value["id_solicitud"]."' data-toggle='modal' data-target='#elegirEstado'>Procesando</button>";
						break;
					case 2:
						$botonEstado = "<button class='btn btn-success' valorActual='2' idSolicitud='".$value["id_solicitud"]."'>Aceptada</button>";
						break;
					case 3:
						$botonEstado = "<button class='btn btn-danger' valorActual='3' idSolicitud='".$value["id_solicitud"]."'>Rechazada</button>";
						break;  
				}

				$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$value["id_cliente"],null);
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
			        $botonEstado,
			        $almacen["nombre"],
	        		$botones
				]);
			}
			echo json_encode($res);
		}
	}
}

$clientes = new TablaSolicitud();
$clientes->MostrarTabla();