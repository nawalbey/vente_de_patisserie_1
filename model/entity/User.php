<?php

namespace Model\Entity;

class User extends BaseEntity
{    
    private $prenom;
    private $nom;
    private $email;
    private $mot_de_passe;
    private $date_naissance;
    private $adresse;
    private $numero_telephone;
    private $role;

    public function getPrenom()
    {
        return $this->prenom;
    }

    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom()
    {
        return $this->nom;
    }

    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }

    public function setMotDePasse($mot_de_passe)
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    public function setDateNaissance($date_naissance)
    {    
        $dateTime = new \DateTime($date_naissance);
        $this->date_naissance = $dateTime->format('d-m-Y');

        return $this;
    }
    
    public function getAdresse()
    {
        return $this->adresse;
    }

    public function setAdresse($adresse)
    {
        $this->adresse = $adresse;

        return $this;
    }
    public function getPhone()
    {
        return $this->numero_telephone;
    }

    public function setPhone($numero_telephone)
    {
        $this->numero_telephone = $numero_telephone;

        return $this;
    }

    public function getRole()
    {
        return $this->role;
    }

    public function setRole($role)
    {
        $this->role = $role !== null ? $role : "utilisateur";

        return $this;
    }

}