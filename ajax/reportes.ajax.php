<?php 

require_once "../controladores/reportes.controlador.php";
require_once "../modelos/reportes.modelo.php";

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

require_once "../controladores/compra.controlador.php";
require_once "../modelos/compra.modelo.php";

class AjaxReportes
{
	public $id_proveedor;

	public function ajaxMostrarProveedores()
	{
		$item = "id_proveedor";
		$valor = $this->id_proveedor;
		$respuesta = ControladorProveedores::ctrMostrarProveedores($item,$valor);
		echo json_encode($respuesta);
	}

	public $id_proveedor_compras;
	public $item_compras;

	public function ajaxMostrarCompras()
	{
		$item = $this->item_compras;
		if ($item=="Folio")
		{
			$valor = $this->id_proveedor_compras;
			$respuesta = ControladorCompra::ctrMostrarCompras($item,$valor);
			echo json_encode($respuesta);
		}
		else
		{
			$valor = $this->id_proveedor_compras;
			$respuesta = ControladorCompra::ctrMostrarComprasPorProveedor($item,$valor);
			echo json_encode($respuesta);
		}
	}
}


if (isset($_POST["id_proveedor"]))
{
	$mostrar = new AjaxReportes();
	$mostrar-> id_proveedor = $_POST["id_proveedor"];
	$mostrar->ajaxMostrarProveedores();
}

if (isset($_POST["idProveedor"]))
{
	$mostrar = new AjaxReportes();
	$mostrar-> id_proveedor_compras = $_POST["idProveedor"];
	$mostrar-> item_compras = $_POST["item_compras"];
	$mostrar->ajaxMostrarCompras();
}
