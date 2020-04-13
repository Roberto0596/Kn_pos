<?php

class ControladorAbonos
{

 	function ctrMostrarUltimoAbono($folioVenta)
 	{
 		$tabla = "abonos";
 		$respuesta = ModeloAbonos::mdlMostrarUltimoAbono($tabla,$folioVenta);
 		return $respuesta;
	 }

	 function ctrMostrarAbonos($item,$valor)
 	{
 		$tabla = "abonos";
 		$respuesta = ModeloAbonos::mdlMostrarAbonos($tabla,$item,$valor);
 		return $respuesta;
 	}

 	public function ctrAgregarAlmacen()
 	{
 		if (isset($_POST["nuevoAlmacen"]))
 		{
 			if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["nuevoAlmacen"]))
 			{
 				$tabla = "almacen";
 				$estado = 0;
 				$datos = array("nombreAlmacen" => $_POST["nuevoAlmacen"],
 				               "ubicacion"=>$_POST["nuevaUbicacion"],
 				               "estadoInicial" => $estado);

		 		$respuesta = ModeloAlmacen::mdlAgregarAlmacen($tabla,$datos);

		 		if ($respuesta=="ok")
		 		{
		 			echo '<script>
					swal.fire({
						type: "success",
						title: "El almacen se agrego correctamente",
						showConfirmButton: true,
						confirmButtonText: "cerrar",
						closeOnConfirm: false
						}).then((result)=>
					    {
							if(result.value)
							{
								window.location = "almacen";
							}
					    })
					</script>';
		 		}
		 		else
		 		{
		 			echo '<script>
					swal.fire({
						type: "error",
						title: "El almacen no se guardo correctamente",
						showConfirmButton: true,
						confirmButtonText: "cerrar",
						closeOnConfirm: false
						}).then((result)=>
					    {
							if(result.value)
							{
								window.location = "almacen";
							}
					    })
					</script>';
		 		}
 			}
 		}

 	}


 	public function ctrEliminarAlmacen()
 	{
 		if (isset($_GET["idAlmacen"]))
 		{
 			$tabla = "almacen";
 			$idAlmacen = $_GET["idAlmacen"];
 			$respuesta = ModeloAlmacen::mdlEliminarAlmacen($tabla,$idAlmacen);
 			if ($respuesta=="ok")
		 	{
		 		echo '<script>
				swal.fire({
					type: "success",
					title: "El almacen se borro correctamente",
					showConfirmButton: true,
					confirmButtonText: "cerrar",
					closeOnConfirm: false
					}).then((result)=>
				    {
						if(result.value)
						{
							window.location = "almacen";
						}
				    })
				</script>';
		 	}
		 	else
		 	{
		 		echo '<script>
				swal.fire({
					type: "error",
					title: "El almacen no se puede borrar correctamente",
					showConfirmButton: true,
					confirmButtonText: "cerrar",
					closeOnConfirm: false
					}).then((result)=>
				    {
						if(result.value)
						{
							window.location = "almacen";
						}
				    })
				</script>';
		 	}
 		}
 	}
}



?>