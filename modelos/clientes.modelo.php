<?php 
require_once "conexion.php";
class ModeloClientes
{
	public static function mdlMostrarClientes($tabla,$item,$valor)
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

	public static function mdlEditarCliente($tabla,$datos)
	{
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla set 
		nombre = :nombre,
		direccion = :direccion,
		edad = :edad,
		telefono_casa = :telefono_casa,
		telefono_celular = :telefono_celular,
		codigo_postal = :codigo_postal,
		ciudad = :ciudad WHERE id_cliente = :id_cliente");

		$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
		$stmt->bindParam(":codigo_postal",$datos["codigo_postal"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono_casa",$datos["telefono_casa"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono_celular",$datos["telefono_celular"],PDO::PARAM_STR);
		$stmt->bindParam(":ciudad",$datos["ciudad"],PDO::PARAM_STR);
		$stmt->bindParam(":edad",$datos["edad"],PDO::PARAM_STR);
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

	public static function mdlCrearCliente($tabla,$datos)
	{
		$stmt = Conexion::Conectar()->prepare("INSERT INTO $tabla(nombre,direccion,codigo_postal,telefono_casa,telefono_celular,ciudad,edad,tipo) VALUES(:nombre,:direccion,:codigo_postal,:telefono_casa,:telefono_celular,:ciudad,:edad,:tipo)");
		
		$stmt->bindParam(":nombre",$datos["nombre"],PDO::PARAM_STR);
		$stmt->bindParam(":direccion",$datos["direccion"],PDO::PARAM_STR);
		$stmt->bindParam(":codigo_postal",$datos["codigo_postal"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono_casa",$datos["telefono_casa"],PDO::PARAM_STR);
		$stmt->bindParam(":telefono_celular",$datos["telefono_celular"],PDO::PARAM_STR);
		$stmt->bindParam(":ciudad",$datos["ciudad"],PDO::PARAM_STR);
		$stmt->bindParam(":edad",$datos["edad"],PDO::PARAM_STR);
		$stmt->bindParam(":tipo",$datos["tipo"],PDO::PARAM_STR);

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