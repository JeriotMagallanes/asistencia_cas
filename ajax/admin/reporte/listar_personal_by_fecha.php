<?php
include "../../../conexion/pdo_conexion.php";
include "../../../helper/formato_fecha.php";
include "../../../models/reporte.model.php";
include "../../../controllers/reporte.controller.php";
$reporte = new ReporteController;
echo json_encode($reporte->listar_personal_by_fecha(FormatoFecha::formato_dmy($_POST["fecha"])));