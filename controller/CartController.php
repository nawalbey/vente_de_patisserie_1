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
    public function addToCart($id)
    {
        $cm = new CartManager();
        $nb = $cm->addCart($id);
        echo json_encode($nb);
    }


    /**
     * Summary of show
     * @return void
     */
    public function show()
    {
        $cart = Session::getCart();
        $this->render("panier/panier.html.php", [
            "h1" => "Fiche cart",
            "gateaux" => $cart,
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