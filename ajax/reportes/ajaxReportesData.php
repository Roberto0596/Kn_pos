<?php 

require_once "../../controladores/abonos.controlador.php";
require_once "../../modelos/abonos.modelo.php";
require_once "../../controladores/crearventa.controlador.php";
require_once "../../modelos/crearventa.modelo.php";

class ajaxReportesData{

	public $folioAbonos;

	public function abonosPorClientes()
	{
		$item = "folio_venta";
		$valor = $this->folioAbonos;
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
					"#" => ($key+1),
					"Folio venta" => $value["folio_venta"],
					"Folio pago" => $value["folio_pago"],
					"Fecha de vencida" => $value["fecha_vencimiento"],
					"Fecha de pago" => $botonFecha,
					"Fecha Prox. pago" => $calendario[($value["numero_abono"]+1)]["Fecha"],
					"cantidad" => $value["cantidad"],
					"Saldo" => $value["saldo"],
				]);
			}	
		}
		echo json_encode($res);
	}
} 

if (isset($_POST["folioAbonos"])) {
	$ajax = new ajaxReportesData();
	$ajax-> folioAbonos = $_POST["folioAbonos"];
	$ajax->abonosPorClientes();
}
