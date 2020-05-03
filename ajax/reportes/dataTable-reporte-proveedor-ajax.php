<?php

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

class TablaProveedorAjax
{
	public function MostrarTabla()
	{
		if (isset($_POST["id_proveedor"]))
		{
			$item = "id_proveedor";
			$valor = $_POST["id_proveedor"];
			$respuesta = ControladorClientes::ctrMostrarClienteReporteCredito($item,$valor);
			$res = [ "data" => []];
			if ($respuesta != false)
			{
				foreach($respuesta as $key => $value)
				{
					array_push($res['data'], [
						($key+1),
						$value["nombre"],
						$value["direccion"],
						$value["codigo_postal"],
						$value["asentamiento"],
						$value["telefono_casa"],
						$value["telefono_celular"],
						$value["ciudad"],
						$value["edad"],
					]);
				}	
			}
			echo json_encode($res);
		}
	}
}

$clientes = new TablaProveedorAjax();
$clientes->MostrarTabla();