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

    /**
     * Get the value of firstname
     */ 
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of lastname
     */ 
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set the value of lastname
     *
     * @return  self
     */ 
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }


    /**
     * Get the value of password
     */ 
    public function getMotDePasse()
    {
        return $this->mot_de_passe;
    }

    /**
     * Set the value of MotDePasse
     *
     * @return  self
     */ 
    public function setMotDePasse($mot_de_passe)
    {
        $this->mot_de_passe = $mot_de_passe;

        return $this;
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of birthday
     */ 
    public function getDateNaissance()
    {
        return $this->date_naissance;
    }

    /**
     * Set the value of birthday
     *
     * @return  self
     */ 
    public function setDateNaissance($date_naissance)
    {    
        $dateTime = new \DateTime($date_naissance);
        $this->date_naissance = $dateTime->format('d-m-Y');

        return $this;
    }

    /**
     * Get the value of phone
     */ 
    public function getPhone()
    {
        return $this->numero_telephone;
    }

    /**
     * Set the value of phone
     *
     * @return  self
     */ 
    public function setPhone($numero_telephone)
    {
        $this->numero_telephone = $numero_telephone;

        return $this;
    }

    /**
     * Get the value of role
     */ 
    public function getRole()
    {
        return $this->role;
    }

    /**
     * Set the value of role
     *
     * @return  self
     */ 
    public function setRole($role)
    {
        $this->role = $role !== null ? $role : "utilisateur";

        return $this;
    }

    /**
     * Get the value of address
     */ 
    public function getAdresse()
    {
        return $this->adresse;
    }

    /**
     * Set the value of address
     *
     * @return  self
     */ 
    public function setAdresse($adresse)
    {
        $this->$adresse = $adresse;

        return $this;
    }
}