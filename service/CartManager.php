<?php

namespace Service;

use Model\Repository\GateauxRepository;

/**
 * Summary of ProductController
 */
class CartManager
{
    private GateauxRepository $productRepository;

    public function __construct()
    {
        $this->productRepository = new GateauxRepository;
    }

    public function addCart($id)
    {
        $quantity = $_GET["qte"] ?? 1;
        $pr = $this->productRepository;
        $product = $pr->findById('gateaux', $id);
        
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }

        $cart = $_SESSION["cart"]; // on récupère ce qu'il y a dans le cart en session
        $productDejaDanscart = false;
        if (!empty ($cart)) {
            foreach ($cart as $indice => $value) {
                if ($product->getId() == $value["product"]->getId()) {
                    $cart[$indice]["quantity"] += $quantity;
                    $productDejaDanscart = true;
                    break;  // pour sortir de la boucle foreach
                }
            }
        }

        if (!$productDejaDanscart) {
            $cart[] = ["quantity" => $quantity, "product" => $product];  // on ajoute une value au cart => $cart est un array d'array
        }

        $_SESSION["cart"] = $cart;  // je remets $cart dans la session, à l'indice 'cart'
        $nb = 0;
        foreach ($cart as $value) {
            $nb += $value["quantity"];
        }
        $_SESSION["nombre"] = $nb;
        echo json_encode(['nombre' => $nb]);
    }

    public function changeQuantity()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset ($_POST['quantityChange'])) {

            // Extraction des données POST
            extract($_POST);
            // Récupération du panier depuis la session
            $cartProducts = &Session::getCart();
            // Récupération du nombre total d'articles dans le panier depuis la session
            $totalQuantity = isset ($_SESSION["nombre"]) ? $_SESSION["nombre"] : 0;

            // Vérification de la présence de la clé 'updateQuantite' dans les données POST
            $updateQuantite = isset ($updateQuantite) ? intval($updateQuantite) : 0;
            
            $totalProduct = 0;
            foreach ($cartProducts as &$cartProduct) {
                if ($cartProduct['product']->getId() == $checkId) {
                    if ($status == "increment") {
                        $totalQuantity++;
                        $cartProduct['quantity']++;
                    } else {
                        if ($updateQuantite > 0) {
                            $totalQuantity--;
                            $cartProduct['quantity']--;
                        }
                    }
                }
                $totalProduct += $cartProduct['quantity'] * $cartProduct['product']->getPrix();
            }
            $_SESSION['cartProducts'] = $cartProducts;

            $_SESSION['cartProducts']['totalProduct'] = $totalProduct;
            // Mise à jour de la session avec la nouvelle quantité totale
            $_SESSION["nombre"] = $totalQuantity;

            // Construction de la réponse JSON
            $response = ['success' => true, 'message' => 'Mise à jour de la quantité avec succès', 'totalQuantity' => $totalQuantity, 'totalPrice' => $totalProduct];

            // Envoi de la réponse JSON
            echo json_encode($response);
        }
    }
}