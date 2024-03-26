<?php
/**
 * Summary of namespace Controller
 */
namespace Controller;

use Service\Session;
use Service\CartManager;
use Form\PanierHandleRequest;

/**
 * Summary of ProductController
 */
class PanierController extends BaseController
{

    private $form;

    public function __construct()
    {
        $this->form = new PanierHandleRequest;
    }
    /**
     * Summary of add
     * @param mixed $id
     * @return void
     */
    public function addToCart()
    {
        $this->form->handleInsertForm();
    }


    public function show()
    {
        $messageVide = "";
        $cart = Session::getCart();
        // d_die($cart);
        if (!$cart) {
            $messageVide = 'Votre panier est vide';
        } else {
            $cart['totals_quantite'] = 0;
            $cart['total_prix'] = 0;
            foreach ($cart as &$c) {
                if (is_array($c) && array_key_exists('quantity', $c)) {
                    $cart['totals_quantite'] += $c['quantity'];
                    $cart['total_prix'] += $c['quantity'] * $c['product']->getPrix();
                }
            }
            unset($c);
        }
        // d_die($cart);
        $this->render("panier/panier.html.php", [
            "h1" => "Fiche cart",
            "gateaux" => $cart,
            'messageVide' => $messageVide,
        ]);

    }
    /**
     * Summary of edit
     * @param mixed $id
     * @return void
     */
    public function edit($id)
    {

    }

    public function delete($id)
    {
        $cart = &Session::getCart();
        // d_die($cart);   
        foreach ($cart as $key => $c) {
            $produitId = $c['product']->getId(); 
            if ($produitId == $id) {
                unset($cart[$key]);
                $cart = array_values($cart);
                $_SESSION['nombre'] -= $c['quantity'] ;
                break;
            }
        }
        if(empty($cart)){
            unset($_SESSION['nombre']);
        }
        $this->redirectToRoute(['panier','show']);
    }

    public function quantity(): void
    {
        $quantity = new CartManager;
        $quantity->changeQuantity();
    }

}