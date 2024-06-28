<?php
include "../helper/formato_fecha.php";
include "../helper/asistencia.php";
include "../helper/local_undc.php";
include "../conexion/pdo_conexion.php";
include "../models/transmisor.model.php";
include "../models/personal.model.php";
include "../controllers/transmisor.controller.php";
date_default_timezone_set('America/Lima');
if ($_POST["fecha"]) {
    $nfecha = explode("-",$_POST["fecha"]);
    $fec_hoy = $nfecha[2]."-".$nfecha[1]."-".$nfecha[0];
}else{
    $fec_hoy = date("d-m-Y");
}
$transmisor = new TransmisorController;
$data["data"] = $transmisor->registro_por_dia($fec_hoy);
echo json_encode($data);