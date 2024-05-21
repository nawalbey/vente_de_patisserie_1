<?php

namespace Controller;

use Service\Session as Sess;

//une class abstraite est une class non instanciable 
abstract class BaseController
{
    // Méthode render($fichier, array $parametres = []) :

// Cette méthode est utilisée pour inclure un fichier de vue spécifié et passer des paramètres à ce fichier.
// Elle extrait les paramètres avec extract($parametres) pour que les clés du tableau deviennent des variables dans le fichier inclus.
// Elle inclut ensuite le fichier d'en-tête (header.html.php), le fichier de vue spécifié, puis le fichier de pied de page (footer.html.php).
    public function render($fichier, array $parametres = [])
    {
        extract($parametres);

        include "public/header.html.php";
        include "views/$fichier";
        include "public/footer.html.php";
    }

    //public function getUser et une methode public static.
    public function getUser()
    {
        //$variable User sess ( viens de la classe session du fichier service session.php) static et la methode getUserConnected.
        $user = Sess::getUserConnected();

        // il faut vérifier si id utilisateur de url est bien le même id que l'utilsateur connecté

        if (!$user) {
            redirection("/errors/403.php");
        }
        return $user;
    }

    public function isUserConnected()
    {
        return Sess::isConnected();
    }

    public function getAdmin()
    {
        $user = Sess::isAdmin();

        if (!$user) {
            redirection("/errors/403.php");
        }
        return $user;
    }

    
    /**
     * Summary of setMessage
     *
     * @param  mixed $type
     * @param  mixed $message
     * @return void
     */
    public function setMessage($type, $message)
    {
        Sess::addMessage($type, $message);
    }

    public function disconnection()
    {
        Sess::disconnected();
    }
    public function remove($value)
    {
        Sess::delete($value);
    }

    public function redirectToRoute(array $linkInfo)
    {
        $controller = $linkInfo[0];
        $method = $linkInfo[1] ?? null;
        $id = $linkInfo[2] ?? null;
        redirection(addLink($controller, $method, $id));
    }
}