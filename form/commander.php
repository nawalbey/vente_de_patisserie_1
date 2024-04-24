<?php
session_start();
include_once('../inc/database.php');
require_once('../inc/cart.php');

$Gateaux = getDetails();
$id_user = $_SESSION['id'];

var_dump($Gateaux);
if (isset($_GET['commande']) && $_GET['commande'] == 'true' && isset($_SESSION['id'])) {
    $db = dbConnexion();
    $request = $db->prepare('INSERT INTO commande (numero_commande, date_de_commande, id_user) VALUES (RAND() * (5000 - 200) + 200,NOW(),?)');
    try {
        $request->execute(array($id_user));
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    // Récupérer l'ID de la commande insérée
    $id_commande = $db->lastInsertId();

    $request = $db->prepare('INSERT INTO detail (id_commande,id_gateau,quantite) VALUES (?,?,?)');
    foreach ($Gateaux['products'] as $articlesQuantite) {
        $id = $articlesQuantite['product']['id_Gateaux'];
        $quantite = $articlesQuantite['quantity'];

        try {
            $request->execute([$id_commande, $id, $quantite]);
            unset($_SESSION['cart']);
            unset($_SESSION['nombre']);
            $_SESSION['commande_passee'] = "Votre commande a bien été passée";
            header('Location: http://localhost/vente_de_patisserie_1/views/Gateaux.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} else {
    header('Location: http://localhost/vente_de_patisserie_1/views/login.php');
    $_SESSION['message_connexion'] = "Merci de vous connecter avant de commander !";
}