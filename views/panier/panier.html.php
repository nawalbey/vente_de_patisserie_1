<?php

?>

<div class="class4">
    <h1>Panier</h1>
    <div class="container-height">
        <div class="panier">
            <?php
            // Affichage des produits dans le panier :
            
            // Le code vérifie d'abord si la session contenant le panier ($_SESSION['cart']) n'est pas vide.
// Ensuite, il itère sur chaque produit du panier à l'aide d'une boucle foreach.
// À l'intérieur de cette boucle, chaque produit est affiché sous forme de carte Bootstrap.
// L'image, le nom, la description, le prix et la quantité du produit sont affichés.
// Des boutons "plus" et "moins" sont inclus pour permettre à l'utilisateur d'ajuster la quantité du produit dans le panier.
// Un bouton "Supprimer" est également inclus pour permettre à l'utilisateur de retirer le produit du panier.
            if (!empty($_SESSION['cart'])) {
                foreach ($gateaux as $gateau) {
                    if (is_object($gateau) || is_array($gateau)) { ?>
                            <div class="card" style="width: 18rem;">
                                <img src='<?= ROOT . UPLOAD_GATEAUX_IMG . $gateau['product']->getPhoto(); ?>' class="card-img-top" alt="verrine">
                                <div class="card-body">
                                    <p class="prix_gateau">
                                        <?= $gateau['product']->getPrix(); ?>
                                        €
                                    </p>
                                    <h5 class="card-title">
                                        <?= $gateau['product']->getNomGateau(); ?>
                                    </h5>
                                    <p class="card-text">
                                        <?php echo $gateau['product']->getDescription(); ?>
                                    </p><br>
                                    <div class="def-number-input number-input safari_only d-flex formCart">
                                        <button class="minus update-produit" onclick="decrement_quantity(<?= $gateau['product']->getId() ?>, '<?= $gateau['product']->getPrix(); ?>')">-</button>
                                        <div class="input-quantity" id="input-quantity-<?= $gateau['product']->getId() ?>">
                                            <p class="card-text1">
                                                <?php if (is_array($gateau) && isset($gateau["quantity"])) { ?>
                                                        <i class="fa-solid fa-cookie-bite">
                                                            <?= $gateau["quantity"] ?>
                                                        </i>
                                                <?php } ?>
                                            </p>
                                        </div>
                                        <button class="plus update-produit" onclick="increment_quantity(<?= $gateau['product']->getId(); ?>, <?= $gateau['product']->getPrix(); ?>)">
                                            +</button>
                                    </div>
                                    <div class="cart-info price" id="cart-price-<?= $gateau['product']->getId(); ?>">
                                        <?= ($gateau['product']->getPrix() * $gateau['quantity']) . " €"; ?>
                                    </div>

                                    <!--Calcul et affichage du total du panier :Si le panier n'est pas vide, le total de la quantité et le total du prix sont affichés en bas de la liste des produits.Ces totaux sont extraits des données stockées dans $gateaux['totals_quantite'] et $gateaux['total_prix'].-->

                                    <div
                                        class="button3">
                                        <!-- Bouton Supprimer -->
                                        <a href="<?= addLink('panier', 'delete', $gateau['product']->getId()) ?>" class="btn">Supprimer</a>
                                    </div>

                                </div>
                            </div>
                    <?php } ?>


            <?php }
            } else { ?>
                <p id="panier_vide"><?= $messageVide ?></p>
        <?php } ?>


    </div>
    <?php if (!empty($gateaux)) { ?>
            <div class="txt-heading">
                <h3 class="txt-heading-label">Payement</h3>
                <div>
                    <i class="fa-regular fa-credit-card"></i>
                </div>

                <div class="payement">
                    <a id="btnEmpty" href="index.php?action=empty"></a>
                    <div class="cart-status">
                        <div>Total Quantite:
                            <span id="total-quantity">
                                <?= $gateaux['totals_quantite']; ?>
                            </span>
                        </div>
                        <div>Total Prix:
                            <span id="total-price">
                                <?= $gateaux['total_prix']; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
            <div
                id='commander'>
                <!--Bouton "Commander" :
                                                                                                                                                Un bouton "Commander" est affiché en bas du panier. Ce bouton redirige probablement l'utilisateur vers une page où il peut finaliser sa commande.-->
                <a href="<?= addLink('commande', 'confirm') ?>" class="btn" name="commande">
                    Commander</a>
            </div>
    <?php } ?>
</div>
<!--Gestion du panier vide :

Si le panier est vide, un message indiquant que le panier est vide est affiché à la place de la liste des produits.
En résumé, ce code génère l'interface utilisateur pour afficher les produits dans le panier d'achat, permet à l'utilisateur de modifier la quantité des produits, affiche le total du panier et fournit un moyen pour l'utilisateur de finaliser sa commande.-->

