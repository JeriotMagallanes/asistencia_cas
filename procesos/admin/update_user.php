<?php
include "../../conexion/pdo_conexion.php";
include "../../models/usuario.model.php";
include "../../controllers/usuario.controller.php";
session_start();
$usuario = new UsuarioController;
if (isset($_POST["btn_ed_usu"])) {
    echo "Datos enviados";
}
$post_data = [
    "id_usu" => $_POST["ed_idusu"],
    "ape_pat" => $_POST["ed_apepat"],
    "ape_mat" => $_POST["ed_apemat"],
    "nom_usu" => $_POST["ed_nombres"],
    "cor_per" => $_POST["ed_gmail"],
    "cor_inst" => $_POST["ed_inst"],
    "estado" => $_POST["sel_ed_est"],
];
$flash = $usuario->actualizar_usuario($post_data);
$_SESSION["flash"] = $flash;
echo "<script>window.location = '../../?busqueda=usuarios'</script>";