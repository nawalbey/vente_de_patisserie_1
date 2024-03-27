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
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['inscription'])) {

            extract($_POST);
            // d_die($_POST);
            $errors = [];

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


            if (empty($errors)) {
                $password = password_hash($mot_de_passe, PASSWORD_DEFAULT);
                $user->setPrenom($prenom ?? null);
                $user->setNom($nom ?? null);
                $user->setMotDePasse($password);
                $user->setEmail($email);
                $user->setPhone($numero_telephone);
                $user->setDateNaissance($date_de_naissance ?? null);
                $user->setAdresse($adresse ?? null);
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