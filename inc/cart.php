<?php

    require_once('../model/action_admin.php');
    /**
     * Crée un tableau associatif id => quantité et le stocke en session
     */
    function createArrayCart(int $id)
    {        
        $cart = $_SESSION['cart'];

        if (empty($cart[$id])) {
            $cart[$id] = 1;
        } else {
            $cart[$id]++;
        }
        $_SESSION['cart'] = $cart;

    }

    function getSessionCart(): array
    {
        return isset($_SESSION['cart']) ? $_SESSION['cart'] : [];
    }

    function removeSessionCart(): void
    {
        unset($_SESSION['cart']);
    }

    function removeItem(int $id): void
    {
        $cart = getSessionCart();
        $_SESSION['nombre'] -= $cart[$id];
        unset($cart[$id]);
        $_SESSION['cart'] = $cart;
    }

    function decreaseItem(int $id): void
    {
        $cart = getSessionCart();
        if ($cart[$id] < 2) {
            unset($cart[$id]);
        } else {
            $cart[$id]--;
        }
        $_SESSION['cart'] = $cart;
    }


    /**
     * Récupère le panier en session, puis récupère les produits de la bdd
     * et calcule les totaux
     */
    function getDetails()
    {
        $cartProducts = [
            'products' => [],
            'totals' => [
                'quantity' => 0,
                'price' => 0,
            ],
        ];

        $cart = getSessionCart();
        if ($cart) {
            foreach ($cart as $id => $quantity) {
                $currentProduct = findGateauById($id);
                if ($currentProduct) {
                    $cartProducts['products'][] = [
                        'product' => $currentProduct,
                        'quantity' => $quantity
                    ];
                    $cartProducts['totals']['quantity'] += $quantity;
                    $cartProducts['totals']['price'] += $quantity * $currentProduct["prix"];
                }
            }
        }
        return $cartProducts;
    }