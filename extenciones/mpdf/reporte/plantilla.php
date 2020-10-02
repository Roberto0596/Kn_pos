<?php 

function getPlantilla($tipo, $array)
{
    $headers = array_keys($array[0]);
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


    $plantilla.= '<table style="width: 100%; text-align: left; border: #b2b2b2 1px solid;border-collapse: collapse;">
        <tr>';

    foreach ($headers as $key => $value)
    {
        $plantilla.="
            <th>".$value."</th>
        ";
    }

    $plantilla.= '</tr>';

    foreach ($array as $key => $value)
    {
        $plantilla.="<tr>";
        foreach ($value as $key2 => $value2) {
            $plantilla.="
                <td>".$value2."</td>
            ";
        }
        $plantilla.="</tr>";
    }

    $plantilla.="</table>
    <div style='text-align:center; width: 100%'>
    <p><h4><b>Fin de reporte</b></h4></p>
    </div>
    </div>";

    return $plantilla;
}

function getHeaders($array) {
    $headers = [];

    foreach ($array["data"] as $key => $value) {
        array_push($headers, $key);
    }

    return $headers;
}

?>