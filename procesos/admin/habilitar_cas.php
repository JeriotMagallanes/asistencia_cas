<?php
include "../../conexion/pdo_conexion.php";
session_start();
$con = new pdo_conexion;
$qry = $con->prepare("UPDATE personal_administrativo SET estado='A' WHERE id_personal=:id_personal");
$qry->bindParam(":id_personal", $_POST["id_personal"]);
$qry->execute();
$_SESSION["flash"] = [
    "mensaje" => "Actualizado correctamente",
    "estado" => 1
];
echo "<script>location.href='../../index.php?busqueda=personal_cas'</script>";
