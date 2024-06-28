<?php

use Mpdf\Tag\Tr;

    include "../../conexion/pdo_conexion.php";
    date_default_timezone_set('America/Lima');
    $total_dias = json_decode(cal_days_in_month(CAL_GREGORIAN, $_GET["mes"], $_GET["year"]));
    $con = new pdo_conexion;
    $qry = $con->prepare("SELECT * FROM personal_administrativo WHERE dni_pa=:dni_pa");
    $qry->bindParam(":dni_pa",$_GET["dni"]);
    $qry->execute();
    $data_personal = $qry->fetchAll();
    $dias_semana = ["","L","M","M","J","V","S","D"];

    function minutosTranscurridos($fecha_i,$fecha_f){
        $minutos = (strtotime($fecha_i)-strtotime($fecha_f))/60;
        $minutos = abs($minutos); $minutos = floor($minutos);
        return $minutos;
    }
    function calcularDiferenciaEnMinutos($fecha1, $fecha2) {
        $fechaInicio = new DateTime($fecha1);
        $fechaFin = new DateTime($fecha2);
    
        // Verificar si la segunda fecha es menor que la primera
        if ($fechaFin < $fechaInicio) {
            return 0;
        }
    
        // Calcular la diferencia en minutos
        $diferencia = $fechaInicio->diff($fechaFin);
        $minutos = $diferencia->days * 24 * 60 + $diferencia->h * 60 + $diferencia->i;
    
        return $minutos;
    }
?>
<h1>Reporte de Tardanza</h1>
<table width="100%">
    <tr>
        <?php
            for ($i = 1; $i <= $total_dias; $i++) {
                $fecha = $_GET["year"]."-".$_GET["mes"]."-".($i>=10 ? $i : "0".$i);
                $dia_sem = $dias_semana[date("N", strtotime($fecha))];
                echo "<th ".($dia_sem == "S" || $dia_sem == "D" ? 'style="background-color:red;"':'').">".$dias_semana[date("N", strtotime($fecha))]."</th>";
            }
        ?>
    </tr>
    <tr>
    <?php
        for ($i = 1; $i <= $total_dias; $i++) {
            echo "<th>".$i."</th>";
        }
    ?>
    </tr>   
    <tbody>
        <tr>
        <?php
        for ($i = 1; $i <= $total_dias; $i++) {
            $fecha = $_GET["year"]."-".$_GET["mes"]."-".($i>=10 ? $i : "0".$i);
            $fecha2 = ($i>=10 ? $i : "0".$i)."-".($_GET["mes"]>=10 ? $_GET["mes"]:"0".$_GET["mes"] )."-".$_GET["year"];
            $asi_by_date = $con->prepare("SELECT * FROM registro_asistencia_administrativos WHERE dni_doce=:dni_doce and fecha_registro=:fecha_registro and error<>1 order by hora_registro asc");
            $asi_by_date->bindParam(":dni_doce", $_GET["dni"]);
            $asi_by_date->bindParam(":fecha_registro", $fecha2);
            $asi_by_date->execute();
            $row_asi = $asi_by_date->fetchAll();

            $dia_sem = $dias_semana[date("N", strtotime($fecha))];
            if ($dia_sem == "S" || $dia_sem == "D") {
                echo "<td style='background-color:silver'>-</td>";  
            }else{
                if ($row_asi) { // si hay asistencia
                    if (count($row_asi) == 4) { // solo hay 4 registros :: OK
                        $manana_limite = $fecha." 08:00:00";
                        $ingreso_manana = explode(" ",$row_asi[0]["hora_registro"]);
                        $tarde_limite = $fecha." 14:00:00";
                        $ingreso_almuezo = explode(" ",$row_asi[2]["hora_registro"]);
                        $tot_tard_manana = ($ingreso_manana > $manana_limite) ? calcularDiferenciaEnMinutos($manana_limite, $fecha." ".$ingreso_manana[0]) : 0;
                        $tot_tard_almuerzo = ($ingreso_almuezo > $tarde_limite) ? calcularDiferenciaEnMinutos($tarde_limite, $fecha." ".$ingreso_almuezo[0]) : 0;
                        $tot_tardanza_dia = $tot_tard_manana + $tot_tard_almuerzo;
                        echo "<td style='text-align:center'>".$tot_tardanza_dia."</td>";
                    }else if (count($row_asi) == 2) { // solo hay 2 registros :: OK :: HOARIO VERANO
                        $manana_limite  = $fecha." 07:45:00";
                        $ingreso_manana = explode(" ",$row_asi[0]["hora_registro"]);
                        
                        $tot_tard_manana = ($ingreso_manana > $manana_limite) ? calcularDiferenciaEnMinutos($manana_limite, $fecha." ".$ingreso_manana[0]) : 0;
                        // $tot_tardanza_dia = $tot_tard_manana + $tot_tard_almuerzo;
                        echo "<td style='text-align:center'>".$tot_tard_manana."</td>";
                    }
                    else{
                        echo "<td style='background-color:yellow;text-align:center'>N/C</td>";
                    }
    
                }else{
                    echo "<td style='color:red;text-align:center'>F</td>";
                }
            }
        }
        ?>
        </tr>
    </tbody>
</table>

<table style="margin-top:20px">
    <tbody>
        <tr>
            <td>Faltó</td>
            <td>:</td>
            <td>F</td>
        </tr>
        <tr>
            <td>No registró 4 o 2 asistencias</td>
            <td>:</td>
            <td>N/C</td>
        </tr>
        <tr>
            <td>No laborable</td>
            <td>:</td>
            <td>-</td>
        </tr>
    </tbody>
</table>