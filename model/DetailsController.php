<?php
session_start();
include_once('../inc/database.php');

// Si 'id_gateau' existe dans $_GET
if (isset($_GET['id_gateau'])) {
    function getDetailsGateau()
    {
        // on récupère l'id de $_GET pour le stocker dans une variable
        $id = $_GET['id_gateau'];
        $db = dbConnexion();
        $request = $db->prepare('SELECT * FROM list_gateaux WHERE id_gateaux = ?');
        try {
            $request->execute([$id]);
            // après execute, il nous renvoit le resultat de la requête (soit un tableau s'il trouve, soit null si rien n'a été trouvé)
            $gateau = $request->fetch(PDO::FETCH_ASSOC);
            // Si il a un resultat : 
            if ($gateau) {
                // On stock le tableau dans la session sous la clé 'detail_gateau' qui contiendra toutes les informations,
                // pour y acceder on parcourera le tableau comme ceci: $_SESSION['detail_gateau']['id_gateaux']
                $_SESSION['detail_gateau'] = $gateau;
                header('Location: http://localhost/vente_de_patisserie/views/detail_gateaux.php');
            } else {
                $_SESSION['erreur_id_detail'] = "Le gateau n'a pas été trouvé ! ";
            }
            // En cas d'erreur:
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }

    // On appelle la fonction ici pour qu'elle soit executée, sinon il ne se passera jamais rien (Une fonction doit être appelée pour s'executer)
    getDetailsGateau();
}