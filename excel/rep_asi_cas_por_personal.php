<?php
include "../conexion/pdo_conexion.php";
include "../models/personal.model.php";
include "../helper/formato_fecha.php";
include "../helper/locales.php";
header("Content-Type: application/vnd.ms-excel; charset=iso-8859-1");
header("Content-Disposition: attachmen;filename=".$_GET['dni'].".xls");
$modelo = new PersonalModel();
$asistecias = $modelo->get_asi_reg($_GET["dni"]);
$personal = $modelo ->buscar_datos($_GET["dni"]);
$local = new Local();
$formato_fecha = new FormatoFecha();
?>
<table>
    <caption>DATOS DEL PERSONAL</caption>
    <tr>
        <td>APELLIDOS</td>
        <td><?php echo $personal[0]["apaterno"]." ".$personal[0]["amaterno"]; ?></td>
    </tr>
    <tr>
        <td>NOMBRES</td>
        <td><?php echo $personal[0]["nombres"]; ?></td>
    </tr>
    <tr>
        <td>DNI</td>
        <td><?php echo $personal[0]["dni_pa"]; ?></td>
    </tr>
    <tr>
        <td>DEPENDENCIA</td>
        <td><?php echo $personal[0]["dependencia"]; ?></td>        
    </tr>
    <tr>
        <td>PUESTO</td>
        <td><?php echo $personal[0]["puesto"]; ?></td>
    </tr>
</table>
<table>
    <caption>REGISTRO DE ASISTENCIA</caption>
    <tr>
        <td>Fecha de Registro</td>
        <td>Dia de semana</td>
        <td>Hora de Registro</td>
        <td>Local</td>
    </tr>
    <?php 
    if ($asistecias) {
        foreach ($asistecias as $asistencia) { ?>
        <tr>
            <td><?php echo $formato_fecha->formato_fecha($asistencia["fecha_registro"]); ?></td>
            <td><?php echo $asistencia["dia_semana"]; ?></td>
            <td><?php echo $asistencia["hora_registro"]; ?></td>
            <td><?php echo $local->nombre_local($asistencia["local"]); ?></td>
        </tr>
        <?php 
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