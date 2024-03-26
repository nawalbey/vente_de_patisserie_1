<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

use Model\Entity\Commande;
use Model\Repository\DetailRepository;
use Model\Repository\GateauxRepository;
use Model\Repository\CommandesRepository;

/**
 * Summary of OrderController
 */
class CommandeController extends BaseController
{
    private GateauxRepository $gateauxRepository;
    private CommandesRepository $commandesRepository;
    private DetailRepository $detailRepository;

    public function __construct()
    {
        $this->gateauxRepository = new GateauxRepository;
        $this->commandesRepository = new CommandesRepository;
        $this->detailRepository = new DetailRepository;
    }

    public function confirm()
    {
        if (!$this->isUserConnected()) {
            redirection(addLink("user", "login"));
        }
        if (!$_SESSION["cart"]) {

            $this->setMessage("info", "Votre panier est vide");
            $this->redirectToRoute(["cart", "show"]);
        }
        
        $cart = $_SESSION["cart"];
        $orderId = $this->commandesRepository->insertOrder();
        foreach($cart as $c){
            $gateau = $this->gateauxRepository->findById('gateaux',$c['product']->getId());
            if($gateau){
               $this->detailRepository->insertDetail($orderId,$gateau,$c['quantity']);
            }
        }

        unset($_SESSION['cart']);
        unset($_SESSION['nombre']);

        $this->setMessage("success", "Votre commande a été enregistrée");
        $this->redirectToRoute(["home"]);

    }

    public function edit($id)
    {

    }

    public function delete($id)
    {

    }

    public function show($id)
    {

    }
}