<?php

namespace Form;

use Service\Session as Sess;
use Model\Entity\User;
use Model\Repository\UserRepository;

class UserHandleRequest extends BaseHandleRequest
{
    private $userRepository;

    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function handleInsertForm(User $user)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            extract($_POST);
            $errors = [];

            if (!empty($lastname)) {
                if (strlen($lastname) < 2) {
                    $errors[] = "Le nom doit avoir au moins 2 caractères";
                }
                if (strlen($lastname) > 30) {
                    $errors[] = "Le nom ne peut avoir plus de 30 caractères";
                }
            }
            if (!empty($firstname)) {
                if (strlen($firstname) < 2) {
                    $errors[] = "Le prénom doit avoir au moins 2 caractères";
                }
                if (strlen($firstname) > 30) {
                    $errors[] = "Le prénom ne peut avoir plus de 30 caractères";
                }
            }
            if (empty($password)) {
                $errors[] = "Le mot de passe ne peut pas être vide";
            }


            if (empty($errors)) {
                $password = password_hash($password, PASSWORD_DEFAULT);
                $user->setPrenom($firstname ?? null);
                $user->setNom($lastname ?? null);
                $user->setMotDePasse($password);
                $user->setEmail($email);
                $user->setPhone($phone);
                $user->setDateNaissance($birthday ?? null);
                $user->setAdresse($birthday ?? null);
                return $this;
            }
            $this->setEerrorsForm($errors);
            return $this;
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

            $this->setEerrorsForm($errors);
            return $this;
        }
    }
}