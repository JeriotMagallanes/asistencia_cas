<?php
session_start();
if ($_SESSION["auth"] !== 1) {
    header("Location: ../index.php");
}
if ($_SESSION["rol"]["admin"] === 1 && $_SESSION["rol"]["cas"] === 1) {
    $_SESSION["dashboard"]="admin";
}
header("Location: ../index.php");