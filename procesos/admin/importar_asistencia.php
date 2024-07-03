<?php
include "../../conexion/pdo_conexion.php";
include "../../controllers/asistencia.controller.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_FILES['excelFile']) && isset($_POST['mes']) && isset($_POST['anio'])) {
        $fileTmpPath = $_FILES['excelFile']['tmp_name'];
        $mes = $_POST['mes'];
        $anio = $_POST['anio'];

        // Imprimir los valores recibidos para verificar
        echo "Mes recibido: " . $mes . "<br>";
        echo "Año recibido: " . $anio . "<br>";

        $controller = new AsistenciaController();
        $controller->importarAsistencia($fileTmpPath, $mes, $anio);

        echo "<script>window.location = '../../?busqueda=importar_asistencia'</script>";
    } else {
        echo "Por favor, seleccione un archivo y especifique mes y año.";
    }
}
?>
