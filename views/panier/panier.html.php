<?php //d_die($gateaux);
?>

<div class="class4">
    <h1>Panier</h1>
    <div class="container-height">
        <div class="panier">
            <?php
            if (!empty ($_SESSION['cart'])) {
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
                                                <?php if (is_array($gateau) && isset ($gateau["quantity"])) { ?>
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
    <?php if (!empty ($gateaux)) { ?>
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
                <!-- Bouton Commander -->
                <a href="<?= addLink('commande', 'confirm') ?>" class="btn" name="commande">Commander</a>
            </div>
    <?php } ?>
    

