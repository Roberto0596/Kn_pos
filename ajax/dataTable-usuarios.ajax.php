<?php

require_once "../controladores/usuarios.controlador.php";
require_once "../modelos/usuarios.modelo.php";
require_once "../controladores/almacen.controlador.php";
require_once "../modelos/almacen.modelo.php";
class TablaUsuarios
{
	public function mostrarTablaUsuarios()
	{
		if (isset($_POST["almacenId"]))
		{
	     	$usuario = ControladorUsuarios::ctrMostrarUsuariosMenosUno($_POST["almacenId"]);
	     	$res = [ "data" => []];

	     	foreach ($usuario as $key => $value)
	     	{
				$imagen = "<img src='".$value["foto"]."' width='50px'>";

	  			if ($value["estado"]==1)
	  			{
	  	         $botonEstado = "<button class='btn btn-success btn-xs btnActivar activado' idUsuario='".$value["id"]."'  estadoUsuario=0>Activado</button>";
	  			}
	  			else
	  			{
	  				$botonEstado = "<button class='btn btn-danger btn-xs btnActivar activado' idUsuario='".$value["id"]."' estadoUsuario=1>Desactivado</button>";
	  			}
	  			
	  			$botones =  "<div class='btn-group'>
		  			<button class='btn btn-warning btnEditarUsuario' idUsuario='".$value["id"]."'  data-toggle='modal' data-target='#modalEditarUsuario'>
		  				<i class='fas fa-pencil-alt'></i>
		  			</button>
		  			<button class='btn btn-danger  btnEliminarUsuario'  idUsuario='".$value["id"]."' usuario='".$value["usuario"]."'  fotoUsuario'".$value["foto"]."'>
		  			<i class='fas fa-trash'></i>
		  			</button>
	  			</div>"; 	
	  				  		
		  		$almacenNombre = ControladorAlmacen::ctrGetNombreAlmacen($value["almacen"]);
				array_push($res['data'], [
					($key+1),
					$value["nombre"],
					$value["usuario"],
					$imagen,
					$value["perfil"],
					$almacenNombre["nombre"],
		            $botonEstado,
			        $value["ultimo_login"],
            		$botones
				]);
			}			
        	echo json_encode($res);
		}
		
	}
}
$activar = new TablaUsuarios();
$activar->mostrarTablaUsuarios();