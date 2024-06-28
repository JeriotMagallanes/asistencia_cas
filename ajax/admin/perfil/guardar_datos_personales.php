<?php
include "../../../conexion/pdo_conexion.php";
include "../../../models/personal.model.php";
include "../../../controllers/personal.controller.php";
$personal = new PersonalController;
echo json_encode($personal->update_employed($_POST));
