<?php
session_start();
//si $_SESSION['role'] est definie mais que sa valeur est differente de "ademin" ou encore que $_SESSION ['role'] n'est pas definie
if (!isset($_SESSION['role']) || $_SESSION['role'] != "role_admin") {
    header("Location: http://localhost/vente_de_patisserie/views/login.php");
} else {
    header("Location: http://localhost/vente_de_patisserie/admin/ajout_gateau.php");
}
include_once "../inc/header.php";