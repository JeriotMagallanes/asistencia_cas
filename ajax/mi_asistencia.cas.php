<?php
include "../conexion/pdo_conexion.php";
include "../helper/formato_fecha.php";
include "../helper/asistencia.php";
include "../helper/local_undc.php";
include "../models/personal.model.php";
include "../controllers/personal.controller.php";
session_start();
$personalcontroller = new PersonalController;
$miasistencia = $personalcontroller->mi_asistencia($_POST["fecha"]);
$data["estado"] = 0;

if ($miasistencia) {
    $data["estado"] = 1;
    $data["asistencias"] = $miasistencia;
}
echo json_encode($data);