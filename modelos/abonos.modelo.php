<?php
require_once "conexion.php";

class ModeloAbonos
{
	public $Id;
    public $Folio_venta;
    public $Folio_pago;
    public $Fecha_vencimiento;
    public $Fecha_pago;
    public $Numero_abono;
	public $Cantidad;
	public $Saldo;
    public $Estado;

    function __construct($Id, $Folio_venta, $Folio_pago, $Fecha_vencimiento, $Fecha_pago, $Numero_abono, $Cantidad, $Saldo, $Estado)
	{
		$this->Id=$Id;
		$this->Folio_venta=$Folio_venta;
		$this->Folio_pago=$Folio_pago;
        $this->Fecha_vencimiento=$Fecha_vencimiento;
        $this->Fecha_pago=$Fecha_pago;
        $this->Numero_abono=$Numero_abono;
		$this->Cantidad=$Cantidad;
		$this->Saldo=$Saldo;
        $this->Estado=$Estado;
	}

	public function mdlMostrarAbonos($tabla,$item,$valor)
	{
		if ($item!=null)
		{
			$stmt=conexion::conectar()->prepare("SELECT * from $tabla where $item = :$item ORDER BY folio_pago ASC;");
			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		else
		{
			$stmt=conexion::conectar()->prepare("SELECT * from $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}

	public function mdlValidarUltimoPago($valor1,$valor2)
	{
		$stmt=conexion::conectar()->prepare("SELECT * from abonos where Folio_venta = :Folio_venta and Fecha_vencimiento = :Fecha_vencimiento");
		$stmt->bindParam(":Folio_venta",$valor1,PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_vencimiento",$valor2,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function mdlTraerUltimoFolio($tabla)
	{
		$stmt=conexion::conectar()->prepare("SELECT * from $tabla ORDER BY folio_pago DESC LIMIT 1;");
		$stmt->execute();
		return $stmt->fetch();
	}

	public function mdlRegistrarAbono($tabla,$abono)
	{
		$conexion = Conexion::Conectar();
		$stmt = $conexion->prepare("INSERT INTO $tabla VALUES(NULL, :Folio_venta, :Folio_pago, :Fecha_vencimiento, :Fecha_pago, :Numero_abono, :Cantidad, :Saldo, :Estado);");

		$stmt->bindParam(":Folio_venta", $abono->Folio_venta, PDO::PARAM_STR);
		$stmt->bindParam(":Folio_pago", $abono->Folio_pago, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_vencimiento", $abono->Fecha_vencimiento, PDO::PARAM_STR);
		$stmt->bindParam(":Fecha_pago", $abono->Fecha_pago, PDO::PARAM_STR);
		$stmt->bindParam(":Numero_abono", $abono->Numero_abono, PDO::PARAM_STR);
		$stmt->bindParam(":Cantidad", $abono->Cantidad, PDO::PARAM_STR);
		$stmt->bindParam(":Saldo", $abono->Saldo, PDO::PARAM_STR);
		$stmt->bindParam(":Estado", $abono->Estado, PDO::PARAM_STR);

		if ($stmt->execute())
		{
			$abono->Id = $conexion->lastInsertId();
			return "ok";
		}
		else
		{
			return "error";
		}
	}

	public function mdlEliminarAbono($tabla,$idAbono)
	{
		$stmt = conexion::conectar()->prepare("DELETE from $tabla where id_abono = :id_abono;");
		$stmt->bindParam(":id_abono",$idAbono,PDO::PARAM_STR);

		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
		$stmt->close();
		$stmt=null;
	}

	static public function mdlMostrarAbonosPorFecha($fechaInicial,$fechaFinal)
	{
		if($fechaInicial == null)
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM abonos where fecha_pago = '$fechaFinal'");
			$stmt -> execute();
			return $stmt -> fetchAll();	
		}
		else if($fechaInicial == $fechaFinal)
		{
			$stmt = conexion::conectar()->prepare("SELECT * FROM abonos WHERE fecha_pago like '%$fechaFinal%'");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM abonos WHERE fecha_pago BETWEEN '$fechaInicial' AND '$fechaFinal'");
			$stmt -> execute();
			return $stmt -> fetchAll();
		}
		$stmt -> close();
		$stmt = null;
	}

}