<?php

namespace Form;

use Service\Session as Sess;
use Model\Entity\User;
use Model\Repository\UserRepository;

// namespace Form;: Déclare que la classe UserHandleRequest est dans l'espace de noms Form.
// use Service\Session as Sess;: Importe la classe Session du namespace Service sous l'alias Sess.
// use Model\Entity\User;: Importe la classe User du namespace Model\Entity.
// use Model\Repository\UserRepository;: Importe la classe UserRepository du namespace Model\Repository.

// Déclaration de la Classe
// UserHandleRequest est une classe qui étend BaseHandleRequest.
class UserHandleRequest extends BaseHandleRequest
{
    // Propriétés
    private $userRepository;
    // $userRepository est une propriété privée qui sera utilisée pour accéder à l'instance de UserRepository.

    // Constructeur
    public function __construct()
    // Le constructeur initialise la propriété $userRepository en créant une nouvelle instance de UserRepository.
    {
        $this->userRepository = new UserRepository;
    }

    // Méthode handleInsertForm()
    // Cette méthode handleInsertForm() est utilisée pour valider et gérer la soumission du formulaire d'inscription d'un nouvel utilisateur. Voici une explication du code :
    public function handleInsertForm(User $user)
    {
        // Vérification de la Méthode de Requête et de la Soumission du Formulaire
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscription']))
        // Cette condition vérifie si la méthode de requête est POST et si le formulaire d'inscription a été soumis. Cela garantit que le code de validation ne s'exécute que lorsque le formulaire est soumis. 
        {
            // Extraction des Données POST
            extract($_POST);
            // La fonction extract() est utilisée pour extraire les données des champs du formulaire POST dans des variables distinctes. Cela permet d'accéder directement aux valeurs des champs par leur nom.
            $errors = [];

            // Validation des Champs du Formulaire
            if (!empty($nom)) {
                if (strlen($nom) < 2) {
                    $errors[] = "Le nom doit avoir au moins 2 caractères";
                }
                if (strlen($nom) > 30) {
                    $errors[] = "Le nom ne peut avoir plus de 30 caractères";
                }
            }
            if (!empty($prenom)) {
                if (strlen($prenom) < 2) {
                    $errors[] = "Le prénom doit avoir au moins 2 caractères";
                }
                if (strlen($prenom) > 30) {
                    $errors[] = "Le prénom ne peut avoir plus de 30 caractères";
                }
            }
            if (empty($mot_de_passe)) {
                $errors[] = "Le mot de passe ne peut pas être vide";
            }
            // Ces instructions effectuent la validation des champs du formulaire.
// Pour chaque champ ($nom, $prenom, $mot_de_passe), elles vérifient s'il est vide ou s'il ne respecte pas les critères spécifiés (longueur minimale et maximale).
// Si une validation échoue, un message d'erreur est ajouté au tableau $errors.

            // Retour des Erreurs ou Traitement de l'Inscription
            if (empty($errors)) {
                // Si aucune erreur n'est survenue, le formulaire est considéré comme valide
                // Ici, généralement, on enregistrerait les données dans la base de données ou effectuerait d'autres actions nécessaires 
                // Dans le cas suivant on "remplit" l'entité User avec les valeurs des variables prises dans $_POST
                $password = password_hash($mot_de_passe, PASSWORD_DEFAULT);
                $user->setPrenom($prenom);
                $user->setNom($nom);
                $user->setMotDePasse($password);
                $user->setEmail($email);
                $user->setPhone($numero_telephone);
                $user->setAdresse($adresse);
                $user->setDateNaissance($date_de_naissance);
                $user->setRole(null);
                return $this;
            }
            // S'il y a des erreurs, elles sont retournées pour être affichées à l'utilisateur
            $this->setErrorsForm($errors);
            return $this;
        }
    }

    // Méthode handleEditForm()
    public function handleEditForm($user)
    {
        // Cette méthode est déclarée mais n'est pas implémentée dans le code fourni.
    }

    // Méthode handleLogin()
    public function handleLogin()
    {
        if (($_SERVER['REQUEST_METHOD'] === 'POST') && isset($_POST["connexion"])) {

            extract($_POST);
            $errors = [];
            if (empty($email) || empty($password)) {
                $errors[] = "Veuillez inserer vos coordonnées";
            } else {
                $user = $this->userRepository->loginUser($email);
                if (empty($user)) {
                    $errors[] = "Il n'y a pas d'utilisateur avec cet email";
                } else {
                    if (!password_verify($password, $user->getMotDePasse())) {
                        $errors[] = "Le mot de passe ne correspond pas";
                    }
                }
            }
            if (empty($errors)) {
                Sess::authentication($user);
                return $this;
            }

            $this->setErrorsForm($errors);
            return $this;
        }
    }
}
// Cette méthode traite la soumission du formulaire de connexion.
// Elle valide les données du formulaire, vérifie l'authentification de l'utilisateur et démarre une session si l'authentification réussit.
// Sinon, elle enregistre les erreurs et retourne l'instance de la classe.

// Conclusion
// Ce code est une partie d'un système d'authentification et de gestion d'utilisateurs en PHP. Il gère l'insertion d'un nouvel utilisateur ainsi que la connexion d'un utilisateur existant.