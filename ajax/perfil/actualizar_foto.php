<?php
include "../../conexion/pdo_conexion.php";
include "../../helper/asistencia.php";
include "../../helper/formato_fecha.php";
include "../../helper/local_undc.php";
include "../../helper/file.php";
include "../../models/personal.model.php";
include "../../controllers/personal.controller.php";
$personal = new PersonalController;
echo json_encode($personal->subir_foto_estudiante($_POST,$_FILES));