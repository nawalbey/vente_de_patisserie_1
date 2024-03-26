<?php

namespace Model\Repository;

use Service\Session;
use Model\Entity\Detail;
use Model\Entity\Gateaux;
use Model\Entity\Commande;

class DetailRepository extends BaseRepository
{
    public function insertDetail(Commande $commande, Gateaux $gateau, $quantite):void
    {
        $detail = new Detail;
        $detail->setCommande($commande)
            ->setGateau($gateau)
            ->setQuantity($quantite);

        try {
            $this->dbConnection->beginTransaction();

            $sql = "INSERT INTO `detail` (id_commande,id_gateau,quantite) VALUES (:commande, :gateau,:quantite)";

            $request = $this->dbConnection->prepare($sql);

            $request->bindValue(":commande", $detail->getCommande()->getId());
            $request->bindValue(":gateau", $detail->getGateau()->getId());
            $request->bindValue(":quantite", $detail->getQuantity());

            $request = $request->execute();

            // Validez la transaction si tout s'est bien passé
            $this->dbConnection->commit();
        } catch (\PDOException $e) {
            // En cas d'erreur, annulez la transaction
            $this->dbConnection->rollBack();
            echo "Erreur : " . $e->getMessage();
        }
    }


    public function updateOrder(Commande $order)
    {
        $sql = "UPDATE order 
                SET state = :state, user_id = :userId
                WHERE id = :id";
        $request = $this->dbConnection->prepare($sql);
        $request->bindValue(":id", $order->getId());
        $request->bindValue(":state", $order->getState());
        $request->bindValue(":userId", $order->getUserId());
        $request = $request->execute();
        if ($request) {
            if ($request == 1) {
                Session::addMessage("success", "La mise à jour de la commande a bien été éffectuée");
                return true;
            }
            Session::addMessage("danger", "Erreur : la commande n'a pas été mise à jour");
            return false;
        }
        Session::addMessage("danger", "Erreur SQL");
        return null;
    }

}