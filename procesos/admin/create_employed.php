<?php
session_start();
include "../../conexion/pdo_conexion.php";
include "../../models/personal.model.php";
include "../../controllers/personal.controller.php";
$personalcontroller = new PersonalController;
$_SESSION["flash"] = $personalcontroller->create_employed($_POST);
echo "<script>window.location = '../../?busqueda=personal_cas'</script>";