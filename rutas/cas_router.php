<?php
switch ($s) {
    case 'mi_asistencia':
        include "./view/personal_cas/mi_asistencia.php";
        break;
    case 'logout':
        session_destroy();
        // header("Location: ./index.php");
        echo '<script>location.href = "./index.php";</script>';
        break;
    default:
        include "./view/personal_cas/mi_asistencia.php";
        break;
} 