<?php
include '../conexion/pdo_conexion.php';
// include '../../boletasdepago/librerias/google7/vendor/autoload.php';
require_once ('../google7/vendor/autoload.php');
session_start();

if (true){


    $_SESSION['EMAIL'] = "urecursoshumanos@undc.edu.pe";
    $_SESSION['picture'] = null;

    $con = new pdo_conexion();
    $correo_login = $_SESSION["EMAIL"];
    $qry = $con->prepare("SELECT * FROM usuarios_asicas WHERE (cor_inst=:cor_inst) and estado='A' LIMIT 1");
    $qry->bindParam(":cor_inst", $correo_login);
    $qry->execute();
    $row = $qry->fetchAll();
    if($row){// es administrador
        $_SESSION["auth"] = 1;
        $_SESSION["nombre"] = $row[0]["nom_usu"];
        $_SESSION["apepat"] = $row[0]["ape_pat"];
        $_SESSION["apemat"] = $row[0]["ape_mat"];
        $_SESSION["estado"] = $row[0]["estado"];
        $_SESSION["cor_pers"] = $row[0]["cor_per"];
        $_SESSION["cor_inst"] = $row[0]["cor_inst"];
        // $_SESSION["rol"] = $row[0]["rol"];
        $_SESSION["id_usu"] = $row[0]["id_usu"];
        $_SESSION["id_admin"]  = $row[0]["id_usu"];
        $isadmin = 1;
    }else{
        $isadmin = 0;
        
    }
    //no se encontro el mail (no es administrador)
    $qry2 = $con->prepare("SELECT * FROM personal_administrativo WHERE cor_inst=:cor_inst LIMIT 1");
    $qry2->bindParam(":cor_inst", $correo_login);
    $qry2->execute();
    $row2 = $qry2->fetchAll();
    if ($row2) {// es personal CAS
        $_SESSION["auth"] = 1;
        $_SESSION["nombre"] = $row2[0]["nombres"];
        $_SESSION["apepat"] = $row2[0]["amaterno"];
        $_SESSION["apemat"] = $row2[0]["apaterno"];
        $_SESSION["dni"] = $row2[0]["dni_pa"];
        $_SESSION["estado"] = $row2[0]["estado"];
        $_SESSION["cor_inst"] = $row2[0]["cor_inst"];
        // $_SESSION["rol"]["personal"] = "C";
        $_SESSION["id_usu"] = $row2[0]["id_personal"];
        $iscas = 1;
    }else{
        $iscas = 0;
    }
    $_SESSION["rol"] = [
        "admin"=>$isadmin,
        "cas"=>$iscas
    ];
    if ($_SESSION["rol"]["admin"] === 1){
        $_SESSION["dashboard"] = "admin";
    }else if ($_SESSION["rol"]["cas"] === 1) {
        $_SESSION["dashboard"] = "cas";
    }
}
header("Location: ../index.php");
// echo json_encode($_SESSION["rol"]);
// consulta primero en tabla ADMINISTRADOR luego en PERSONAL CAS
// 