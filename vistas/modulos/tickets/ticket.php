<?php

require 'autoload.php'; 
require_once "../../../modelos/crearventa.modelo.php";
require_once "../../../modelos/clientes.modelo.php";
require_once "../../../modelos/abonos.modelo.php";

use Mike42\Escpos\EscposImage;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

$code = $_GET["code"];

$nombre_impresora = "POS-80";
$connector = new WindowsPrintConnector($nombre_impresora);
$printer = new Printer($connector);
$printer->setJustification(Printer::JUSTIFY_CENTER);

$logo = EscposImage::load("../../img/plantilla/logo-login.png", false);
$printer->bitImage($logo);

if (isset($_GET["codigo"]))
{
  $code = $_GET["codigo"];
}
$tabla = "ventas";
$item= 'Folio';
$data = ModeloVentas::mdlMostrarVentas($item,$code);
$cliente = ModeloClientes::mdlMostrarClientes("cliente","id_cliente",$data["Id_cliente"],0);
$abono = ModeloAbonos::mdlMostrarAbonos("abonos","folio_venta",$data["Folio"]);


$printer->setTextSize(2, 2);
$printer->text("BlazarSoft");

$printer->setTextSize(2, 1);
$printer->feed();
$printer->text("Empresa\n\nSoftware");

/*
Hacemos que el papel salga. Es como
dejar muchos saltos de línea sin escribir nada
 */
$printer->feed(15);

/*
Cortamos el papel. Si nuestra impresora
no tiene soporte para ello, no generará
ningún error
 */
$printer->cut();

/*
Por medio de la impresora mandamos un pulso.
Esto es útil cuando la tenemos conectada
por ejemplo a un cajón
 */
$printer->pulse();

/*
Para imprimir realmente, tenemos que "cerrar"
la conexión con la impresora. Recuerda incluir esto al final de todos los archivos
 */
$printer->close();
