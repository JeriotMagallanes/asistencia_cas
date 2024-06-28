<?php
include "../helper/local_undc.php";
include "../helper/formato_fecha.php";
include "../conexion/pdo_conexion.php";
include "../models/personal.model.php";
include "../controllers/personal.controller.php";
$personal = new PersonalController;
$asistencias["data"] = json_decode($personal->listar_asistencia($_POST["dni"]));
echo json_encode($asistencias);
?>