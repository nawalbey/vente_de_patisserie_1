<?php
namespace Model\Entity;

class Detail extends BaseEntity
{
    private $quantity;
    private Commande $commande;
    private Gateaux $gateau;


    public function getQuantity()
    {
        return $this->quantity;
    }

    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getCommande()
    {
        return $this->commande;
    }

    public function setCommande($commande)
    {
        $this->commande = $commande;
        return $this;
    }

    public function getGateau()
    {
        return $this->gateau;
    }

    public function setGateau($gateau)
    {
        $this->gateau = $gateau;
        return $this;
    }

}