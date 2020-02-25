<?php
require_once "conexion.php";
class ModeloVentas{
    public $Id_venta;
    public $Folio;
    public $Id_usuario;
    public $Id_cliente;
    public $Id_almacen;
    public $Fecha;
    public $Hora;
    public $ListaProductos;
    public $TotalVenta;
	public $TotalPago;

    function __construct($Id_venta, $Folio, $Id_usuario, $Id_cliente, $Id_almacen, $Fecha, $Hora, $ListaProductos, $TotalVenta, $TotalPago)
	{
		$this->Id_venta = $Id_venta;
		$this->Folio = $Folio;
		$this->Id_usuario = $Id_usuario;
		$this->Id_cliente = $Id_cliente;
        $this->Id_almacen = $Id_almacen;
        $this->Fecha = $Fecha;
		$this->Hora = $Hora;
		$this->ListaProductos = $ListaProductos;
        $this->TotalVenta = $TotalVenta;
        $this->TotalPago = $TotalPago;
    }

    public  static function mdlNuevoFolio()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM ventas ORDER BY Id_venta DESC LIMIT 1;");
        $stmt->execute();
		$IdAlta = $stmt->fetch();
		return $IdAlta['Folio'] + 1;
    }

    public static function mdlMostrarVentas($tabla,$item,$valor)
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


    public static function mdlCrearVenta($tabla,$venta)
	{
		$stmt = Conexion::Conectar()->prepare("INSERT INTO $tabla VALUES(NULL, :Folio, :Id_usuario, :Id_cliente, :Id_almacen, :Fecha, :Hora, :ListaProductos, :TotalVenta, :TotalPago);");

		$stmt->bindParam(":Folio", $venta->Folio, PDO::PARAM_STR);
		$stmt->bindParam(":Id_usuario", $venta->Id_usuario, PDO::PARAM_STR);
		$stmt->bindParam(":Id_cliente", $venta->Id_cliente, PDO::PARAM_STR);
		$stmt->bindParam(":Id_almacen", $venta->Id_almacen, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha", $venta->Fecha, PDO::PARAM_STR);
		$stmt->bindParam(":Hora", $venta->Hora, PDO::PARAM_STR);
		$stmt->bindParam(":ListaProductos", $venta->ListaProductos, PDO::PARAM_STR);
		$stmt->bindParam(":TotalVenta", $venta->TotalVenta, PDO::PARAM_STR);
		$stmt->bindParam(":TotalPago", $venta->TotalPago, PDO::PARAM_STR);

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