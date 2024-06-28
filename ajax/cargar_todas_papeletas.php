<?php
include "../conexion/pdo_conexion.php";
include "../models/papeleta.model.php";
include "../controllers/papeleta.controller.php";
$papeleta = new PapeletaController;
$data["data"] = $papeleta->dt_todas_papeletas();
echo json_encode($data);