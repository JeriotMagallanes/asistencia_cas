<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include "../../../helper/asistencia.php";
include "../../../helper/local_undc.php";
include "../../../helper/formato_fecha.php";
include "../../../conexion/pdo_conexion.php";
include "../../../models/asistencia.model.php";
include "../../../controllers/asistencia.controller.php";
$asistencias = new AsistenciaController;
$data["marcaciones"] = $asistencias->ver_marcaciones($_POST["fecha"], $_POST["dni"]);
$data["papeleta_personal"] = "";
$data["papeleta_comision"] = "";
echo json_encode($data);