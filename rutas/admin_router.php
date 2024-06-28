<?php
$s = isset($_GET['busqueda']) ? $_GET['busqueda'] : 'default';
$mes = isset($_GET['sel_mes_ini']) ? $_GET['sel_mes_ini'] : date('n');
$anio = isset($_GET['sel_anio']) ? $_GET['sel_anio'] : date('Y');

switch ($s) {
    case 'personal_cas':
        include "./view/admin/personal_cas.php";
        break;
    case 'asistencia_general':
        $_GET['sel_mes_ini'] = $mes;
        $_GET['sel_anio'] = $anio;
        include "./view/admin/reporte_asistencias_general.php";
        break;
    case 'asistencia':
        include "./view/admin/asistencia_cas.php";
        break;
    case 'usuarios':
        include "./view/admin/acceso_usuarios.php";
        break;
    case 'comision':
        include "./view/admin/papeleta.comision.php";
        break;
    case 'personal':
        include "./view/admin/papeleta.personal.php";
        break;
    case 'logout':
        session_destroy();
        echo '<script>location.href = "./index.php";</script>';
        break;
    case 'info':
        include "./view/admin/info_personal.php";
        break;
    case 'frm_rep':
        include "./view/admin/frm_reportes.php";
        break;
    case 'export':
        include "./view/admin/export_by.php";
        break;
    default:
        include "./view/admin/panel_control.php";
        break;
}
?>
