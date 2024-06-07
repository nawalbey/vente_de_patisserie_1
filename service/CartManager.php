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
    //addcart qui me permet d'ajouter le produits dans la session.
    public function addCart($id)
    {
        //$_get avec la cle qte existe alors $quantity prendre ca valeur sinon il sera egal a 1.
        $quantity = $_GET["qte"] ?? 1;
        $pr = $this->productRepository;
        $product = $pr->findById('gateaux', $id);

        //Vérification du Panier : Si le panier n'existe pas dans la session, il est initialisé comme un tableau vide.
        // Récupération du Panier : Le panier actuel est récupéré depuis la session et stocké dans la variable $cart.
        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = [];
        }

        $cart = $_SESSION["cart"]; // on récupère ce qu'il y a dans le cart en session
        $productDejaDanscart = false;
        //si $cart n'est pas vide alors il va boucler tout les elements a l'interieure.
        if (!empty($cart)) {
            foreach ($cart as $indice => $value) {
                //si l'id du produit recupere de la base de donnees et egal a l'id du produit dans la session alors il incremente la quantite.
                // et change la variable en true
                if ($product->getId() == $value["product"]->getId()) {
                    $cart[$indice]["quantity"] += $quantity;
                    $productDejaDanscart = true;
                    break;  // pour sortir de la boucle foreach
                }
            }
        }
        //Ajout du produit au panier si non présent :
        // Après la boucle, on vérifie si la variable $productDejaDanscart est toujours false.
        // Si c'est le cas, cela signifie que le produit n'était pas déjà dans le panier.
        // On ajoute donc un nouveau tableau associatif au panier avec les clés quantity et product pour représenter le produit et sa quantité.
        if (!$productDejaDanscart) {
            $cart[] = ["quantity" => $quantity, "product" => $product];  // on ajoute une value au cart => $cart est un array d'array
        }

        $_SESSION["cart"] = $cart;  // je remets $cart dans la session, à l'indice 'cart'
        $nb = 0;
        //il compte les elements dans mon panier.

        //Parcours du panier : Cette ligne initialise une boucle foreach qui itère à travers chaque élément du panier ($cart).
        //Assignation de l'élément courant : Pour chaque itération, l'élément courant du panier est assigné à la variable $value. Chaque élément de $cart est un tableau associatif contenant au moins les clés quantity et product.
        foreach ($cart as $value) {

            //Accès à la quantité : $value["quantity"] accède à la quantité du produit courant dans le panier.
            //Accumulation : L'opérateur += ajoute cette quantité à la variable $nb. Cela permet de cumuler le nombre total de produits dans le panier.
            $nb += $value["quantity"];
        }
        $_SESSION["nombre"] = $nb;
        //la reponse du serveur vers le fichier structure.js (la ou j'ai lance la methode ajax).
        //echo json_encode il convertie en table js (['nombre' => $nb]); c'est un tableau associatif.
        echo json_encode(['nombre' => $nb]);
    }

    public function changeQuantity()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantityChange'])) {

            // Extraction des données POST
            extract($_POST);
            // Récupération du panier depuis la session
            $cartProducts = &Session::getCart();
            // Récupération du nombre total d'articles dans le panier depuis la session
            $totalQuantity = isset($_SESSION["nombre"]) ? $_SESSION["nombre"] : 0;

            // Vérification de la présence de la clé 'updateQuantite' dans les données POST
            $updateQuantite = isset($updateQuantite) ? intval($updateQuantite) : 0;

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
