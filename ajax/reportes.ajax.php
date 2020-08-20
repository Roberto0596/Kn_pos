<?php 

require_once "../controladores/reportes.controlador.php";
require_once "../modelos/reportes.modelo.php";

require_once "../controladores/proveedores.controlador.php";
require_once "../modelos/proveedores.modelo.php";

require_once "../controladores/compra.controlador.php";
require_once "../modelos/compra.modelo.php";

require_once "../controladores/crearventa.controlador.php";
require_once "../modelos/crearventa.modelo.php";

require_once "../controladores/abonos.controlador.php";
require_once "../modelos/abonos.modelo.php";


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

	public $clientId;

	public function ajaxTraerVentasCliente()
	{
		$item = "Id_cliente";
		$valor = $this->clientId;
		$respuesta = ControladorVentas::ctrMostrarClienteVentas($item,$valor);
		echo json_encode($respuesta);
	}

	public function ajaxTraerVentas()
	{
		$respuesta = ControladorVentas::ctrMostrarVentas(null,null);
		echo json_encode($respuesta);
	}

	public $folio;

	public function ajaxTraerProductos()
	{
		$respuesta = ControladorVentas::ctrMostrarVentas("Folio",$this->folio);
		echo json_encode($respuesta["ListaProductos"]);
	}

	public $fechaInicial;
	public $fechaFinal;

	public function ajaxTraerVentasPorFecha()
	{
		$valor1 = $this->fechaInicial;
		$valor2 = $this->fechaFinal;
		$respuesta = ControladorVentas::ctrMostrarVentasPorFecha($valor1,$valor2);
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

if (isset($_POST["activar"]))
{
	$mostrar = new AjaxReportes();
	$mostrar->ajaxTraerVentas();
}

if (isset($_POST["folio"]))
{
	$mostrar = new AjaxReportes();
	$mostrar-> folio = $_POST["folio"];
	$mostrar->ajaxTraerProductos();
}


if (isset($_POST["fechaFinal"]))
{
	$mostrar = new AjaxReportes();
	$mostrar-> fechaInicial = $_POST["fechaInicial"];
	$mostrar-> fechaFinal = $_POST["fechaFinal"];
	$mostrar->ajaxTraerVentasPorFecha();
}

if (isset($_POST["clientId"]))
{
	$mostrar = new AjaxReportes();
	$mostrar-> clientId = $_POST["clientId"];
	$mostrar->ajaxTraerVentasCliente();
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
