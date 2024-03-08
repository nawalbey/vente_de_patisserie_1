<?php
namespace Model\Entity;

class Gateaux extends BaseEntity
{
   private $nom_du_gateaux;
   private $description;
   private $prix;
   private $photo;

   public function getNomGateau()
   {
      return $this->nom_du_gateaux;
   }

   public function setNomGateau($nom_du_gateaux)
   {
      $this->nom_du_gateaux = $nom_du_gateaux;
      return $this;
   }

   public function getDescription()
   {
      return $this->description;
   }

   public function setDescription($description)
   {
      $this->description = $description;
      return $this;
   }

   public function getPrix()
   {
      return $this->prix;
   }

   public function setPrix($prix)
   {
      $this->prix = $prix;
      return $this;
   }

   public function getPhoto()
   {
      return $this->photo;
   }

   public function setPhoto($photo)
   {
      $this->photo = $photo;
      return $this;
   }
}