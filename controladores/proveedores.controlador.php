<?php
class ControladorProveedores
{
    public function ctrMostrarProveedores($item,$valor)
	{
		$tabla = "proveedores";
		$respuesta = ModeloProveedores::mdlMostrarProveedores($tabla,$item,$valor);
		return $respuesta;
    }

    public function ctrCrearProveedor()
	{
		if (isset($_POST["nombre"]))
		{
            include_once "modelos/proveedores.modelo.php";
            include_once "controladores/helpers.php";
			$tabla = "proveedores";

            $ModeloProveedores = new ModeloProveedores(NULL, $_POST["nombre"], $_POST["direccion"], $_POST["rfc"], $_POST["telefono"], $_POST["ejecutivo"], $_POST["correo"], $_POST["cuenta_bancaria"], $_POST["categoria"], $_POST["estado"]);

			$respuesta = ModeloProveedores::mdlCrearProveedor($tabla,$ModeloProveedores);
			if ($respuesta = "ok")
			{
				Helpers::imprimirMensaje("success","El proveedor se creó correctamente.","proveedores");
			}
			else
			{
				Helpers::imprimirMensaje("error","El proveedor no se creó.","proveedores");
			}
		}
    }

    public function ctrEditarProveedor()
	{
		if (isset($_POST["id_proveedor"]))
		{
			include_once "modelos/proveedores.modelo.php";
            include_once "controladores/helpers.php";
			$tabla = "proveedores";

            $ModeloProveedores = new ModeloProveedores($_POST["id_proveedor"], $_POST["nombre"], $_POST["direccion"], $_POST["rfc"], $_POST["telefono"], $_POST["ejecutivo"], $_POST["correo"], $_POST["cuenta_bancaria"], $_POST["categoria"],NULL);
			$respuesta = ModeloProveedores::mdlEditarProveedor($tabla,$ModeloProveedores);
			if ($respuesta = "ok")
			{
				Helpers::imprimirMensaje("success","El proveedor se editó correctamente.","proveedores");
			}
			else
			{
				Helpers::imprimirMensaje("error","No fue posible editar el proveedor.","proveedores");
			}
		}
    }

    public function ctrEliminarProveedor()
	{
		if (isset($_GET["idProveedor"]))
		{
            include_once "modelos/proveedores.modelo.php";
            include_once "controladores/helpers.php";
            $tabla = "proveedores";

			$respuesta = ModeloProveedores::mdlEliminarProveedor($tabla,"Id_proveedor",$_GET["idProveedor"]);
			if ($respuesta = "ok")
			{
				Helpers::imprimirMensaje("success","El proveedor se eliminó del sistema.","proveedores");
			}
			else
			{
				Helpers::imprimirMensaje("error","No fue posible eliminar este proveedor.","proveedores");
			}
		}
	}
}
?>