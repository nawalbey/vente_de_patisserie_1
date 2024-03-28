<?php

namespace Controller;

use Service\Session as Sess;


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

    // Méthodes utilitaires :

    // getUser(): Récupère l'utilisateur connecté à partir de la session. Si aucun utilisateur n'est connecté, redirige vers une page d'erreur 403.
// isUserConnected(): Vérifie si un utilisateur est connecté en consultant la session.
// getAdmin(): Récupère l'utilisateur connecté en tant qu'administrateur. Si l'utilisateur n'est pas un administrateur, redirige vers une page d'erreur 403.
// setMessage($type, $message): Ajoute un message à la session. Ces messages peuvent être de différents types, comme "success", "danger", etc.
// disconnection(): Déconnecte l'utilisateur en effaçant les données de session.
// remove($value): Supprime une valeur spécifique de la session.
// redirectToRoute(array $linkInfo): Redirige vers une route spécifique en fonction des informations fournies dans le tableau $linkInfo.
    public function getUser()
    {
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