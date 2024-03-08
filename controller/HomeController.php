<?php

namespace Controller;

use Controller\BaseController;
use Model\Entity\Gateaux;
use Form\GateauxHandleRequest;
use Model\Repository\GateauxRepository;

class HomeController extends BaseController
{
    private GateauxRepository $gateauxRepository;
    private Gateaux $gateau;

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
}