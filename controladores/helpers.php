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
			$ruta = "vistas/img/".$folder."/".$_POST["id_cliente"]."/".$aleatorio.".jpg";
			$origen = imagecreatefromjpeg($foto["tmp_name"]);
			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			imagejpeg($destino,$ruta);
		}
		if ($foto["type"] == "image/png")
		{
			$aleatorio = mt_rand(100,999);
			$ruta = "vistas/img/".$folder."/".$_POST["id_cliente"]."/".$aleatorio.".png";
			$origen = imagecreatefrompng($foto["tmp_name"]);
			$destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);
			imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
			imagejpng($destino,$ruta);
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

 	public function NuevoFolio()
    {
        $respuesta = ModeloVentas::mdlNuevoFolio();
		return $respuesta;
    }

    public function traerProveedores()
    {
        $resultado = "";
        $item = null;
		$valor = null;
        $proveedores = ControladorProveedores::ctrMostrarProveedores($item,$valor);
        if(count($proveedores) == 0)
		{
			$resultado = "<select id=\"idProveedor\" class=\"form-control\" name=\"idProveedor\" required>\n";
            $resultado .="\t<option>No hay proveedores activos</option>\n";
            $resultado .="</select>\n";
			return $resultado;
	  	}else{
            $resultado = "<select id=\"idProveedor\" class=\"form-control-lg\" name=\"idProveedor\" required>\n";

            for($i = 0; $i < count($proveedores); $i++)
            {
                $resultado .="\t<option value=\"".$proveedores[$i]["Id_proveedor"]."\">".$proveedores[$i]["Nombre"]."</option>\n";
            }
            $resultado .="</select>\n";
			return $resultado;
          }
    }
}