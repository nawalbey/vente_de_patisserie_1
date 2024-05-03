<?php
session_start();
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: http://localhost/vente_de_patisserie_1/views/login.php');
}

