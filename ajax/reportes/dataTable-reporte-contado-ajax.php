<?php

require_once "../../controladores/clientes.controlador.php";
require_once "../../modelos/clientes.modelo.php";
require_once "../../controladores/crearventa.controlador.php";
require_once "../../modelos/crearventa.modelo.php";

class TablaReporteContado
{
	public function MostrarTabla()
	{
		if (isset($_POST["rango"]))
		{
			if ($_POST["rango"]==null)
			{
				$respuesta = ControladorVentas::ctrMostrarVentas(null,null);
			}
			else
			{
				$fechas = explode("|", $_POST["rango"]);
				$valor1 = $fechas[0];
				$valor2=$fechas[1];
				$respuesta = ControladorVentas::ctrMostrarVentasPorFecha($valor1,$valor2);
			}

			$res = [ "data" => []];

			foreach($respuesta as $key => $value)
			{		
				$cliente = ControladorClientes::ctrMostrarClientes("id_cliente",$value["Id_cliente"],0);

				$boton = '<button class="btn btn-success verProductos" data-toggle="modal" data-target="#modalVerProductos" folio="'.$value["Folio"].'">Articulos</button>';

				array_push($res['data'], [
					($key+1),
					$value["Folio"],
					$cliente["nombre"],
					$cliente["direccion"]!=null?$cliente["direccion"]:"N/A",
					$cliente["telefono_casa"]!=null?$cliente["telefono_casa"]:"N/A",
					$boton,
					$value["Fecha"].$value["Hora"],
					$value["TotalVenta"],
				]);
			}	
			echo json_encode($res);
		}
	}
}

$abonos = new TablaReporteContado();
$abonos->MostrarTabla();