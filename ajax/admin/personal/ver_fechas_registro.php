<?php
include "../../../helper/local_undc.php";
include "../../../helper/formato_fecha.php";
include "../../../conexion/pdo_conexion.php";
include "../../../models/asistencia.model.php";
include "../../../controllers/asistencia.controller.php";
$asistencia = new AsistenciaController;
$asistencias["data"] = $asistencia->listar_mi_asistencia($_POST["dni"]);
echo json_encode($asistencias);
?>