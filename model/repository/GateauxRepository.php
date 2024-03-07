<?php

namespace Model\Repository;

use Model\Entity\Gateaux;
use Service\Session;

class GateauxRepository extends BaseRepository
{
    public function insertProduct(Gateaux $gateaux)
    {
        $sql = "INSERT INTO list_gateaux (nom_du_gateau,description,prix,photo) VALUES (:nom_gateau,:description,:prix,:photo)";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":nom_gateau", $gateaux->getNomGateau());
        $request->bindValue(":description", $gateaux->getDescription());
        $request->bindValue(":prix", $gateaux->getPrix());
        $request->bindValue(":photo", $gateaux->getPhoto());

        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "Le nouveau produit a bien été enregistré");
                return true;
            }
            Session::addMessage("danger", "Erreur : le produit n'a pas été enregisté");
            return false;
        }
        Session::addMessage("danger", "Erreur SQL");
        return null;
    }


    public function updateProduct(Gateaux $gateaux)
    {
        $sql = "UPDATE list_gateaux
                SET id=:id,nom_du_gateau = :nom_gateau, description = :description, prix = :prix, photo = :photo
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);

        $request->bindValue(":id", $gateaux->getId());
        $request->bindValue(":nom_gateau", $gateaux->getNomGateau());
        $request->bindValue(":description", $gateaux->getDescription());
        $request->bindValue(":prix", $gateaux->getPrix());
        $request->bindValue(":photo", $gateaux->getPhoto());

        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "La mise à jour du produit a bien été éffectuée");
                return true;
            }
            Session::addMessage("danger", "Erreur : Le produit n'a pas été mise à jour");
            return false;
        }
        Session::addMessage("danger", "Erreur SQL");
        return null;
    }
}