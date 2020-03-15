<?php
require_once "conexion.php";

class ModeloCompras
{
    public $Id_venta;
    public $Folio;
    public $Id_usuario;
    public $Id_proveedor;
    public $Id_almacen;
    public $Fecha;
    public $Hora;
    public $ListaProductos;
    public $TotalVenta;

    function __construct($Id_venta, $Folio, $Id_usuario, $Id_proveedor, $Id_almacen, $Fecha, $Hora, $ListaProductos, $TotalVenta)
	{
		$this->Id_venta = $Id_venta;
		$this->Folio = $Folio;
		$this->Id_usuario = $Id_usuario;
		$this->Id_proveedor = $Id_proveedor;
        $this->Id_almacen = $Id_almacen;
        $this->Fecha = $Fecha;
		$this->Hora = $Hora;
		$this->ListaProductos = $ListaProductos;
        $this->TotalVenta = $TotalVenta;
    }

    public  static function mdlNuevoFolio()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM compras ORDER BY Id_compra DESC LIMIT 1;");
        $stmt->execute();
		$IdAlta = $stmt->fetch();

		if ($IdAlta == false)
		{
			return "10001";
		}
		else
		{
			return $IdAlta['Folio'] + 1;
		}
    }

    public static function mdlMostrarCompras($tabla,$item,$valor)
	{
		if ($item==null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla;");
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


    public static function mdlCrearCompra($tabla,$venta)
	{
		$stmt = Conexion::Conectar()->prepare("INSERT INTO $tabla VALUES(NULL, :Folio, :Id_usuario, :Id_proveedor, :Id_almacen, :Fecha, :Hora, :ListaProductos, :TotalVenta);");
		$stmt->bindParam(":Folio", $venta->Folio, PDO::PARAM_STR);
		$stmt->bindParam(":Id_usuario", $venta->Id_usuario, PDO::PARAM_STR);
		$stmt->bindParam(":Id_proveedor", $venta->Id_proveedor, PDO::PARAM_STR);
		$stmt->bindParam(":Id_almacen", $venta->Id_almacen, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha", $venta->Fecha, PDO::PARAM_STR);
		$stmt->bindParam(":Hora", $venta->Hora, PDO::PARAM_STR);
		$stmt->bindParam(":ListaProductos", $venta->ListaProductos, PDO::PARAM_STR);
		$stmt->bindParam(":TotalVenta", $venta->TotalVenta, PDO::PARAM_STR);
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