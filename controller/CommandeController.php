<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

use Model\Repository\DetailRepository;
use Model\Repository\GateauxRepository;
use Model\Repository\CommandesRepository;

/**
 * Summary of OrderController
 */
class CommandeController extends BaseController
{
    private GateauxRepository $GateauxRepository;
    private CommandesRepository $orderRepository;
    private DetailRepository $detailRepository;

    public function __construct()
    {
        $this->GateauxRepository = new GateauxRepository;
        $this->orderRepository = new CommandesRepository;
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

        $orderId = $this->orderRepository->insertOrder();
        $this->remove("cart");
        $this->remove("nombre");

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