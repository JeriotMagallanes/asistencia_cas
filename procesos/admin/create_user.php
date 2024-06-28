<?php
include "../../conexion/pdo_conexion.php";
include "../../models/usuario.model.php";
include "../../controllers/usuario.controller.php";
session_start();
$usuario = new UsuarioController;
if (isset($_POST["btn_cr_usu"])) {
    echo "Crear usuario";
    $post_data = [
        "ape_pat" => $_POST["cr_apepat"],
        "ape_mat" => $_POST["cr_apemat"],
        "nom_usu" => $_POST["cr_nombres"],
        "cor_per" => $_POST["cr_gmail"],
        "cor_inst" => $_POST["cr_inst"],
        "estado" => $_POST["sel_cr_est"],
    ];
    $_SESSION["flash"] = $usuario->agregar_usuario($post_data);
}
echo "<script>window.location = '../../?busqueda=usuarios'</script>";