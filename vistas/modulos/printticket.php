<?php 
require_once "../../modelos/crearventa.modelo.php";
require_once "../../modelos/clientes.modelo.php";
require_once "../../modelos/abonos.modelo.php";

if (isset($_GET["codigo"]))
{
  $code = $_GET["codigo"];
}
$tabla = "ventas";
$item= 'Folio';
$data = ModeloVentas::mdlMostrarVentas($item,$code);
$cliente = ModeloClientes::mdlMostrarClientes("cliente","id_cliente",$data["Id_cliente"],0);
$abono = ModeloAbonos::mdlMostrarAbonos("abonos","folio_venta",$data["Folio"]);

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

          <tr>
            <td class="index">Fecha</td>
            <td class="item"><?= $data["Fecha"] ?></td>
          </tr>

<!--           <tr>
            <td class="index">Vencidos</td>
            <td class="item">2 pagos</td>
          </tr> -->

          <tr>
            <td class="index">Abono</td>
            <td class="item"><?= $abono[count($abono)-1]["cantidad"] ?></td>
          </tr>
          
          <tr>
            <td class="index">Saldo</td>
            <td class="item"><?= $abono[count($abono)-1]["saldo"] ?></td>
          </tr>

          <tr>
            <td class="index">Saldo Anterior</td>
            <td class="item"><?= $abono[count($abono)-1]["saldo"] + $abono[count($abono)-1]["cantidad"] ?></td>
          </tr>

        </table>

        <div class="text-center">Cuide su crédito</div>

      </div>
  </div>
  
</div>
</body>

</html>