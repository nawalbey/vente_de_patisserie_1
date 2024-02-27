<?php
//On démarre une nouvelle session
session_start();

require_once "../inc/database.php";
if (isset($_POST['connexion'])) {

    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    if (isset($_SESSION['email'])) {
        $_SESSION["message"] = "vous êtes déjà connecté";
        header("Location: http://localhost/");
    }
    //etablir la connexion avec la bd 
    $db = dbConnexion();
    //preparer la requete
    $request = $db->prepare("SELECT * FROM user WHERE email = ?");
    //executer la requete
    try {
        $request->execute(array($email));
        //recuperer la resultat de la requete
        $userInfo = $request->fetch(PDO::FETCH_ASSOC);
        if (empty($userInfo)) {
            echo "utilisateur inconnu";
        } else {
            // Vérifier si le mot de passe est correct
            if (password_verify($password, $userInfo['mot_de_passe'])) {
                // Si l'utilisateur est un admin
                if ($userInfo['role'] == "role_admin") {
                    $_SESSION["id"] = $userInfo["id_user"];
                    $_SESSION["nom"] = $userInfo["nom"];
                    $_SESSION["prenom"] = $userInfo['prenom'];
                    $_SESSION["email"] = $userInfo["email"];
                    $_SESSION["role"] = $userInfo["role"];
                    header("Location: http://localhost/vente_de_patisserie/admin/admin.php");
                } else {
                    $_SESSION["id"] = $userInfo["id_user"];
                    $_SESSION["nom"] = $userInfo["nom"];
                    $_SESSION["prenom"] = $userInfo['prenom'];
                    $_SESSION["email"] = $userInfo["email"];
                    $_SESSION["role"] = $userInfo["role"];
                    header("Location: http://localhost/vente_de_patisserie/views/gateaux.php");
                }
            } else {
                echo "Mot de passe incorrect";
            }
        }
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}