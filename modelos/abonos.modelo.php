<?php
require_once "conexion.php";

class ModeloAbonos
{
	public function mdlMostrarAbonos($tabla,$item,$valor)
	{
		if ($item!=null)
		{
			$stmt=conexion::conectar()->prepare("SELECT * from $tabla where $item = :valor ORDER BY folio_pago ASC;");
			$stmt->bindParam(":valor",$valor,PDO::PARAM_STR);
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

	public function mdlMostrarUltimoAbono($tabla,$folioVenta)
	{
		$stmt=conexion::conectar()->prepare("SELECT * from $tabla where folio_venta = :folioVenta ORDER BY folio_pago DESC LIMIT 1;");
		$stmt->bindParam(":folioVenta",$folioVenta,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
	}

	public function mdlAgregarAbono($tabla,$datos)
	{
		$stmt = conexion::conectar()->prepare("INSERT into $tabla(nombre,ubicacion,estado) values(:nombre,:ubicacion,:estado);");
		$stmt->bindParam(":nombre",$datos["nombreAlmacen"],PDO::PARAM_STR);
		$stmt->bindParam(":ubicacion",$datos["ubicacion"],PDO::PARAM_STR);
		$stmt->bindParam(":estado",$datos["estadoInicial"],PDO::PARAM_STR);

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

}