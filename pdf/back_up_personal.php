<?php
// error_reporting(E_ALL);
// ini_set('display_errors', '1');
include "../conexion/pdo_conexion.php";
include "../models/personal.model.php";
include "../helper/formato_fecha.php";
include "../helper/local_undc.php";
include '../vendor/autoload.php';

$modelo = new PersonalModel();
$asistecias = $modelo->asi_filtr_fec($_GET["dni"], $_GET["inicio"], $_GET["fin"]);
$personal = $modelo ->buscar_datos($_GET["dni"]);
$local = new LocalUndc();
$formato_fecha = new FormatoFecha();
$nom_file = $_GET["dni"].'_'.$_GET["inicio"].'_al_'.$_GET["fin"].'.pdf';

$mpdf = new \Mpdf\Mpdf();
$html = '
<table>
    <caption>DATOS DEL PERSONAL</caption>
    <tr>
        <td>APELLIDOS:</td>
        <td>'.$personal[0]["apaterno"].' '.$personal[0]["amaterno"].'</td>
    </tr>
    <tr>
        <td>NOMBRES:</td>
        <td>'.$personal[0]["nombres"].'</td>
    </tr>
    <tr>
        <td>DNI:</td>
        <td>'.$personal[0]["dni_pa"].'</td>
    </tr>
    <tr>
        <td>DEPENDENCIA:</td>
        <td>'.$personal[0]["dependencia"].'</td>        
    </tr>
    <tr>
        <td>PUESTO:</td>
        <td>'.$personal[0]["puesto"].'</td>
    </tr>
</table><br>
<table style="border-collapse: collapse;margin-bottom:10px;font-size:10px;width:100%">
    <caption>REGISTRO DE ASISTENCIA</caption>
    <tr>
        <td style="border: 1px solid black;padding:5px; text-align: center;background-color:#093C90;color:white">Fecha de Registro</td>
        <td style="border: 1px solid black;padding:5px; text-align: center;background-color:#093C90;color:white">Dia de semana</td>
        <td style="border: 1px solid black;padding:5px; text-align: center;background-color:#093C90;color:white">Hora de Registro</td>
        <td style="border: 1px solid black;padding:5px; text-align: center;background-color:#093C90;color:white">Local</td>
    </tr>
    ';
    if ($asistecias) {
        foreach ($asistecias as $asistencia) {
        $html .= '
    <tr>
        <td style="border: 1px solid black;padding:5px; text-align: center;">'.$formato_fecha->formato_fecha($asistencia["fecha_registro"]).'</td>
        <td style="border: 1px solid black;padding:5px; text-align: center;">'.$asistencia["dia_semana"].'</td>
        <td style="border: 1px solid black;padding:5px; text-align: center;">'.$asistencia["hora_registro"].'</td>
        <td style="border: 1px solid black;padding:5px; text-align: center;">'.$local->nombre_local($asistencia["local"]).'</td>
    </tr>';
        }
    }else{
        $html .= '
    <tr>
        <td colspan="4">No se encontraron datos</td>
    </tr>';
    }
$html .= '
</table>';
$mpdf->WriteHTML($html);
$mpdf->Output($nom_file, 'I');