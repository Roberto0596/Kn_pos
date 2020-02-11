<?php

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

class TablaProveedores
{
	public function mostrarTablaProveedores()
	{

		$item = null;
		$valor = null;
	    $proveedores = ControladorProveedores::ctrMostrarProveedores($item,$valor);
		if(count($proveedores) == 0)
		{
			echo '{"data": []}';
			return;
	  	}

		$datosJson = '{
			"data": [';

		for($i = 0; $i < count($proveedores); $i++)
		{
			$botones =  "<div class='btn-group'><button class='btn btn-warning btnEditarProveedor' idProveedor='".$proveedores[$i]["Id_proveedor"]."' data-toggle = 'modal' data-target = '#modalEditarProveedor'><i class='fas fa-pencil-alt'></i></button><button class='btn btn-danger btnEliminarProveedor' idProveedor='".$proveedores[$i]["Id_proveedor"]."'><i class='fa fa-trash'></i></button></div>";
			$datosJson .='[
					"'.($i+1).'",
					"'.$proveedores[$i]["Nombre"].'",
					"'.$proveedores[$i]["Direccion"].'",
					"'.$proveedores[$i]["RFC"].'",
					"'.$proveedores[$i]["Telefono"].'",
					"'.$proveedores[$i]["Ejecutivo"].'",
					"'.$proveedores[$i]["Correo"].'",
					"'.$botones.'"
				],';

		}

		$datosJson = substr($datosJson, 0, -1);

		$datosJson .=   ']

			}';

		echo $datosJson;
	}
}
$activar = new TablaProveedores();
$activar -> mostrarTablaProveedores();