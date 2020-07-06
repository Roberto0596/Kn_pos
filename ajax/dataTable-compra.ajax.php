<?php
require_once "../controladores/productos.controlador.php";
require_once "../modelos/productos.modelo.php";
error_reporting(0);
class TablaVenta
{
    public function mostrarTabla()
    {
      if (isset($_POST["idProveedor"]))
      {
        $productos = ControladorProductos::ctrMostrarProductosPorProveedor("Id_proveedor",$_POST["idProveedor"]);

        $res = [ "data" => []];

        foreach ($productos as $key => $value) 
        {
          if($value["Stock"] <= 10)
          {
            $existencia = "<button type='button' class='btn btn-danger'>".$value["Stock"]."</button>";
          }
          else if($value["Stock"] > 11 && $value["Stock"] <= 15)
          {
            $existencia = "<button type='button' class='btn btn-warning'>".$value["Stock"]."</button>";
          }
          else
          {
            $existencia = "<button type='button' class='btn btn-success'>".$value["Stock"]."</button>";
          }

          $botones =  "<button type='button' class='btn btn-primary agregarProducto' idProducto='".$value["Id_producto"]."' id='button".$value["Id_producto"]."'>Agregar</button>"; 

          array_push($res['data'], [
            ($key+1),
            $value["Codigo"],
            $value["Nombre"],
            "$".number_format($value["Precio_venta"],2),
            $existencia,
            $botones,
            $value["Id_producto"]
          ]);
        }
        echo json_encode($res);
      }
  	}
}
$activar = new TablaVenta();
$activar -> mostrarTabla();