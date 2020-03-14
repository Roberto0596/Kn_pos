<?php
class ControladorProductos
{
    public function ctrMostrarProductos($item,$valor)
	{
		$tabla = "productos";
		$respuesta = ModeloProductos::mdlMostrarProductos($tabla,$item,$valor);
		return $respuesta;
    }

    public function ctrMostrarProductosPorProveedor($item,$valor)
	{
		$tabla = "productos";
		$respuesta = ModeloProductos::mdlMostrarProductosPorProveedor($tabla,$item,$valor);
		return $respuesta;
    }

	public function ctrMostrarProductosT()
	{
		$respuesta = ModeloProductos::mdlMostrarProductosT();
		return $respuesta;
    }

    public function ctrCrearProducto()
	{
		if (isset($_POST["codigo"]))
		{
            include_once "modelos/productos.modelo.php";
            include_once "controladores/helpers.php";
			$tabla = "productos";

            $ModeloProductos = new ModeloProductos(NULL, $_POST["codigo"], $_POST["nombre"], $_POST["precio_compra"], $_POST["precio_venta"], $_POST["idProveedor"], $_POST["stock"], 0, $_POST["estado"]);

			$respuesta = ModeloProductos::mdlCrearProducto($tabla,$ModeloProductos);
			if ($respuesta = "ok")
			{
				Helpers::imprimirMensaje("success","El producto se creó correctamente.","productos");
			}
			else
			{
				Helpers::imprimirMensaje("error","El producto no se creó.","productos");
			}
		}
    }

    public function ctrEditarProducto()
	{
		if (isset($_POST["id_producto"]) & isset($_POST["codigo"]))
		{
			include_once "modelos/productos.modelo.php";
            include_once "controladores/helpers.php";
			$tabla = "productos";

            $ModeloProductos = new ModeloProductos($_POST["id_producto"], $_POST["codigo"], $_POST["nombre"], $_POST["precio_compra"], $_POST["precio_venta"], $_POST["idProveedor"], NULL, NULL, NULL);
			$respuesta = ModeloProductos::mdlEditarProducto($tabla,$ModeloProductos);
			if ($respuesta = "ok")
			{
				Helpers::imprimirMensaje("success","El producto se editó correctamente.","productos");
			}
			else
			{
				Helpers::imprimirMensaje("error","No fue posible editar el producto.","productos");
			}
		}
    }

    public function ctrEliminarProducto()
	{
		if (isset($_GET["idProducto"]))
		{
            include_once "modelos/productos.modelo.php";
            include_once "controladores/helpers.php";
            $tabla = "productos";

			$respuesta = ModeloProductos::mdlEliminarProducto($tabla,"Id_producto",$_GET["idProducto"]);
			if ($respuesta = "ok")
			{
				Helpers::imprimirMensaje("success","El producto se eliminó del sistema.","productos");
			}
			else
			{
				Helpers::imprimirMensaje("error","No fue posible eliminar este producto.","productos");
			}
		}
	}

	public function ctrModificarStock()
	{
		if (isset($_POST["id_productoA"]))
		{
            include_once "modelos/productos.modelo.php";
            include_once "controladores/helpers.php";
			$tabla = "productos";
			$stock = $_POST["stockOA"] + $_POST["stockA"];

			$respuesta = ModeloProductos::mdlModificarStock($tabla,"Id_producto",$_POST["id_productoA"], $stock);
			if ($respuesta = "ok")
			{
				Helpers::imprimirMensaje("success","El stock se ha modificado.","productos");
			}
			else
			{
				Helpers::imprimirMensaje("error","No fue posible modificar el stock de este producto.","productos");
			}
		}elseif(isset($_POST["id_productoD"])){
			include_once "modelos/productos.modelo.php";
            include_once "controladores/helpers.php";
			$tabla = "productos";
			$stock = $_POST["stockOD"] - $_POST["stockD"];
			if($stock < 0) $stock = 0;
			$respuesta = ModeloProductos::mdlModificarStock($tabla,"Id_producto",$_POST["id_productoD"], $stock);
			if ($respuesta = "ok")
			{
				Helpers::imprimirMensaje("success","El stock se ha modificado.","productos");
			}
			else
			{
				Helpers::imprimirMensaje("error","No fue posible modificar el stock de este producto.","productos");
			}
		}
	}


	public function ctrVenta($nuevoStock, $idProducto)
	{
		include_once "modelos/productos.modelo.php";
		include_once "controladores/helpers.php";
		$tabla = "productos";
		$stock = $nuevoStock;
		if($stock < 0) $stock = 0;

		return ModeloProductos::mdlModificarStock($tabla,"Id_producto",$idProducto, $stock);
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
            $resultado = "<select id=\"idProveedor\" class=\"form-control-lg\" name=\"idProveedor\" required>\n<option value=\"\" >Seleccione Proveedor</option>\n";


            for($i = 0; $i < count($proveedores); $i++)
            {
                $resultado .="\t<option value=\"".$proveedores[$i]["Id_proveedor"]."\">".$proveedores[$i]["Nombre"]."</option>\n";
            }
            $resultado .="</select>\n";
			return $resultado;
          }
    }
}
?>