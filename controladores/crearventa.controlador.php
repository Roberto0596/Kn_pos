<?php

class ControladorVentas
{
    public function ctrCrearVenta()
	{
		if (isset($_POST["nuevaVenta"]))
		{
            include_once "modelos/crearventa.modelo.php";
            include_once "controladores/productos.controlador.php";
            include_once "controladores/helpers.php";
            $tabla = "ventas";
            date_default_timezone_set('America/Hermosillo');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $productos = json_decode($_POST["listaProductos"]);
            $ModeloCrearventa = new ModeloVentas(NULL, $_POST["nuevaVenta"], $_POST["id_usuario"], $_POST["id_cliente"], $_POST["id_almacen"], $fecha, $hora, $_POST["listaProductos"], $_POST["totalVenta"], $_POST["totalPayment"]);

            foreach ($productos as $producto) {
                if(ControladorProductos::ctrVenta($producto->existencia, $producto->id) != "ok"){
                    $mensajeError .= "El producto ".$producto->descripcion." no se pudo modificar el stock, error sql";
                    dei("Error SQL: " . $mensajeError);
                }
            }

            $respuesta = "ok";//ModeloVentas::mdlCrearVenta($tabla,$ModeloCrearventa);

			if ($respuesta = "ok")
			{
                print_r($_POST);
				Helpers::imprimirMensaje("success","La venta se registró correctamente.","crearventa");
			}
			else
			{
				Helpers::imprimirMensaje("error","La venta no se creó.","crearventa");
			}
		}
    }

}
?>