<?php

class ControladorVentas
{
    public function ctrCrearVenta()
	{
		if (isset($_POST["nuevaVenta"]))
		{
            include_once "modelos/crearventa.modelo.php";
            include_once "controladores/productos.controlador.php";
            include_once "controladores/helpers.php";
            $tabla = "ventas";
            date_default_timezone_set('America/Hermosillo');
            $fecha = date('Y-m-d');
            $hora = date('H:i:s');
            $fechaPrimerAbono = date("Y-m-d",strtotime($_POST["primerAbono"]));
            $calendarioAbonos = [];
            switch($_POST["tipoTiempo"]){
                case "Semanal":
                    for ($i=1; $i <= $_POST["cantidadTiempo"]; $i++) {
                        $calendarioAbonos1 = [
                            "Fecha" => $fechaPrimerAbono,
                            "Abono" => $_POST["abonoBase"],
                            "Estado" => 0
                        ];
                        array_push($calendarioAbonos, $calendarioAbonos1);
                        $fechaPrimerAbono = date("Y-m-d",strtotime($fechaPrimerAbono."+ 7 days"));
                    }
                break;
                case "Quincenal":
                    for ($i=1; $i <= $_POST["cantidadTiempo"]; $i++) {
                        $calendarioAbonos1 = [
                            "Fecha" => $fechaPrimerAbono,
                            "Abono" => $_POST["abonoBase"],
                            "Estado" => 0
                        ];
                        array_push($calendarioAbonos, $calendarioAbonos1);
                        if(date("m",strtotime($fechaPrimerAbono)) == 2 && date("d",strtotime($fechaPrimerAbono)) == 15){
                            $fechaPrimerAbono = date("Y-m-d",strtotime($fechaPrimerAbono."+ 13 days"));
                        }else{
                            $fechaPrimerAbono = date("Y-m-d",strtotime($fechaPrimerAbono."+ 15 days"));
                        }
                        if(date("d",strtotime($fechaPrimerAbono)) == 14){
                            $fechaPrimerAbono = date("Y-m-d",strtotime($fechaPrimerAbono."+ 1 days"));
                        }
                    }
                break;
                case "Mensual":
                    for ($i=1; $i <= $_POST["cantidadTiempo"]; $i++) {
                        $calendarioAbonos1 = [
                            "Fecha" => $fechaPrimerAbono,
                            "Abono" => $_POST["abonoBase"],
                            "Estado" => 0
                        ];
                        array_push($calendarioAbonos, $calendarioAbonos1);
                        $fechaPrimerAbono = date("Y-m-d",strtotime($fechaPrimerAbono."+ 1 month"));
                    }
                break;
            }
            $productos = json_decode($_POST["listaProductos"]);
            $calendarioAbonosFinal=json_encode($calendarioAbonos);
            $ModeloCrearventa = new ModeloVentas(NULL, $_POST["nuevaVenta"], $_POST["id_usuario"], $_POST["id_cliente"], $_POST["id_almacen"], $fecha, $hora, $_POST["listaProductos"], $_POST["totalVenta"], $_POST["totalPayment"]);
/*
            foreach ($productos as $producto) {
                if(ControladorProductos::ctrVenta($producto->existencia, $producto->id) != "ok"){
                    $mensajeError .= "El producto ".$producto->descripcion." no se pudo modificar el stock, error sql";
                    dei("Error SQL: " . $mensajeError);
                }
            }*/

            $respuesta = "ok";//ModeloVentas::mdlCrearVenta($tabla,$ModeloCrearventa);

			if ($respuesta = "ok")
			{
                print_r($_POST);
                echo($calendarioAbonosFinal);
				Helpers::imprimirMensaje("success","La venta se registró correctamente.","crearventa");
			}
			else
			{
				Helpers::imprimirMensaje("error","La venta no se creó.","crearventa");
			}
		}
    }

}
?>