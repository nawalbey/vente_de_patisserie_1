<?php
/**
 * Summary of namespace Controller
 */

// Namespace et Utilisation
namespace Controller;

use Model\Entity\User;
use Model\Repository\UserRepository;
use Form\UserHandleRequest;

// namespace Controller;: Déclare que la classe UserController est dans l'espace de noms Controller.
// use Model\Entity\User;: Importe la classe User du namespace Model\Entity.
// use Model\Repository\UserRepository;: Importe la classe UserRepository du namespace Model\Repository.
// use Form\UserHandleRequest;: Importe la classe UserHandleRequest du namespace Form.

/**
 * Summary of UserController
 */

//  Déclaration de la Classe UserController
class UserController extends BaseController
{
    // UserController est une classe qui étend BaseController, ce qui implique qu'elle hérite des fonctionnalités de BaseController.

    // Propriétés
    private UserRepository $userRepository;
    private UserHandleRequest $form;
    private User $user;
    // $userRepository: Instance de UserRepository utilisée pour interagir avec la base de données des utilisateurs.
// $form: Instance de UserHandleRequest utilisée pour gérer les formulaires relatifs aux utilisateurs.
// $user: Instance de User utilisée pour stocker les données de l'utilisateur actuel.

    // Constructeur
    public function __construct()
    {
        // Initialise les instances de UserRepository, UserHandleRequest, et User dans le constructeur.
        $this->userRepository = new UserRepository;
        $this->form = new UserHandleRequest;
        $this->user = new User;
    }

    // Méthode list()
    public function list()
    {
        $users = $this->userRepository->findAll($this->user);

        $this->render("user/index.html.php", [
            "h1" => "Liste des utilisateurs",
            "users" => $users
        ]);
    }
    // Cette méthode récupère tous les utilisateurs depuis la base de données à l'aide de UserRepository.
// Ensuite, elle rend la vue user/index.html.php avec les données des utilisateurs.

    // partie inscription (formulaire)
    // Méthode new()
    public function new()
    {
        $user = $this->user;
        $this->form->handleInsertForm($user);
        if ($this->form->isSubmitted() && $this->form->isValid()) {
            $this->userRepository->insertUser($user);
            return redirection(addLink("user", "login"));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("user/inscription.html.php", [
            "h1" => "Ajouter un nouvel utilisateur",
            "user" => $user,
            "errors" => $errors
        ]);
    }
    // Cette méthode gère l'ajout d'un nouvel utilisateur.
// Elle traite la soumission du formulaire d'inscription, valide les données et insère l'utilisateur dans la base de données si elles sont valides.
// Sinon, elle affiche la vue d'inscription avec les erreurs de validation.

    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     */

    //  Méthode edit($id)
    public function edit($id)
    {
        if (!empty($id) && is_numeric($id) && $this->getUser()) {

            /**
             * @var User
             */
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
    // Cette méthode gère la modification d'un utilisateur existant.
// Elle récupère l'utilisateur à éditer, gère la soumission du formulaire de modification, et met à jour l'utilisateur dans la base de données si les données sont valides.
// Sinon, elle affiche la vue de modification avec les erreurs de validation.

    // éthode delete($id)
// Gère la suppression d'un utilisateur
// Cette méthode est censée gérer la suppression d'un utilisateur, mais elle n'est pas entièrement implémentée dans le code fourni.

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

    // Méthode show($id)
    // Cette méthode est censée afficher les détails d'un utilisateur, mais elle n'est pas entièrement implémentée dans le code fourni.
    public function show($id)
    {
        if ($id) {
            if (is_numeric($id)) {
                $user = $this->user;
            } else {
                $this->setMessage("danger", "Erreur 404 : cette page n'existe pas");
            }
        } else {
            $this->setMessage("danger", "Erreur 403 : vous n'avez pas accès à cet URL");
            redirection(addLink("user", "list"));
        }

        $this->render("user/show.html.php", [
            "user" => $user,
            "h1" => "Fiche user"
        ]);
    }
    // Méthode login()
    // connexion
    // Cette méthode gère la connexion de l'utilisateur en traitant la soumission du formulaire de connexion, en vérifiant les données soumises, et en démarrant une session si l'authentification est réussie.
    public function login()
    {
        // Cette méthode login() est responsable de la gestion du processus de connexion de l'utilisateur. Voici une explication détaillée du code :
// Vérification de la Connexion de l'Utilisateur
        if ($this->isUserConnected()) {
            /**
             * @var User
             */
            $user = $this->getUser();

            $this->setMessage("erreur", $user->getPrenom() . " , vous êtes déjà connecté");
            return redirection(addLink("home"));
        }
        // Cette partie vérifie d'abord si l'utilisateur est déjà connecté en appelant la méthode isUserConnected() qui retourne true si un utilisateur est déjà connecté.
// Si un utilisateur est déjà connecté, un message d'erreur est défini pour informer l'utilisateur de sa connexion et une redirection vers la page d'accueil est effectuée.

        // Traitement de la Soumission du Formulaire de Connexion
        $this->form->handleLogin();

        if ($this->form->isSubmitted() && $this->form->isValid()) {
            /**
             * @var User
             */
            $user = $this->getUser();
            $this->setMessage("succes", "Bonjour " . $user->getPrenom() . ", vous êtes connecté");
            redirection(addLink("home"));
            return redirection(addLink("home"));
        }
        // La méthode handleLogin() de l'objet $form est appelée pour gérer la soumission du formulaire de connexion. Cette méthode vérifie si le formulaire a été soumis et valide les données.
// Si le formulaire est soumis et que les données sont valides, l'utilisateur est récupéré à partir de la session à l'aide de getUser().
// Un message de succès est défini pour accueillir l'utilisateur connecté, puis une redirection vers la page d'accueil est effectuée.

        // Affichage du Formulaire de Connexion en Cas d'Erreurs
        $errors = $this->form->getEerrorsForm();

        return $this->render("security/login.html.php", [
            "h1" => "Entrez vos identifiants de connexion",
            "errors" => $errors
            // Si le formulaire n'a pas été soumis ou s'il y a des erreurs de validation, la méthode getEerrorsForm() est utilisée pour récupérer les erreurs.
// Ensuite, la vue security/login.html.php est rendue avec le titre et les erreurs récupérés pour afficher le formulaire de connexion avec les erreurs appropriées.
        ]);
    }
    // Méthode logout()
    // Cette méthode gère la déconnexion de l'utilisateur en mettant fin à la session en cours.
// En résumé, le UserController gère différentes actions liées aux utilisateurs, telles que l'ajout, la modification, la suppression, la connexion et la déconnexion, en interagissant avec la base de données via UserRepository et en traitant les formulaires avec UserHandleRequest.
    public function logout()
    {
        $this->disconnection();
        $this->setMessage("success", "Vous êtes déconnecté");
        redirection(addLink("home"));
    }
}