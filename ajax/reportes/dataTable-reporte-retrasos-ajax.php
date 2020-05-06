<?php

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";
require_once "../../controladores/crearventa.controlador.php";
require_once "../../modelos/crearventa.modelo.php";
require_once "../../controladores/abonos.controlador.php";
require_once "../../modelos/abonos.modelo.php";

class TablaReporteContado
{
	public function MostrarTabla()
	{
		date_default_timezone_set('America/Hermosillo');
		$fecha = date('Y-m-d');
		$clientes = ControladorClientes::ctrMostrarClientes(null,null,0);
		$res = [ "data" => []];
		$count;
		foreach ($clientes as $key1 => $value)
		{
			$ventas = ControladorVentas::ctrMostrarClienteVentas("Id_cliente",$value["id_cliente"]);

			if ($ventas!=false)
			{
				foreach ($ventas as $key1 => $value2) 
				{
					$abonos = ControladorAbonos::ctrMostrarAbonos("folio_venta",$value2["Folio"]);
					if ($abonos!=false)
					{
						foreach ($abonos as $key1 => $value3)
						{
							
						}	
						if ($value2["CalendarioAbonos"]!="N")
						{
							$calendario = json_decode($value2["CalendarioAbonos"],true);
							$proximaFecha = $calendario[$value3["numero_abono"]]["Fecha"];
							$validate = ModeloAbonos::mdlValidarUltimoPago($value2["Folio"],$proximaFecha);
							if ($fecha>=$proximaFecha && $validate !=false) 
							{
								$botones =  "
								<div class='btn-group'>
									<button class='btn btn-danger  btnEliminarCliente' title='Aumentar interes'>
										<i class='fas fa-trash'></i>
									</button>
								</div>";

								$count++;
								array_push($res['data'], [
									($count),
									$value["nombre"],
									$value2["Folio"],
									$proximaFecha,
									$calendario[($value3["numero_abono"])]["Abono"],
									$calendario[($value3["numero_abono"]+1)]["Fecha"],
									$calendario[($value3["numero_abono"]+1)]["Abono"],
									$botones
								]);							
							}
						}				
					}					
				}
			}
		}
		echo  json_encode($res);
	}
}

$abonos = new TablaReporteContado();
$abonos->MostrarTabla();