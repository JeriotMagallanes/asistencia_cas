<?php
// Verificar si se recibieron los datos esperados
if (isset($_POST['mes'], $_POST['anio'], $_POST['archivo'])) {
    $mes = $_POST['mes'];
    $anio = $_POST['anio'];
    $archivo = $_POST['archivo'];

    // Validar que el mes no sea null o vacío
    if (!empty($mes)) {
        // Aquí realizas tu lógica para insertar en la base de datos
        // Ejemplo:
        $stmt = $pdo->prepare("INSERT INTO asistencias (mes, anio, archivo) VALUES (?, ?, ?)");
        $stmt->execute([$mes, $anio, $archivo]);
        echo "Datos insertados correctamente.";
    } else {
        echo "El valor del mes no puede estar vacío.";
    }
} else {
    echo "No se recibieron todos los datos necesarios.";
}
?>
