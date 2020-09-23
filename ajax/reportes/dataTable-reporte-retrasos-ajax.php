<?php

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";
require_once "../../controladores/crearventa.controlador.php";
require_once "../../modelos/crearventa.modelo.php";
require_once "../../controladores/abonos.controlador.php";
require_once "../../modelos/abonos.modelo.php";
error_reporting(0);
class TablaReporteContado
{
	public function MostrarTabla()
	{
		$ventas = ControladorVentas::ctrMostrarVentasCredito(null,null,0);
		$res = [ "data" => []];
		$count;
		foreach ($ventas as $key1 => $value)
		{
			try {
				$cliente = ControladorClientes::ctrMostrarClientes("id_cliente", $value["Id_cliente"], null);	
				$abono = ControladorAbonos::ctrUltimoAbono("folio_venta", $value["Folio"]);	
				$calendario = json_decode($value["CalendarioAbonos"],true);
				$anotherDate = [];
				foreach ($calendario as $key => $value2) {
					if ($value2["Estado"] == 0) {
						$anotherDate = $value2;
						break;
					}
				}

				$proximoAbono = $anotherDate["Fecha"];
				date_default_timezone_set('America/Hermosillo');
				$fecha = date('Y-m-d');
				if ($fecha > $proximoAbono) {
					array_push($res['data'], [
						($key+1),
						$cliente["nombre"],
						$value["Folio"],
						$anotherDate["Abono"],
						$proximoAbono,
						$fecha,
						$calendario[$key+1]["Fecha"],
					]);
				}
			} catch(Exception $e) {
				array_push($res['data'], []);
			}									
		}
		echo  json_encode($res);
	}
}

$abonos = new TablaReporteContado();
$abonos->MostrarTabla();