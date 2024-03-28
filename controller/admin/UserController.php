<?php

namespace Controller\Admin;

use Model\Entity\User;
use Model\Repository\UserRepository;
use Form\UserHandleRequest;
use Controller\BaseController;

class UsersController extends BaseController
{
    private $userRepository;
    private $form;
    private $user;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
        $this->form = new UserHandleRequest;
        $this->user = new User;
    }
    public function list()
    {
        $users = $this->userRepository->findAll($this->user);

        $this->render("user/index.html.php", [
            "h1" => "Liste des utilisateurs",
            "users" => $users
        ]);
    }

    public function new()
    {
        $user = $this->user;
        $this->form->handleInsertForm($user);

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->userRepository->insertUser($user);
            return redirection(addLink("home"));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("user/form.html.php", [
            "h1" => "Ajouter un nouvel utilisateur",
            "user" => $user,
            "errors" => $errors
        ]);
    }

    public function edit($id)
    {
        if (!empty($id) && is_numeric($id) && $this->getUser()) {

            $user = $this->getUser();

            $this->form->handleEditForm($user);

            if ($this->form->isSubmitted() && $this->form->isValid()) {
                $this->userRepository->updateUser($user);
                return redirection(addLink("home"));
            }

            $errors = $this->form->getEerrorsForm();
            return $this->render("user/form.html.php", [
                "h1" => "Update de l'utilisateur n° $id",
                "user" => $user,
                "errors" => $errors
            ]);
        }
        return redirection("/errors/404.php");
    }

    public function delete($id)
    {
        if (!empty($id) && $id && $this->getUser()) {
            if (is_numeric($id)) {

                $user = $this->user;
            } else {
                $this->setMessage("danger", "ERREUR 404 : la page demandé n'existe pas");
            }
        } else {
            $this->setMessage("danger", "ERREUR 404 : la page demandé n'existe pas");
        }

        $this->render("user/form.html.php", [
            "h1" => "Suppresion de l'user n°$id ?",
            "user" => $user,
            "mode" => "suppression"
        ]);
    }

    // Méthode show($id) :
// Cette méthode est utilisée pour afficher les détails d'un utilisateur spécifique en fonction de son identifiant ($id).
// Elle prend l'identifiant de l'utilisateur en paramètre.
    public function show($id)
    {
        // Validation de l'identifiant :
// Le code vérifie d'abord si l'identifiant ($id) est défini et non vide. Cela permet de s'assurer qu'un identifiant valide a été fourni.
// Ensuite, il vérifie si l'identifiant est numérique à l'aide de la fonction is_numeric(). Si ce n'est pas le cas, cela signifie que l'identifiant n'est pas valide, et un message d'erreur "Erreur 404 : cette page n'existe pas" est défini à l'aide de la méthode setMessage() de la classe actuelle (qui semble être une sorte de gestionnaire de messages d'erreur).
// Si l'identifiant est valide, un objet utilisateur ($user) est créé. Cependant, dans le code fourni, $this->user est utilisé pour cela, ce qui suggère que $this->user est une propriété de la classe actuelle contenant les données de l'utilisateur. Assurez-vous que $this->user est correctement initialisé et qu'il contient les données de l'utilisateur dont vous avez besoin.
        if ($id) {
            if (is_numeric($id)) {

                $user = $this->user;
            } else {
                $this->setMessage("danger", "Erreur 404 : cette page n'existe pas");
            }
            // Redirection et message d'erreur :
// Si l'identifiant n'est pas défini ou s'il n'est pas valide, un message d'erreur est défini et une redirection est effectuée vers une autre URL à l'aide de la fonction redirection(). Il semble que cette redirection soit censée renvoyer l'utilisateur vers la page de liste des utilisateurs (addLink("user")).
        } else {
            $this->setMessage("danger", "Erreur 403 : vous n'avez pas accès à cet URL");
            redirection(addLink("user"));
        }
        // Affichage de la vue :
// Enfin, la méthode render() est appelée pour afficher la vue correspondante. La vue "user/show.html.php" est rendue avec les données de l'utilisateur ($user) et un titre "Fiche user" est passé à la vue.
        $this->render("user/show.html.php", [
            "user" => $user,
            "h1" => "Fiche user"
        ]);
    }
}