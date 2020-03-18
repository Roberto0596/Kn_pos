<?php

require_once "../controladores/clientes.controlador.php";
require_once "../modelos/clientes.modelo.php";

class TablaClientes
{
	public function MostrarTabla()
	{
		$respuesta = ControladorClientes::ctrMostrarClientes(null,null,0);
		$res = [ "data" => []];
		foreach ($respuesta as $key => $value)
		{

			if($value["id_cliente"]>1)
			{
				$botones =  "
				<div class='btn-group'>
					<button class='btn btn-warning btnEditarCliente' data-toggle='modal' data-target='#modalEditarCliente' idCliente='".$value["id_cliente"]."'>
						<i class='fas fa-pencil-alt'></i>
					</button>
					<button class='btn btn-danger  btnEliminarCliente'  idCliente='".$value["id_cliente"]."'>
						<i class='fas fa-trash'></i>
					</button>
				</div>";

				array_push($res['data'], [
					($key),
					$value["nombre"],
					$value["direccion"],
					$value["codigo_postal"],
					$value["asentamiento"],
					$value["telefono_casa"],
					$value["telefono_celular"],
					$value["ciudad"],
					$value["edad"],
					$value["historial"],
					$botones
				]);
			}
		}
		echo json_encode($res);
	}
}

$clientes = new TablaClientes();
$clientes->MostrarTabla();