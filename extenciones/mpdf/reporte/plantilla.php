<?php 

function getPlantilla($tipo, $array)
{
    $headers = array_keys($array["res"][0]);
    $data = $array["res"];

    $plantilla='
    <div style="width: 100%">
        <table style="width: 100%;">
            <tr>
                <td>
                    <img src="logo1.png" alt="" style="width: 15%">
                </td>
                <td>
                    <h1>Karina Mueblerias</h1>
                </td>
            </tr>
        </table>
        <div style="text-align:center"><h4>'.$tipo.'</h4></div>';


    $plantilla.= '<table style="width: 100%; text-align: left; border: #b2b2b2 1px solid;border-collapse: collapse; font-size: 11px">
        <tr style="background: #b45254; color:white !important">';

    foreach ($headers as $key => $value)
    {
        $plantilla.="
            <th style='border: #b2b2b2 1px solid; color: white; font-size: 14px'>".$value."</th>
        ";
    }

    $plantilla.= '</tr>';

    foreach ($data as $key => $value)
    {
        $plantilla.="<tr>";
        foreach ($value as $key2 => $value2) {
            $plantilla.="
                <td style='border: #b2b2b2 1px solid;'>".$value2."</td>
            ";
        }
        $plantilla.="</tr>";
    }
    $plantilla.='</table>';
    $plantilla.= '<section style="margin-top:30px;">

        <table style="width:100%; font-size: 1.5em;">

              <tr>

                <th style="width: 60%"></th>

              </tr>';

              foreach ($array["totals"][0] as $key => $value) {
                  $plantilla.='<tr>

                    <th style="width: 60%"></th>

                    <th style="color:#333; background-color:white;font-size: 20px; width: 20%">'.ucfirst($key).':</th>

                    <td style="border-bottom: 1px solid #666; background-color:white;font-size: 20px; width: 20%">$'.number_format($value,2).'</td>

                  </tr>';
              }

    $plantilla.="</table></section>
    <div style='text-align:center; width: 100%'>
    <p><h4><b>Fin de reporte</b></h4></p>
    </div>
    </div>";

    return $plantilla;
}

?>