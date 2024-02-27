<?php
session_start();
require_once "../inc/database.php";

if (isset($_POST['inscription'])) {
    // recuperation des info
    $nom = htmlspecialchars($_POST['nom']);
    $prenom = htmlspecialchars($_POST['prenom']);
    $mot_de_passe = htmlspecialchars($_POST['mot_de_passe']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $email = htmlspecialchars($_POST['email']);
    $numero_telephone = htmlspecialchars($_POST['numero_telephone']);
    $date_de_naissance = htmlspecialchars($_POST['date_de_naissance']);

    // se connecter a la base de donnees
    $db = dbConnexion();
    // preparer la requete
    $request = $db->prepare("INSERT INTO user (nom, prenom,email, mot_de_passe,adresse, numero_telephone, date_de_naissance) VALUES (?, ?, ?, ?, ?, ?, ?)");
    // executer la requete
    try {
        $passwordHash = password_hash($mot_de_passe, PASSWORD_DEFAULT);
        $request->execute(array($nom, $prenom, $email, $passwordHash, $adresse, $numero_telephone, $date_de_naissance));
        $_SESSION['inscription_reussie'] = "Votre inscription s'est correctement déroulée";
        header("Location: http://localhost/vente_de_patisserie/views/login.php");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}