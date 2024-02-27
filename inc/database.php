<?php
function dbConnexion()
{
    $connexion = null;
    try {
        $connexion = new PDO("mysql:host=localhost;dbname=vente_de_patisserie", "root", "");
    } catch (PDOException $e) {
        $connexion = $e->getMessage();
    }
    return $connexion;
}