<?php

require_once "../../controladores/abonos.controlador.php";
require_once "../../modelos/abonos.modelo.php";
require_once "../../controladores/crearventa.controlador.php";
require_once "../../modelos/crearventa.modelo.php";
require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";

class TablaCorteAbono
{
	public function MostrarTabla()
	{
		if (isset($_POST["fecha"]))
		{
			$res = [ "data" => []];
			if ($_POST["fecha"]==null)
			{
				date_default_timezone_set('America/Hermosillo');
				$fecha = date("Y-m-d");
				$item = "fecha_pago";
				$respuesta = ControladorAbonos::ctrMostrarAbonos($item,$fecha);
			}
			else
			{
				$fechas = explode("|", $_POST["fecha"]);
				if (count($fechas)==2) {
					$respuesta = ModeloAbonos::mdlMostrarAbonosPorFecha($fechas[0],$fechas[1]);
				}else{
					$respuesta = ModeloAbonos::mdlMostrarAbonosPorFecha(null,$fechas[0]);
				}				
			}
			foreach ($respuesta as $key => $value) 
			{
				$venta = ControladorVentas::ctrMostrarVentas("Folio",$value["folio_venta"]);

				$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$venta["Id_cliente"],null);

				array_push($res['data'], [
					($key+1),
					$value["folio_venta"],
					$cliente["nombre"],
					$cliente["direccion"]!=null?$cliente["direccion"]:"N/A",
					$cliente["telefono_casa"]!=null?$cliente["telefono_casa"]:"N/A",
					$value["fecha_pago"],
					"$".number_format($value["cantidad"],2),
					"$".number_format($value["saldo"],2)
				]);
			}
			echo json_encode($res);
		}
	}
}

$abonos = new TablaCorteAbono();
$abonos->MostrarTabla();