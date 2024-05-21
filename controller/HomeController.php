<?php

namespace Controller;

use Controller\BaseController;
use Model\Entity\Gateaux;
use Model\Repository\GateauxRepository;
// class homecontroller (fille) extends basecontroller (mere).
class HomeController extends BaseController
{
    // Private attribut Gateauxrepository et gateaux (attribut)
    private GateauxRepository $gateauxRepository;
    private Gateaux $gateau;
// public function 3 methode (contruct, list, detaillist)
    public function __construct()
    {
        $this->gateauxRepository = new GateauxRepository;
        $this->gateau = new Gateaux;
    }
    public function list()
    {
        $gateaux = $this->gateauxRepository->findAll($this->gateau);
        $this->render("home.html.php", [
            "h1" => "Liste des gateaux",
            "gateaux" => $gateaux
        ]);
    }
    // detaillist une methode avec un parametre qui est dollar id 
    public function detailList($id)
    {
        $gateaux = $this->gateauxRepository->findById('gateaux',$id);
        $this->render('details/details.html.php', [
            'h1' => 'details du gateau',
            'gateau' => $gateaux,
        ]);
    }
}