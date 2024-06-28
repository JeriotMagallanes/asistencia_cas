<?php
session_start();
if ( !isset($_SESSION["auth"]) && $_SESSION["auth"] !== 1 && $_SESSION["rol"]["admin"] !== 1) { //no es admin y no ha iniciado sesion
    $_SESSION["flash"]["estado"] = 2;
    $_SESSION["flash"]["mensaje"] = "Sesion caducada o no tiene permiso";

    header('Location: ../');
}
include "../conexion/pdo_conexion.php";
include "../models/personal.model.php";
include "../helper/formato_fecha.php";
include "../helper/local_undc.php";
date_default_timezone_set('America/Lima');
$fecha_actual=date("Y-m-d");
$hora_actual = date("H:i:s");
$hr = date("Y-m-d-H-i-s");
// header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
// header("Content-Disposition: attachmen;filename=backup_asistencia_cas_".$hr.".xls");
header("Content-Type:   application/vnd.ms-excel; charset=utf-8");
header("Content-type:   application/x-msexcel; charset=utf-8");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: private",false);

header("Content-Disposition: attachment; filename=backup_asistencia_cas_".$hr.".xls");

// Para registrar quien genero el EXCEL
include "../models/asicasexport.php";
$export = new AsiCasExport;
$x_fecha = date("Y-m-d");
$x_hora = date("H:i:s");
$x_desc = "Genero BACKUP GENERAL (EXCEL) de ".$_GET['inicio']." hasta ".$_GET["fin"];
$x_diasem = FormatoFecha::dia_semana(date("N"));
echo $x_diasem;
// PARAMETROS :: $admin,$fecha,$hora,$dia_sem,$des
$export->insert($_SESSION["id_admin"], $x_fecha, $x_hora, $x_diasem , $x_desc);
// Fin

$modelo = new PersonalModel();
$personal = $modelo->get_personal();
$local = new LocalUndc();
$formato_fecha = new FormatoFecha();
?>
<table>
    <caption>BACKUP DE REGISTRO DE ASISTENCIAS</caption>
    <tr>
        <td colspan="2">Generado</td>
    </tr>
    <tr>
        <td>Dia</td>
        <td><?php echo $formato_fecha->formato_fecha($fecha_actual); ?></td>
    </tr>
    <tr>
        <td>Hora</td>
        <td style="text-align:left;"><?php echo $hora_actual; ?></td>
    </tr>
    <tr>
        <td colspan="2">Rango de Fecha</td>
    </tr>
    <tr>
        <td>Inicio</td>
        <td style="text-align:left;"><?php echo $_GET["inicio"]; ?></td>
    </tr>
    <tr>
        <td>Fin</td>
        <td style="text-align:left;"><?php echo $_GET["fin"]; ?></td>
    </tr>

</table>
<table border="1">
    <caption>REGISTRO DE ASISTENCIA</caption>
    <tr>
        <td>#</td>
        <td>Apellidos y Nombres</td>
        <td>Dni</td>
        <td>Puesto</td>
        <td>Dependencia</td>
        <td>Fecha de Registro</td>
        <td>Dia de semana</td>
        <td>Local</td>
        <td>Hora de Registro</td>
    </tr>
    <?php
    $contador = 1;
    if ($personal) {
        $fec_ini = explode("-",$_GET["inicio"]);
        $fec_fin = explode("-",$_GET["fin"]);
        echo "fecha de fin : ".$fec_fin[2]."-".$fec_fin[1]."-".$fec_fin[0];
        foreach ($personal as $personal) {
            $asistencias = $modelo->asi_filtr_fec($personal["dni_pa"], $_GET["inicio"], $_GET["fin"]);
            if ($asistencias) {
                foreach ($asistencias as $asistencia) {?>
                <tr>
                    <td><?php echo $contador; ?></td>
                    <td><?php echo utf8_decode($personal["apaterno"]." ".$personal["amaterno"]." ".$personal["nombres"]); ?></td>
                    <td><?php echo $personal["dni_pa"]; ?></td>
                    <td><?php echo utf8_decode($personal["puesto"]); ?></td>
                    <td><?php echo utf8_decode($personal["dependencia"]); ?></td>
                    <td><?php echo $formato_fecha->formato_fecha($asistencia["fecha_registro"]); ?></td>
                    <td style="text-align:center"><?php echo $asistencia["dia_semana"]; ?></td>
                    <td><?php echo utf8_decode($local->nombre_local($asistencia["local"])); ?></td>
                    <td style="text-align:center"><?php echo $asistencia["hora_registro"]; ?></td>
                </tr>
                <?php
                    $contador += 1;
                } 
            }
        }
    }else{
        ?>
        <tr>
            <td colspan="4">No se encontraron datos</td>
        </tr>
        <?php
    }
    ?>
</table>