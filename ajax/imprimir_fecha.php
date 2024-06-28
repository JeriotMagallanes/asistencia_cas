<?php
include "../helper/formato_fecha.php";
$data["fecha"] = FormatoFecha::formato_fecha2($_POST["fecha"]);
echo json_encode($data);