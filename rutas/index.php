<?php
if ($_SESSION["dashboard"] === "admin") {//administrador
    include "./rutas/admin_router.php";
}
if ($_SESSION["dashboard"] === "cas") {//personal cas
    include "./rutas/cas_router.php";
}
// session_destroy();