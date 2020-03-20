<?php 
require_once "conexion.php";

class ModeloSolicitud
{
	public static function mdlMostrarSolicitudes($tabla,$item,$valor,$tipo)
	{
		if ($item==null && $tipo == null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE tipo = :tipo");
			$stmt->bindParam(":tipo",$tipo,PDO::PARAM_STR);	
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

	public static function mdlMostrarReferencias($tabla,$item,$valor)
	{
		if ($item!=null)
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item = :$item");
			$stmt->bindParam(":".$item,$valor,PDO::PARAM_STR);
			$stmt->execute();
			return $stmt->fetchAll();
		}
		else
		{
			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla");
			$stmt->execute();
			return $stmt->fetchAll();
		}
		$stmt->close();
	}

	public static function mdlMostrarTablaSolicitudes($tabla,$status,$almacen,$tipo)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE status = :status and id_almacen = :id_almacen and tipo = :tipo");
		$stmt->bindParam(":tipo",$tipo,PDO::PARAM_STR);	
		$stmt->bindParam(":status",$status,PDO::PARAM_STR);
		$stmt->bindParam(":id_almacen",$almacen,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
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

	public static function mdlCrearRelacion($idSolicitudCliente,$idSolicitudConyuge)
	{
		$stmt = Conexion::conectar()->prepare("INSERT INTO cliente_conyuge(id_solicitud_cliente,id_solicitud_conyuge) VALUES (:id_solicitud_cliente,:id_solicitud_conyuge)");
		$stmt->bindParam(":id_solicitud_cliente",$idSolicitudCliente,PDO::PARAM_STR);
		$stmt->bindParam(":id_solicitud_conyuge",$idSolicitudConyuge,PDO::PARAM_STR);
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
		$stmt = $link->prepare("INSERT INTO $tabla(id_cliente, num_placas, estado_civil, casa, profesion, empresa, dom_empresa, tel_empresa, tiempo_casa, puesto, sueldo, antiguedad, gastos_mensuales,fecha, id_almacen,foto,tipo) VALUES (:id_cliente, :num_placas, :estado_civil, :casa, :profesion, :empresa, :dom_empresa, :tel_empresa, :tiempo_casa, :puesto, :sueldo, :antiguedad, :gastos_mensuales,:fecha, :id_almacen,:foto,:tipo)");

		$stmt->bindParam(":id_cliente",$datos["id_cliente"],PDO::PARAM_STR);
		$stmt->bindParam(":num_placas",$datos["num_placas"],PDO::PARAM_STR);
		$stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
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

	static public function mdlEditarSolicitud($tabla,$datos)
	{
		$stmt=Conexion::conectar()->prepare("UPDATE $tabla 
		SET
		num_placas=:num_placas,
		estado_civil=:estado_civil,
		casa=:casa,
		profesion=:profesion,
		empresa=:empresa,
		dom_empresa=:dom_empresa,
		tel_empresa=:tel_empresa,
		tiempo_casa=:tiempo_casa,
		puesto=:puesto,
		sueldo=:sueldo,
		antiguedad=:antiguedad,
		gastos_mensuales=:gastos_mensuales,
		foto=:foto
		WHERE id_solicitud = :id_solicitud");

		$stmt->bindParam(":id_solicitud",$datos["id_solicitud"],PDO::PARAM_STR);
		$stmt->bindParam(":num_placas",$datos["num_placas"],PDO::PARAM_STR);
		$stmt->bindParam(":estado_civil",$datos["estado_civil"],PDO::PARAM_STR);
		$stmt->bindParam(":casa",$datos["casa"],PDO::PARAM_STR);
		$stmt->bindParam(":profesion",$datos["profesion"],PDO::PARAM_STR);
		$stmt->bindParam(":empresa",$datos["nombre_empresa"],PDO::PARAM_STR);
		$stmt->bindParam(":dom_empresa",$datos["dom_empresa"],PDO::PARAM_STR);
		$stmt->bindParam(":tel_empresa",$datos["tel_empresa"],PDO::PARAM_STR);
		$stmt->bindParam(":tiempo_casa",$datos["tiempo_casa"],PDO::PARAM_STR);
		$stmt->bindParam(":puesto",$datos["puesto"],PDO::PARAM_STR);
		$stmt->bindParam(":sueldo",$datos["sueldo"],PDO::PARAM_STR);
		$stmt->bindParam(":antiguedad",$datos["antiguedad"],PDO::PARAM_STR);
		$stmt->bindParam(":gastos_mensuales",$datos["gastos_mensuales"],PDO::PARAM_STR);
		$stmt->bindParam(":foto",$datos["foto"],PDO::PARAM_STR);

		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
	}

	static public function mdlEditarReferencia($tabla,$datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla 
			SET 
			nombre=:nombre,
			direccion=:direccion,
			telefono=:telefono
			WHERE id_referencia = :id_referencia");

		$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono",$datos["telefono"],PDO::PARAM_STR);
		$stmt->bindParam(":id_referencia",$datos["id_referencia"],PDO::PARAM_INT);

		if($stmt->execute())
		{
			return "ok";	
		}
		else
		{
			return "error";	
		}
		$stmt->close();
	}

	static public function mdlActualizarSolicitud($tabla,$item1,$valor1,$item2,$valor2)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");
		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);
		if($stmt -> execute())
		{
			return "ok";	
		}
		else
		{
			return "error";	
		}
		$stmt -> close();
		$stmt = null;
	}
}