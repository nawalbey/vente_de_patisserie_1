<?php

namespace Model\Repository;

use Model\Entity\User;
use Service\Session;

class UserRepository extends BaseRepository
{
    public function checkUserExist($prenom, $email)
    {
        $request = $this->dbConnection->prepare("SELECT COUNT(*) FROM user WHERE email = :email OR prenom = :prenom");
        $request->bindParam(":prenom", $prenom);
        $request->bindParam(":email", $email);

        $request->execute();
        $count = $request->fetchColumn();
        return $count > 1 ? true : false;
    }

    public function insertUser(User $user)
    {
        $sql = "INSERT INTO user (nom, prenom, email, mot_de_passe, adresse, numero_telephone,date_de_naissance,role) VALUES (:nom, :prenom, :email, :mot_de_passe, :adresse, :numero_telephone, :date_de_naissance, :role)";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":nom", $user->getNom());
        $request->bindValue(":prenom", $user->getPrenom());
        $request->bindValue(":email", $user->getEmail());
        $request->bindValue(":mot_de_passe", $user->getMotdepasse());
        $request->bindValue(":adresse", $user->getAdresse());
        $request->bindValue(":numero_de_telephone", $user->getPhone());
        $request->bindValue(":date_de_naissance", $user->getDateNaissance());
        $request->bindValue(":role", $user->getRole());

        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "Le nouvel utilisateur a bien été enregistré");
                return true;
            }
            Session::addMessage("danger", "Erreur : l'utilisateur n'a pas été enregisté");
            return false;
        }
        Session::addMessage("danger", "Erreur SQL");
        return null;
    }

    // si je doit mettre a jour un utilisateur update ( ca veux dire mettre a jours)
    public function updateUser(User $user)
    {
        $sql = "UPDATE user 
                SET nom = :nom, prenom = :prenom, email = :email, mot_de_passe = :mot_de_passe, adresse = :adresse, date_de_naissance = :date_de_naissance, role = :role
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":id", $user->getId());
        $request->bindValue(":nom", $user->getNom());
        $request->bindValue(":prenom", $user->getPrenom());
        $request->bindValue(":mot_de_passe", $user->getMotDePasse());
        $request->bindValue(":email", $user->getEmail());
        $request->bindValue(":adresse", $user->getAdresse());
        $request->bindValue(":date_de_naissance", $user->getDateNaissance());
        $request->bindValue(":role", $user->getRole());
        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "La mise à jour de l'utilisateur a bien été éffectuée");
                return true;
            }
            Session::addMessage("danger", "Erreur : l'utilisateur n'a pas été mise à jour");
            return false;
        }
        Session::addMessage("danger", "Erreur SQL");
        return null;
    }
    // fin

    // pour l'utilisateur qui se connecte
    public function loginUser($email)
    {
        $request = $this->dbConnection->prepare("SELECT * FROM user WHERE email = :email");
        $request->bindParam(":email", $email);

        if ($request->execute()) {
            if ($request->rowCount() == 1) {
                $request->setFetchMode(\PDO::FETCH_CLASS, "Model\Entity\User");
                return $request->fetch();
            } else {
                return false;
            }
        } else {
            return null;
        }
    }
    // Fin
}