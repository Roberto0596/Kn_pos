<?php
require_once "conexion.php";
class ModeloProductos{
    public $Id_producto;
    public $Codigo;
    public $Nombre;
    public $Precio_compra;
    public $Precio_venta;
    public $Id_proveedor;
    public $Estado;

    function __construct($Id_producto, $Codigo, $Nombre, $Precio_compra, $Precio_venta, $Id_proveedor, $Estado)
	{
		$this->Id_producto=$Id_producto;
		$this->Codigo=$Codigo;
		$this->Nombre=$Nombre;
        $this->Precio_compra=$Precio_compra;
        $this->Precio_venta=$Precio_venta;
        $this->Id_proveedor=$Id_proveedor;
        $this->Estado=$Estado;
    }

    public static function mdlMostrarProductos($tabla,$item,$valor)
	{
		if ($item==null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE Estado=1;");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetch();
		}
		$stmt->close();
	}

	public static function mdlMostrarProductosT()
	{
		$stmt = Conexion::conectar()->prepare("SELECT Id_producto, Codigo, productos.Nombre, Precio_compra, Precio_venta, proveedores.Nombre as NombreProv FROM productos, proveedores WHERE productos.Estado=1 and productos.Id_proveedor = proveedores.Id_proveedor;");
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
    }

    public static function mdlCrearProducto($tabla,$producto)
	{
		$stmt = Conexion::Conectar()->prepare("INSERT INTO $tabla VALUES(NULL, :Codigo, :Nombre, :Precio_compra, :Precio_venta, :Id_proveedor, :Estado);");

		$stmt->bindParam(":Codigo", $producto->Codigo, PDO::PARAM_STR);
		$stmt->bindParam(":Nombre", $producto->Nombre, PDO::PARAM_STR);
		$stmt->bindParam(":Precio_compra", $producto->Precio_compra, PDO::PARAM_STR);
		$stmt->bindParam(":Precio_venta", $producto->Precio_venta, PDO::PARAM_STR);
		$stmt->bindParam(":Id_proveedor", $producto->Id_proveedor, PDO::PARAM_STR);
		$stmt->bindParam(":Estado", $producto->Estado, PDO::PARAM_STR);

		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
    }

    public static function mdlEditarProducto($tabla,$producto)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set Codigo = :Codigo, Nombre = :Nombre, Precio_compra = :Precio_compra, Precio_venta = :Precio_venta, Id_proveedor = :Id_proveedor WHERE Id_producto = :Id_producto;");

        $stmt->bindParam(":Codigo", $producto->Codigo, PDO::PARAM_STR);
		$stmt->bindParam(":Nombre", $producto->Nombre, PDO::PARAM_STR);
		$stmt->bindParam(":Precio_compra", $producto->Precio_compra, PDO::PARAM_STR);
		$stmt->bindParam(":Precio_venta", $producto->Precio_venta, PDO::PARAM_STR);
        $stmt->bindParam(":Id_proveedor", $producto->Id_proveedor, PDO::PARAM_STR);
        $stmt->bindParam(":Id_producto", $producto->Id_producto, PDO::PARAM_STR);

		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
    }

    public static function mdlEliminarProducto($tabla,$item,$valor)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set Estado = 0 WHERE $item = :$item;");
		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
	}
}
?>