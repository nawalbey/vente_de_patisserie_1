<?php
session_start();
include_once('../inc/database.php');

$gateaux = isset($_SESSION['cart']) ? $_SESSION['cart'] : null;
$id_user = $_SESSION['id'];


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

    $request = $db->prepare('INSERT INTO detail_commande (id_commande,id_gateau,quantite) VALUES (?,?,?)');
    var_dump($gateaux);
    die();
    foreach ($gateaux as $tableau => $articlesQuantite) {
        $id = $articlesQuantite['tableau']['id_gateaux'];
        $quantite = $articlesQuantite['quantite'];

        try {
            $request->execute([$id_commande, $id, $quantite]);
            unset($_SESSION['cart']);
            header('Location: http://localhost/vente_de_patisserie_1/gateaux.php');
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
} else {
    header('Location: http://localhost/vente_de_patisserie_1/views/login.php');
    $_SESSION['message_connexion'] = "Merci de vous connecter avant de commander !";
}