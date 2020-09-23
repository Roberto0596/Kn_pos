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

	public $fechaInicialProveedor;
	public $fechaFinalProveedor;
	public $proveedorCompras;

	public function ajaxTraerComprasPorFecha()
	{
		$valor1 = $this->fechaInicialProveedor;
		$valor2 = $this->fechaFinalProveedor;
		$proveedor = $this->proveedorCompras;
		$respuesta = ControladorCompra::ctrMostrarComprasPorFecha($proveedor,$valor1,$valor2);
		echo json_encode($respuesta);
	}

    public $rango;

    public function ajaxTraerTotalVenta()
    {
        $response = $this->rango;
        $total = 0;
        if ($response==null)
        {
            $respuesta = ModeloVentas::mdlMostrarVentasContado();

            foreach ($respuesta as $key => $value)
            {
                $total+=$value["TotalVenta"];
            }
        }
        else
        {
            $fechas = explode("|", $response);
            if (count($fechas)==2) {
                $respuesta = ModeloVentas::mdlMostrarVentasContadoPorFecha($fechas[0],$fechas[1]);
            }else{
                $respuesta = ModeloVentas::mdlMostrarVentasContadoPorFecha(null,$fechas[0]);
            }
            foreach ($respuesta as $key => $value)
            {
                $total+=$value["TotalVenta"];
            }
        }
        echo json_encode($total);
    }

    public $fecha;

    public function ajaxCargarTotal()
    {
        $response = $this->fecha;
        $total = 0;
        if ($response==null)
        {
            date_default_timezone_set('America/Hermosillo');
            $fecha = date("Y-m-d");
            $item = "fecha_pago";
            $respuesta = ControladorAbonos::ctrMostrarAbonos($item,$fecha);

            foreach ($respuesta as $key => $value)
            {
                $total+=$value["cantidad"];
            }
        }
        else
        {
            $fechas = explode("|", $response);
            if (count($fechas)==2) {
                $respuesta = ModeloAbonos::mdlMostrarAbonosPorFecha($fechas[0],$fechas[1]);
            }else{
                $respuesta = ModeloAbonos::mdlMostrarAbonosPorFecha(null,$fechas[0]);
            }
            foreach ($respuesta as $key => $value)
            {
                $total+=$value["cantidad"];
            }
        }

        echo json_encode($total);
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

if (isset($_POST["rango"]))
{
    $mostrar = new AjaxReportes();
    $mostrar-> rango = $_POST["rango"];
    $mostrar->ajaxTraerTotalVenta();
}

if (isset($_POST["fechas"]))
{
    $mostrar = new AjaxReportes();
    $mostrar-> fecha = $_POST["fechas"];
    $mostrar->ajaxCargarTotal();
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

if (isset($_POST["fechaInicialProveedor"]))
{
	$mostrar = new AjaxReportes();
	$mostrar-> fechaInicialProveedor = $_POST["fechaInicialProveedor"];
	$mostrar-> fechaFinalProveedor = $_POST["fechaFinalProveedor"];
	$mostrar-> proveedorCompras = $_POST["proveedorCompras"];
	$mostrar->ajaxTraerComprasPorFecha();
}

