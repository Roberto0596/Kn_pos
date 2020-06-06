<?php 
require_once "../../modelos/crearventa.modelo.php";
require_once "../../modelos/clientes.modelo.php";
if (isset($_GET["Folio"]))
{
  $code = $_GET["Folio"];
}

$tabla = "ventas";
$item= 'Folio';
$data = ModeloVentas::mdlMostrarVentas($item,$code);
$cliente = ModeloClientes::mdlMostrarClientes("cliente","id_cliente",$data["Id_cliente"],0);
if($data) 
{
    $data['ListaProductos'] = json_decode($data['ListaProductos']);
}

?>

<!DOCTYPE html>
<html>

<head>
    <style>
        body{
            margin-bottom: 5px;
            font-family: Arial, Helvetica, sans-serif;
        }
        * {
            font-size: 12px;
            /*font-family: 'Times New Roman';*/
            font-family: Arial, Helvetica, sans-serif;
            font-size: 10px;
        }

        td,
        th,
        tr,
        table {
            border-top: 1px solid black;
            border-collapse: collapse;
        }

                td.producto,
        th.producto {
            width: 75px;
            max-width: 75px;
        }

        td.cantidad,
        th.cantidad {
            width: 40px;
            max-width: 40px;
            /*word-break: break-all;*/
        }

        td.precio,
        th.precio {
            width: 40px;
            max-width: 40px;
            word-break: break-all;
        }

        td.total,
        th.total {
            width: 45px;
            max-width: 45px;
            word-break: break-all;
        }

        .centrado {
            text-align: center;
            align-content: center;
            text-transform: uppercase;
        }

        td.item {
            text-align: right;
        }

        .centrado {
            text-align: center;
            align-content: center;
            text-transform: uppercase;
        }

        .ticket {
            width: 160px;
            max-width: 160px;
            align-items: center;
        }

        img {
            max-width: inherit;
            width: inherit;
        }

        @media print{
            .oculto-impresion, .oculto-impresion *{
                display: none !important;
            }
        }

        .bold{
            font-weight: bolder;
            font-size: 1.3em;
        }

        .text-center
        {
          align-items: center;
          text-align: center;
        }

    </style>
</head>

<body>

<div class="ticket">

  <header  style="width: 100%">
    <img src="../img/plantilla/logo-login.png" alt="nooo" style="width: 50%; margin-left: 25%;"></div>
    <div class="text-center" style=" margin-left: 2%;">
        <h3>Calle 6 Avenida 6 Tel. 633-767229</h3>
        <h3>Agua Prieta Sonora</h3>
        <br>
    </div>
  </header>

  <div style="width: 100%">

      <div style="width: 100%">

        <table>
          <tr>
            <th class="index">Cliente: </th>
            <th><?= $cliente["nombre"] ?></th>
          </tr>

        </table>

        <p class="centrado">TICKET DE VENTA #<?= $code ?>
      <br><?= $data["Fecha"].' '.$data["Hora"]; ?></p>
    <table>
      <thead>
        <tr>
          <th class="cantidad">Cant</th>
          <th class="producto">PROD</th>
          <th class="precio">PU</th>
          <th class="total">$$</th>
        </tr>
      </thead>
      <tbody>
      <?php  foreach($data["ListaProductos"] as $prod): ?>
        <tr>
          <td class="cantidad"><?= $prod->cantidad ?></td>
          <td class="producto"><?= $prod->descripcion ?></td>
          <td class="precio">$<?= $prod->precio ?></td>
          <td class="total">$<?= $prod->total ?></td>
        </tr>
    <?php endforeach; ?>
        <tr>
          <td class="cantidad"></td>
          <td class="producto" colspan="2">TOTAL</td>
          <td class="total">$<?= $data["TotalVenta"] ?></td>
        </tr>
      </tbody>
    </table>

        <div class="text-center">Gracias por su comprar</div>

      </div>
  </div>
  
</div>
</body>

</html>