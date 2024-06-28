<?php
include "./conexion/pdo_conexion.php";
// include "./helper/local_undc.php";
// $con = new pdo_conexion;
// $qry = $con->prepare('SELECT dni_doce, GROUP_CONCAT(hora_registro,"-",local order by hora_registro asc ) AS registros
// FROM registro_asistencia_administrativos
// WHERE fecha_registro="23-05-2023" and dni_doce="00515158"');
// $qry->execute();
// $row = $qry->fetchAll();
// if ($row) {
//     foreach ($row as $item) {
//         echo $item["dni_doce"]." ";
//         $hr_xplode = explode(",",$item["registros"]);
//         foreach ($hr_xplode as $hr) {
//             $local_xplode = explode("-",$hr);
//             echo "<b>Hora: </b>".$local_xplode[0]." / ";
//             echo "<b>Local: </b>".LocalUndc::nombre_local($local_xplode[1]);
//             echo "<br>";
//         }
//         echo "<br>";
//     }
// }
// include "./conexion/pdo_conexion.php";
// include "./helper/local_undc.php";
// include "./helper/asistencia.php";
// include "./models/personal.model.php";
// include "./controllers/personal.controller.php";
// $personal = new PersonalController;
// $registros = $personal->trabajo_hora("23-05-2023");
// echo json_encode($registros);

// Realiza una solicitud HTTP a httpbin.org para obtener la IP pública

// Obtiene la dirección IP pública del visitante
// $ipPublica = $_SERVER['REMOTE_ADDR'];

// Imprime la IP pública
// echo "Tu IP pública es: " . $ipPublica;
$con = new pdo_conexion;
$qry = $con->prepare("SELECT count(*) as total,dependencia FROM `personal_administrativo` GROUP BY dependencia");
$qry->execute();
$row = $qry->fetchAll();
$cont = 1;
if ($row) {
    echo "<table>";
    echo "<thead><tr><th>Oficina</th></tr></thead>";
    foreach ($row as $row) {
        if ($cont == 1) {
            echo '<br>
            [
                "id" => '.$cont.',
                "name" => "'.$row["dependencia"].'"
            ]</br>
            ';
        }else{
            echo '
            ,[<br>
                "id" => '.$cont.',
                "name" => "'.$row["dependencia"].'"
            ]<br>
            ';
        }
        $cont ++;
    }
    echo "</table>";
}
?>
