<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;
// namespace et Use Statements:

// Le code commence par déclarer un namespace Controller, ce qui signifie que toutes les classes et interfaces définies dans ce fichier appartiennent à ce namespace.
// Ensuite, il y a quelques instructions use qui importent les classes DetailRepository, GateauxRepository, et CommandesRepository depuis le namespace Model\Repository. Cela permet d'utiliser ces classes dans ce fichier sans avoir à spécifier le chemin complet à chaque fois.

use Model\Repository\DetailRepository;
use Model\Repository\GateauxRepository;
use Model\Repository\CommandesRepository;

/**
 * Summary of OrderController
 */

// Classe CommandeController:
// La classe CommandeController étend la classe BaseController, ce qui suggère qu'elle hérite de certaines fonctionnalités ou méthodes de cette classe parente.
// Elle a trois propriétés privées :
// $gateauxRepository de type GateauxRepository.
// $commandesRepository de type CommandesRepository.
// $detailRepository de type DetailRepository.
// Le constructeur de la classe initialise ces trois propriétés en créant de nouvelles instances des classes correspondantes.
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

    // Méthode confirm():

// Cette méthode vérifie d'abord si un utilisateur est connecté. Si ce n'est pas le cas, elle redirige l'utilisateur vers la page de connexion.
// Ensuite, elle vérifie si le panier de l'utilisateur ($_SESSION["cart"]) est vide. Si c'est le cas, elle affiche un message d'information et redirige l'utilisateur vers la page du panier.
// Ensuite, elle récupère les articles du panier ($cart) et insère une nouvelle commande dans la base de données via $this->commandesRepository->insertOrder().
// Elle boucle ensuite sur chaque élément du panier, récupère les détails de chaque produit depuis la base de données via $this->gateauxRepository->findById('gateaux', $c['product']->getId()), puis insère ces détails dans la table de détails de la commande via $this->detailRepository->insertDetail($orderId, $gateau, $c['quantity']).
// Enfin, elle supprime le panier de la session et affiche un message de succès avant de rediriger l'utilisateur vers la page d'accueil.
    public function confirm()
    {
        // ! indique le contraire, sans le '!' on lit : si l'utilisateur est connecté
        // avec le ! on lit : si l'utilisateur n'est PAS connecté 
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

// Autres méthodes:
// Les méthodes edit, delete, et show semblent être des méthodes prévues pour gérer les opérations d'édition, de suppression et d'affichage des commandes, mais elles sont actuellement vides.
// En résumé, ce code représente un contrôleur PHP qui gère la confirmation des commandes des utilisateurs, enregistre les commandes dans la base de données et gère les opérations relatives à la gestion des commandes, comme l'édition, la suppression et l'affichage.
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