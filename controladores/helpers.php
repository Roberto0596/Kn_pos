<?php 

class Helpers
{
	public function ctrCrearImagen($foto,$id,$folder,$nuevoAncho,$nuevoAlto)
	{
		$ruta;
		list($ancho,$alto) = getimagesize($foto["tmp_name"]);
		mkdir("vistas/img/".$folder."/".$id,0755);	
		if ($foto["type"] == "image/jpeg")
		{
			$aleatorio = mt_rand(100,999);
			$ruta = "vistas/img/".$folder."/".$id."/".$aleatorio.".jpg";
			$origen = imagecreatefromjpeg($foto["tmp_name"]);
			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			imagejpeg($destino,$ruta);
		}
		if ($foto["type"] == "image/png")
		{
			$aleatorio = mt_rand(100,999);
			$ruta = "vistas/img/".$folder."/".$id."/".$aleatorio.".png";
			$origen = imagecreatefrompng($foto["tmp_name"]);
			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			imagepng($destino,$ruta);
		}
		return $ruta;
	}

	public function eliminarImagen($value,$folder,$foto)
	{
		unlink($foto);
		rmdir('vistas/img/'.$folder.'/'.$value);
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
					window.location="'.$destino.'";
				}
		    })
		</script>'; 	
 	}

 	public function NuevoFolio($flag)
    {
    	if ($flag == "venta")
    	{
    		$respuesta = ModeloVentas::mdlNuevoFolio();
			return $respuesta;
    	}
    	else if($flag == "compra")
    	{
    		$respuesta = ModeloCompras::mdlNuevoFolio();
			return $respuesta;
    	}
    }
}