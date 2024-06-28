<?php
session_start();
include "../../../helper/formato_fecha.php";
include "../../../conexion/pdo_conexion.php";
include "../../../models/asistencia.model.php";
include "../../../controllers/personal/AsistenciaController.php";
$asistencia = new AsistenciaController;
echo json_encode($asistencia->mostrar_mi_asistencia($_POST['rango_fecha']));