<?php

class ControladorCompra
{
    public function ctrCrearCompra()
	{
		if (isset($_POST["nuevaVenta"]))
		{
            $tabla = "compras";
            date_default_timezone_set('America/Hermosillo');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');

            $listaProductos = json_decode($_POST["listaProductos"], true);
            $totalProductosComprados = array();

            foreach ($listaProductos as $key => $value) 
            {
                array_push($totalProductosComprados, $value["cantidad"]);
                
                $tablaProductos = "productos";
                $item = "id_producto";
                $valor = $value["id"];

                $respuesta = ModeloProductos::mdlMostrarProductos($tablaProductos,$item,$valor);

                $item1a = "Ventas";
                $valor1a = $value["cantidad"] + $respuesta["Ventas"];

                $nuevaVenta = ModeloProductos::mdlActualizarProducto($tablaProductos,$item1a,$valor1a,$valor);

                $item1b = "Stock";
                $valor1b = $value["existencia"];
                $nuevaExistencia = ModeloProductos::mdlActualizarProducto($tablaProductos,$item1b,$valor1b,$valor);
            }

            $compra = new ModeloCompras(NULL, $_POST["nuevaVenta"], $_POST["id_usuario"], $_POST["Id_proveedor"], $_POST["id_almacen"], $fecha, $hora, $_POST["listaProductos"], $_POST["totalVenta"]);

            $respuesta = ModeloCompras::mdlCrearCompra($tabla,$compra);

            if ($respuesta=="ok")
            {
                Helpers::imprimirMensaje("success","La compra y actualizacion de stock se realizo correctamente","index.php?ruta=crearventa&compra=1");
            }
            else
            {
                Helpers::imprimirMensaje("error","La compra no se realizo correctamente","index.php?ruta=crearventa&compra=1");
            }
		}
    }
}

?>