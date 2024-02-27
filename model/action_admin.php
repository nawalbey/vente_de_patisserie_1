<?php
require_once('../inc/database.php');

if(isset($_POST['ajout_gateau'])) {
    $n_g = htmlspecialchars($_POST['n_gateau']);
    $d_g = htmlspecialchars($_POST['d_gateau']);
    $p_g = htmlspecialchars($_POST['p_gateau']);


    $imgName = $_FILES['i_gateau']['name'];

    $tmp_name = $_FILES['i_gateau']['tmp_name'];

    $destination = $_SERVER['DOCUMENT_ROOT']."/vente_de_patisserie/asset/img/".$imgName;

    move_uploaded_file($tmp_name, $destination);
    // Connexion base de données : 
    $db = dbConnexion();
    // Préparation de la requête
    $request = $db->prepare('INSERT INTO list_gateaux (nom_du_gateaux,description,prix,photo) VALUES (?,?,?,?)');

    try { // on essaye d'executer la requête
        $request->execute(array($n_g, $d_g, $p_g, $imgName));
        header('Location: http://localhost/vente_de_patisserie/admin/ajout_gateau.php');
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}

// Récupération des gateaux

function gateaux_liste() {
    $db = dbConnexion();

    $request = $db->prepare('SELECT * FROM list_gateaux');
    try {
        $request->execute(array());
        $gateaux = $request->fetchAll();
        return $gateaux;
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}
function findGateauById($id) {
    $db = dbConnexion();
    try {
        $request = $db->prepare("SELECT * FROM list_gateaux WHERE id_gateaux = :id");
        $request->bindParam(":id", $id);

        if ($request->execute()) {
            if ($request->rowCount() == 1) {
                $gateaux = $request->fetch(\PDO::FETCH_ASSOC);
                return $gateaux;
            } else {
                return false;
            }
        } else {
            return null;
        }
    } catch (PDOException $error) {
        echo $error->getMessage();
    }
}