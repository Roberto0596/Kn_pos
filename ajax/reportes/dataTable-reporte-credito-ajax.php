<?php

require_once "../../controladores/abonos.controlador.php";
require_once "../../modelos/abonos.modelo.php";
require_once "../../controladores/crearventa.controlador.php";
require_once "../../modelos/crearventa.modelo.php";
class TablaReporteCredito
{
	public function MostrarTabla()
	{
		if (isset($_POST["Folio"]))
		{
			$item = "folio_venta";
			$valor = $_POST["Folio"];
			$respuesta = ControladorAbonos::ctrMostrarAbonos($item,$valor);
			$res = [ "data" => []];
			if ($respuesta != false)
			{
				foreach($respuesta as $key => $value)
				{		
					if ($value["fecha_pago"]<=$value["fecha_vencimiento"])
					{
						$botonFecha = '<button class="btn btn-success">'.$value["fecha_pago"].'</button>';
					}
					else
					{
						$botonFecha = '<button class="btn btn-danger">'.$value["fecha_pago"].'</button>';
					}

					$venta = ControladorVentas::ctrMostrarVentas("Folio",$value["folio_venta"]);	

					$calendario = json_decode($venta["CalendarioAbonos"],true);

					array_push($res['data'], [
						($key+1),
						$value["folio_venta"],
						$value["folio_pago"],
						$value["fecha_vencimiento"],
						$botonFecha,
						$calendario[($value["numero_abono"]+1)]["Fecha"],
						$value["cantidad"],
						$value["saldo"],
					]);
				}	
			}
			echo json_encode($res);
		}
	}
}

$abonos = new TablaReporteCredito();
$abonos->MostrarTabla();