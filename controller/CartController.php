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
class CartController extends BaseController
{

    private $form;

    public function __construct(){
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


    /**
     * Summary of show
     * @return void
     */
    public function show()
    {
        $messageVide = "";
        $cart = Session::getCart();
        if(!$cart){
            $messageVide = 'Votre panier est vide';
        }else {
            $cart['totals_quantite'] = 0;
            foreach($cart as &$c){
                if (is_array($c) && array_key_exists('quantity', $c)) {
                    $cart['totals_quantite'] += $c['quantity'];
                }
            }
            unset($c);
        }

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

    }

}