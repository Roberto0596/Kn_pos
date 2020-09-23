<?php

class ControladorCompra
{
    public function ctrMostrarComprasPorFecha($proveedor, $valor1,$valor2)
    {
        $respuesta = ModeloCompras::mdlMostrarComprasPorFecha($proveedor,$valor1,$valor2);
        return $respuesta;
    }

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
                $item = "Id_producto";
                $valor = $value["id"];

                $respuesta = ModeloProductos::mdlMostrarProductos($tablaProductos,$item,$valor);

                $item1b = "Stock";
                $valor1b = $respuesta["Stock"]+$value["cantidad"];
                $nuevaExistencia = ModeloProductos::mdlActualizarProducto($tablaProductos,$item1b,$valor1b,$valor);
            }

            $compra = new ModeloCompras(NULL, $_POST["nuevaVenta"], $_POST["id_usuario"], $_POST["Id_proveedor"], $_POST["id_almacen"], $_POST["fecha"], $hora, $_POST["listaProductos"], $_POST["totalVenta"]);

            var_dump($compra);

            $respuesta = ModeloCompras::mdlCrearCompra($tabla,$compra);

            if ($respuesta=="ok")
            {
                Helpers::imprimirMensaje("success","La compra y actualizacion de stock se realizo correctamente","index.php?ruta=crearventa&compra=1");
            }
            else
            {
                // Helpers::imprimirMensaje("error","La compra no se realizo correctamente","index.php?ruta=crearventa&compra=1");
            }
		}
    }

    public function ctrMostrarCompras($item,$valor)
    {
        $tabla = "compras";
        $respuesta = ModeloCompras::mdlMostrarCompras($tabla,$item,$valor);
        return $respuesta;
    }

    public function ctrMostrarComprasPorProveedor($item,$valor)
    {
        $tabla = "compras";
        $respuesta = ModeloCompras::mdlMostrarComprasPorProveedor($tabla,$item,$valor);
        return $respuesta;
    }
}

?>