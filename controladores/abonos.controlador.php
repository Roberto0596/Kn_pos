<?php

class ControladorAbonos
{

 	function ctrTraerUltimoFolio()
 	{
 		$tabla = "abonos";
 		$respuesta = ModeloAbonos::mdlTraerUltimoFolio($tabla);
 		return $respuesta["folio_pago"];
	 }

	 function ctrMostrarAbonos($item,$valor)
 	{
 		$tabla = "abonos";
 		$respuesta = ModeloAbonos::mdlMostrarAbonos($tabla,$item,$valor);
 		return $respuesta;
 	}

 	public function ctrRegistrarAbono()
 	{
		if (isset($_POST["folioCompra"]))
		{
			include_once "modelos/abonos.modelo.php";
			include_once "modelos/crearventa.modelo.php";
            include_once "controladores/helpers.php";
			$tabla = "abonos";
			date_default_timezone_set('America/Hermosillo');
			$fechaPago = date('Y-m-d');
			$nuevoSaldo = 0;
			if (!isset($_POST['descuentoP'])) {
				$nuevoSaldo = $_POST["ultimoSaldo"] - $_POST["abono"];
			}
			print_r($_POST);
			$ModeloAbono= new ModeloAbonos(NULL, $_POST["folioCompra"], ($this->ctrTraerUltimoFolio()+1), $_POST["fechaVence"], $fechaPago, $_POST["nAbono"], $_POST["abono"], $nuevoSaldo, 1);
			$respuesta = ModeloVentas::mdlAbonar("ventas","Folio",$_POST["folioCompra"],$nuevoSaldo);

			if ($respuesta = "ok")
			{
				$respuesta = ModeloAbonos::mdlRegistrarAbono($tabla,$ModeloAbono);
				if ($respuesta = "ok")
				{
					echo 
		                '<script>
		                swal.fire({
		                    type: "success",
		                    title: "Se abono correctamente.",
		                    showConfirmButton: true,
		                    confirmButtonText: "cerrar",
		                    closeOnConfirm: false
		                    }).then((result)=>
		                    {
		                        if(result.value)
		                        {
		                            printTicket('.$_POST["folioCompra"].')
		                            //window.location="abonos";
		                        }
		                    })
		                </script>';
				}
				else
				{
					Helpers::imprimirMensaje("error","No se pudo crear el abono.","abonos");
				}
			}
			else
			{
				Helpers::imprimirMensaje("error","No se pudo modificar el saldo en la venta.","abonos");
			}
		}

 	}
}



?>