<?php
namespace Form;

use Service\Session as Sess;
use Service\CartManager;
use Form\BaseHandleRequest;

class PanierHandleRequest extends BaseHandleRequest
{
    private $userRepository;
    private $cartManager;

    public function __construct()
    {
        $this->cartManager = new CartManager;
    }

    public function handleInsertForm()
    {
        //condition verifier que la requete http et de type post et que la superglobale et remplie.
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST)) {
            // il extrait les donnees de $_post.( vu que $_post c'est un tableau associatif) il crée des variables donc les noms sont les clés du talbeau.
            extract($_POST);
            //il recupere la valeur de id_gateaux et la stock dans la variable
            $id_gateaux = $_POST['id_gateaux'];
            $this->cartManager->addCart($id_gateaux);
        } else {
            return false;
        }
    }

    public function handleEditForm($user)
    {
    }
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