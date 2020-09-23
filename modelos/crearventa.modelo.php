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
	public $Descuento;
	public $Pendiente;
	public $CalendarioAbonos;
	public $TipoAbono;
	public $TipoVenta;
	public $FolioFact;

    function __construct($Id_venta, $Folio, $Id_usuario, $Id_cliente, $Id_almacen, $Fecha, $Hora, $ListaProductos, $TotalVenta, $TotalPago, $Descuento, $Pendiente, $CalendarioAbonos, $TipoAbono, $TipoVenta, $FolioFact)
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
		$this->Descuento = $Descuento;
		$this->Pendiente = $Pendiente;
		$this->CalendarioAbonos = $CalendarioAbonos;
		$this->TipoAbono = $TipoAbono;
		$this->TipoVenta = $TipoVenta;
		$this->FolioFact = $FolioFact;
    }

    public  static function mdlNuevoFolio()
    {
        $stmt = Conexion::conectar()->prepare("SELECT * FROM ventas ORDER BY Id_venta DESC LIMIT 1;");
        $stmt->execute();
        $IdAlta = $stmt->fetch();
        if ($IdAlta)
        {
			return $IdAlta['Folio'] + 1;
        }
        else
        {
        	return "10001";
        }

    }

    public static function mdlMostrarCreditos($idCliente)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE Pendiente > 0 and TipoVenta = 0 AND Id_cliente = :idCliente ORDER BY Folio DESC;");
		$stmt->bindParam(":idCliente", $idCliente, PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
	}

	public static function mdlAbonar($tabla,$item,$valor,$nuevoSaldo)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set Pendiente = :saldo WHERE $item = :$item;");
		$stmt->bindParam(":saldo", $nuevoSaldo, PDO::PARAM_STR);
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

	public static function mdlMCalendario($item,$valor,$nuevoValor)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE ventas set CalendarioAbonos = :calendario WHERE $item = :$item;");
		$stmt->bindParam(":calendario", $nuevoValor, PDO::PARAM_STR);
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

	static public function mdlMostrarVentas($item,$valor)
	{
		if ($item != null)
		{
			$stmt = Conexion::Conectar()->prepare("SELECT * FROM ventas WHERE $item = :$item");
			$stmt -> bindParam(":".$item,$valor,PDO::PARAM_STR);
			$stmt -> execute();
			return $stmt -> fetch();
		}
		else
		{
			$stmt = Conexion::Conectar()->prepare("SELECT * FROM ventas");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}

    static public function mdlMostrarVentasContado()
    {
        $stmt = Conexion::Conectar()->prepare("SELECT * FROM ventas WHERE TipoVenta = 1");
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

    static public function mdlMostrarVentasCredito()
    {
    	$stmt = Conexion::Conectar()->prepare("SELECT * FROM ventas WHERE TipoVenta = 0");
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

    static public function mdlMostrarVentasCreditoCliente($item,$valor)
    {
        $stmt = Conexion::Conectar()->prepare("SELECT * FROM ventas WHERE $item = :$item and TipoVenta = 0");
        $stmt -> bindParam(":".$item,$valor,PDO::PARAM_STR);
        $stmt -> execute();
        return $stmt -> fetchAll();
    }

	static public function mdlMostrarClienteVentas($item,$valor)
	{
		$stmt = Conexion::Conectar()->prepare("SELECT * FROM ventas WHERE $item = :$item");
		$stmt -> bindParam(":".$item,$valor,PDO::PARAM_STR);
		$stmt -> execute();
		return $stmt -> fetchAll();
		$stmt -> close();
		$stmt = null;
	}

	static public function mdlMostrarVentasPorFecha($fechaInicial,$fechaFinal)
	{
		if($fechaInicial == null)
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM ventas ORDER BY id_venta ASC");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		else if($fechaInicial == $fechaFinal)
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM ventas WHERE fecha like '%$fechaFinal%'");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}

    static public function mdlMostrarVentasContadoPorFecha($fechaInicial,$fechaFinal)
    {
        if($fechaInicial == null)
        {
            $stmt = conexion::conectar()->prepare("SELECT * FROM ventas WHERE TipoVenta = 1 ORDER BY id_venta ASC");
            $stmt -> execute();
            return $stmt -> fetchAll();
        }
        else if($fechaInicial == $fechaFinal)
        {
            $stmt = conexion::conectar()->prepare("SELECT * FROM ventas WHERE TipoVenta = 1 and fecha like '%$fechaFinal%'");
            $stmt -> execute();
            return $stmt -> fetchAll();
        }
        else
        {
            $stmt = Conexion::conectar()->prepare("SELECT * FROM ventas WHERE TipoVenta = 1 and fecha BETWEEN '$fechaInicial' AND '$fechaFinal'");
            $stmt -> execute();
            return $stmt -> fetchAll();
        }
        $stmt -> close();
        $stmt = null;
    }

    public static function mdlCrearVenta($tabla,$venta)
	{
		$stmt = Conexion::Conectar()->prepare("INSERT INTO $tabla VALUES(NULL, :Folio, :Id_usuario, :Id_cliente, :Id_almacen, :Fecha, :Hora, :ListaProductos, :Descuento, :TotalVenta, :TotalPago, :Pendiente, :CalendarioAbonos, :TipoAbono, :TipoVenta, :FolioFact);");
		$stmt->bindParam(":Folio", $venta->Folio, PDO::PARAM_STR);
		$stmt->bindParam(":Id_usuario", $venta->Id_usuario, PDO::PARAM_STR);
		$stmt->bindParam(":Id_cliente", $venta->Id_cliente, PDO::PARAM_STR);
		$stmt->bindParam(":Id_almacen", $venta->Id_almacen, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha", $venta->Fecha, PDO::PARAM_STR);
		$stmt->bindParam(":Hora", $venta->Hora, PDO::PARAM_STR);
		$stmt->bindParam(":ListaProductos", $venta->ListaProductos, PDO::PARAM_STR);
		$stmt->bindParam(":Descuento", $venta->Descuento, PDO::PARAM_STR);
		$stmt->bindParam(":TotalVenta", $venta->TotalVenta, PDO::PARAM_STR);
		$stmt->bindParam(":TotalPago", $venta->TotalPago, PDO::PARAM_STR);
		$stmt->bindParam(":Pendiente", $venta->Pendiente, PDO::PARAM_STR);
		$stmt->bindParam(":CalendarioAbonos", $venta->CalendarioAbonos, PDO::PARAM_STR);
		$stmt->bindParam(":TipoAbono", $venta->TipoAbono, PDO::PARAM_STR);
		$stmt->bindParam(":TipoVenta", $venta->TipoVenta, PDO::PARAM_STR);
		$stmt->bindParam(":FolioFact", $venta->FolioFact, PDO::PARAM_STR);
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