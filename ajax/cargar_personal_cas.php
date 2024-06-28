<?php
include "../conexion/pdo_conexion.php";
include "../models/personal.model.php";
include "../controllers/personal.controller.php";
$personal = new PersonalController;
$data["data"] = $personal ->listar_personal();
$data["estado"] = 0;
if ( $data["data"] ) {
    $data["estado"] = 1;
}
echo json_encode($data);