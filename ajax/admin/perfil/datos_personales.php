<?php
include "../../../helper/estados.php";
include "../../../helper/formato_fecha.php";
include "../../../helper/local_undc.php";
include "../../../helper/asistencia.php";
include "../../../conexion/pdo_conexion.php";
include "../../../models/personal.model.php";
include "../../../controllers/personal.controller.php";
$personal = new PersonalController;
echo json_encode($personal->buscar_info_personal($_POST["dni"]));