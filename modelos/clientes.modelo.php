<?php
require_once "conexion.php";
class ModeloClientes
{
	public static function mdlMostrarClientes($tabla,$item,$valor,$tipo)
	{
		if ($item==null)
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

	public static function mdlMostrarClientesCredito($valor)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM cliente WHERE Credito = :Credito");
		$stmt->bindParam(":Credito",$valor,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll();
		$stmt->close();
	}

	public static function mdlMostrarClienteCredito($idCliente)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM cliente WHERE id_cliente = :idCliente AND Credito = 1");
		$stmt->bindParam(":idCliente",$idCliente,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public static function mdlValidarCliente($tabla,$item1, $valor1, $item2,$valor2,$tipo)
	{
		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla WHERE $item1 = :$item1 and $item2 = :$item2  and tipo = :tipo");
		$stmt->bindParam(":tipo",$tipo,PDO::PARAM_STR);
		$stmt->bindParam(":".$item1,$valor1,PDO::PARAM_STR);
		$stmt->bindParam(":".$item2,$valor2,PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetch();
		$stmt->close();
	}

	public static function mdlEditarCliente($tabla,$datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set
		nombre = :nombre,
		direccion = :direccion,
		edad = :edad,
		telefono_casa = :telefono_casa,
		telefono_celular = :telefono_celular,
		codigo_postal = :codigo_postal,
		asentamiento = :asentamiento,
		historial = :historial,
		ciudad = :ciudad,
		Credito = :Credito WHERE id_cliente = :id_cliente");

		$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
		$stmt->bindParam(":codigo_postal",$datos["codigo_postal"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono_casa",$datos["telefono_casa"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono_celular",$datos["telefono_celular"],PDO::PARAM_STR);
		$stmt->bindParam(":ciudad",$datos["ciudad"],PDO::PARAM_STR);
		$stmt->bindParam(":edad",$datos["edad"],PDO::PARAM_STR);
		$stmt->bindParam(":historial",$datos["historial"],PDO::PARAM_STR);
		$stmt->bindParam(":asentamiento",$datos["asentamiento"],PDO::PARAM_STR);
		$stmt->bindParam(":Credito",$datos["Credito"],PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente",$datos["id_cliente"],PDO::PARAM_STR);

		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
	}

	public static function mdlEliminarCliente($tabla,$item,$valor)
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
	}

	public static function mdlCreditoCliente($valor, $idCliente)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE cliente SET Credito = :Credito WHERE id_cliente = :id_cliente");
		$stmt->bindParam(":Credito",$valor,PDO::PARAM_STR);
		$stmt->bindParam(":id_cliente",$idCliente,PDO::PARAM_STR);
		if ($stmt->execute())
		{
			return "ok";
		}
		else
		{
			return "error";
		}
	}

	public static function mdlCrearCliente($tabla,$datos)
	{
		$link = new PDO("mysql:host=localhost;dbname=kn_pos","root","");
		$stmt = $link->prepare("INSERT INTO $tabla(nombre,direccion,codigo_postal,telefono_casa,telefono_celular,ciudad,edad,tipo,asentamiento,historial,Credito) VALUES(:nombre,:direccion,:codigo_postal,:telefono_casa,:telefono_celular,:ciudad,:edad,:tipo,:asentamiento,:historial,:Credito)");

		$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
		$stmt->bindParam(":codigo_postal",$datos["codigo_postal"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono_casa",$datos["telefono_casa"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono_celular",$datos["telefono_celular"],PDO::PARAM_STR);
		$stmt->bindParam(":ciudad",$datos["ciudad"],PDO::PARAM_STR);
		$stmt->bindParam(":edad",$datos["edad"],PDO::PARAM_STR);
		$stmt->bindParam(":asentamiento",$datos["asentamiento"],PDO::PARAM_STR);
		$stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);
		$stmt->bindParam(":historial",$datos["historial"],PDO::PARAM_STR);
		$stmt->bindParam(":Credito",$datos["Credito"],PDO::PARAM_STR);
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