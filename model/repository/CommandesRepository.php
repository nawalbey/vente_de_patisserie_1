<?php

namespace Model\Repository;

use Model\Entity\Commande;
use Service\Session;

class CommandesRepository extends BaseRepository
{
    public function insertOrder()
    {
        $order = new Commande;
        $order->setUserId($_SESSION["user"]->getId());

        try {
            $this->dbConnection->beginTransaction();
            $sql = "INSERT INTO `commande` (numero_commande,date_de_commande,id_user) VALUES (RAND() * (5000 - 200) + 200,NOW(),:userId)";

            $request = $this->dbConnection->prepare($sql);
            $request->bindValue(":userId", $order->getUserId());

            $request = $request->execute();
            $idOrder = $this->dbConnection->lastInsertId();

            // Validez la transaction si tout s'est bien passé
            $this->dbConnection->commit();
            return $this->findById('commande', $idOrder);
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
