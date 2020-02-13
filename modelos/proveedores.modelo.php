<?php
require_once "conexion.php";
class ModeloProveedores{
    public $Id;
    public $Nombre;
    public $Direccion;
    public $RFC;
    public $Telefono;
    public $Ejecutivo;
	public $Correo;
	public $Cuenta_bancaria;
	public $Categoria;
    public $Estado;

    function __construct($Id, $Nombre, $Direccion, $RFC, $Telefono, $Ejecutivo, $Correo, $Cuenta_bancaria, $Categoria, $Estado)
	{
		$this->Id=$Id;
		$this->Nombre=$Nombre;
		$this->Direccion=$Direccion;
        $this->RFC=$RFC;
        $this->Telefono=$Telefono;
        $this->Ejecutivo=$Ejecutivo;
		$this->Correo=$Correo;
		$this->Cuenta_bancaria=$Cuenta_bancaria;
		$this->Categoria=$Categoria;
        $this->Estado=$Estado;
	}

    public static function mdlMostrarProveedores($tabla,$item,$valor)
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

    public static function mdlCrearProveedor($tabla,$proveedor)
	{
		$stmt = Conexion::Conectar()->prepare("INSERT INTO $tabla VALUES(NULL, :Nombre, :Direccion, :RFC, :Telefono, :Ejecutivo, :Correo, :Cuenta_bancaria, :Categoria, :Estado);");

		$stmt->bindParam(":Nombre", $proveedor->Nombre, PDO::PARAM_STR);
		$stmt->bindParam(":Direccion", $proveedor->Direccion, PDO::PARAM_STR);
		$stmt->bindParam(":RFC", $proveedor->RFC, PDO::PARAM_STR);
		$stmt->bindParam(":Telefono", $proveedor->Telefono, PDO::PARAM_STR);
		$stmt->bindParam(":Ejecutivo", $proveedor->Ejecutivo, PDO::PARAM_STR);
		$stmt->bindParam(":Correo", $proveedor->Correo, PDO::PARAM_STR);
		$stmt->bindParam(":Cuenta_bancaria", $proveedor->Cuenta_bancaria, PDO::PARAM_STR);
		$stmt->bindParam(":Categoria", $proveedor->Categoria, PDO::PARAM_STR);
		$stmt->bindParam(":Estado", $proveedor->Estado, PDO::PARAM_STR);

		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
	}

    public static function mdlEditarProveedor($tabla,$proveedor)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set Nombre = :Nombre, Direccion = :Direccion, RFC = :RFC, Telefono = :Telefono, Ejecutivo = :Ejecutivo, Correo = :Correo, Cuenta_bancaria = :Cuenta_bancaria, Categoria = :Categoria WHERE Id_proveedor = :Id_proveedor;");

        $stmt->bindParam(":Nombre", $proveedor->Nombre, PDO::PARAM_STR);
        $stmt->bindParam(":Direccion", $proveedor->Direccion, PDO::PARAM_STR);
        $stmt->bindParam(":RFC", $proveedor->RFC, PDO::PARAM_STR);
        $stmt->bindParam(":Telefono", $proveedor->Telefono, PDO::PARAM_STR);
        $stmt->bindParam(":Ejecutivo", $proveedor->Ejecutivo, PDO::PARAM_STR);
		$stmt->bindParam(":Correo", $proveedor->Correo, PDO::PARAM_STR);
		$stmt->bindParam(":Cuenta_bancaria", $proveedor->Cuenta_bancaria, PDO::PARAM_STR);
		$stmt->bindParam(":Categoria", $proveedor->Categoria, PDO::PARAM_STR);
		$stmt->bindParam(":Id_proveedor",$proveedor->Id,PDO::PARAM_STR);

		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
	}

    public static function mdlEliminarProveedor($tabla,$item,$valor)
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