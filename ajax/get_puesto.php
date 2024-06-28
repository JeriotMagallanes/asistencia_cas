<?php
include "../conexion/pdo_conexion.php";
include "../models/personal.model.php";
include "../controllers/personal.controller.php";
$personal = new PersonalController;
$res = $personal->buscar_info_personal_by_id($_POST["id"]);
$data["puesto"] = $res[0]["puesto"];
echo json_encode($data);