<?php
include "../conexion/pdo_conexion.php";
include "../models/papeleta.model.php"; 
include "../controllers/papeleta.controller.php";
$papeleta = new PapeletaController;
$data["estado"] = 0;
if ($papeleta->guardar_nueva_papeleta($_POST) == 1) {
    $data["estado"] = 1;
}
echo json_encode($data);