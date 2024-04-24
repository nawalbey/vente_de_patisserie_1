<?php
session_start();
require_once('../model/action_admin.php');
require_once('../inc/cart.php');

// Vérifiez si la requête est une requête POST
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['ajouterPanier'])) {
    
    extract($_POST);
    if (!array_key_exists('cart', $_SESSION)) {
        $_SESSION['cart'] = [];
    }

    createArrayCart($id_gateaux);
    
    $cartProducts = getDetails();

    
    $_SESSION["nombre"] = $cartProducts["totals"]["quantity"];

    $response = ['success' => true, 'message' => 'Mise à jour de la quantité avec succès', 'totalQuantity' => $cartProducts["totals"]["quantity"]];
    echo json_encode($response);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['quantityChange'])) {
    
    extract($_POST);
    
    if($status == "increment") {        
        $updateQuantite++;
        $newPrice = $quantityChange * $updateQuantite; 
    } else {        
        if($updateQuantite != 0){
            $updateQuantite--;
            $newPrice = $quantityChange * $updateQuantite;
        }
    }   
    
    $cartProducts = getDetails();
    
    $_SESSION["nombre"] = $cartProducts["totals"]["quantity"];
    $response = ['success' => true, 'message' => 'Mise à jour de la quantité avec succès', 'totalQuantity' => $cartProducts["totals"]["quantity"], 'totalPrice' => $cartProducts["totals"]["price"]];
    echo json_encode($response);
}


    