<?php 
require_once "conexion.php";
class ModeloSolicitud
{
	public static function mdlMostrarSolicitudes($tabla,$item,$valor)
	{
		if ($item==null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
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

	public static function mdlEliminarSolicitud($tabla,$item,$valor)
	{
		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE $item = :$item");
		$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
		
		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
		$stmt->close();
	}

	public static function mdlCrearReferencia($tabla, $datos)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO referencias(nombre, direccion, telefono, tipo, id_solicitud) VALUES (:nombre, :direccion, :telefono, :tipo, :id_solicitud)");
		$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
		$stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
		$stmt->bindParam(":id_solicitud",$datos["id_solicitud"],PDO::PARAM_STR);
		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
	}

	public static function mdlCrearSolicitud($tabla,$datos)
	{
		$link = new PDO("mysql:host=localhost;dbname=kn_pos","root","");
		$stmt = $link->prepare("INSERT INTO $tabla(id_cliente, num_placas, estado_civil, casa, profesion, empresa, dom_empresa, tel_empresa, tiempo_casa, puesto, sueldo, antiguedad, gastos_mensuales,fecha, id_almacen,foto) VALUES (:id_cliente, :num_placas, :estado_civil, :casa, :profesion, :empresa, :dom_empresa, :tel_empresa, :tiempo_casa, :puesto, :sueldo, :antiguedad, :gastos_mensuales,:fecha, :id_almacen,:foto)");

		$stmt->bindParam(":id_cliente",$datos["id_cliente"],PDO::PARAM_STR);
		$stmt->bindParam(":num_placas",$datos["num_placas"],PDO::PARAM_STR);
		$stmt->bindParam(":estado_civil",$datos["estado_civil"],PDO::PARAM_STR);
		$stmt->bindParam(":casa",$datos["casa"],PDO::PARAM_STR);
		$stmt->bindParam(":tiempo_casa",$datos["tiempo_casa"],PDO::PARAM_STR);
		$stmt->bindParam(":gastos_mensuales",$datos["gastos_mensuales"],PDO::PARAM_STR);
		$stmt->bindParam(":empresa",$datos["nombre_empresa"],PDO::PARAM_STR);
		$stmt->bindParam(":dom_empresa",$datos["dom_empresa"],PDO::PARAM_STR);
		$stmt->bindParam(":tel_empresa",$datos["tel_empresa"],PDO::PARAM_STR);
		$stmt->bindParam(":puesto",$datos["puesto"],PDO::PARAM_STR);
		$stmt->bindParam(":sueldo",$datos["sueldo"],PDO::PARAM_STR);
		$stmt->bindParam(":antiguedad",$datos["antiguedad"],PDO::PARAM_STR);
		$stmt->bindParam(":profesion",$datos["profesion"],PDO::PARAM_STR);
		$stmt->bindParam(":fecha",$datos["fecha"],PDO::PARAM_STR);
		$stmt->bindParam(":foto",$datos["foto"],PDO::PARAM_STR);
		$stmt->bindParam(":id_almacen",$datos["id_almacen"],PDO::PARAM_STR);

		if ($stmt->execute())
		{
			return $link->lastInsertId();
		}
		else
		{
			return "error";
		}
	}
}