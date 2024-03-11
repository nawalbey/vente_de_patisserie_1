<div class="class4">
    <h1>Panier</h1>
    <div class="container-height">
        <div class="panier">
            <?php
            if (!empty($_SESSION['cart'])) {
                foreach ($gateaux["product"] as $gateau) { ?>
                        <div class="card" style="width: 18rem;">
                            <img src='../asset/img/<?= $gateau["product"]['photo']; ?>' class="card-img-top" alt="verrine">
                            <div class="card-body">
                                <p class="prix_gateau">
                                    <?php echo $gateau["product"]['prix']; ?>
                                    €
                                </p>
                                <h5 class="card-title">
                                    <?php echo $gateau["product"]['nom_du_gateaux']; ?>
                                </h5>
                                <p class="card-text">
                                    <?php echo $gateau["product"]['description']; ?>
                                </p><br>
                                <div class="def-number-input number-input safari_only d-flex formCart">
                                    <button class="minus update-produit" onclick="decrement_quantity(<?= $gateau['product']['id_gateaux'] ?>, '<?= $gateau['product']['prix']; ?>')">-</button>
                                    <div class="input-quantity" id="input-quantity-<?= $gateau["product"]['id_gateaux'] ?>">
                                        <p class="card-text1">
                                            <?php if (is_array($gateau) && isset($gateau["quantity"])) { ?>
                                                    <i class="fa-solid fa-cookie-bite">
                                                        <?= $gateau["quantity"] ?>
                                                    </i>
                                            <?php } ?>
                                        </p>
                                    </div>
                                    <button class="plus update-produit" onclick="increment_quantity(<?= $gateau['product']['id_gateaux']; ?>, <?= $gateau['product']['prix']; ?>)">
                                        +</button>
                                </div>
                                <div class="cart-info price" id="cart-price-<?= $gateau["product"]['id_gateaux']; ?>">
                                    <?= ($gateau["product"]['prix'] * $gateau["quantity"]) . " €"; ?>
                                </div>
                                <div
                                    class="button3">
                                    <!-- Bouton Supprimer -->
                                    <a href="../model/supprimer_gateau.php?id=<?= $gateau["product"]['id_gateaux'] ?>" class="btn">Supprimer</a>

                                </div>
                            </div>
                        </div>
                <?php } ?>


        <?php } else { ?>
                <p id="panier_vide"><?= $messageVide ?></p>
        <?php } ?>


    </div>
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
                        <?= $gateaux['quantity']; ?>
                    </span>
                </div>
                <div>Total Prix:
                    <span id="total-price">
                        <?= $gateaux['totals']['price']; ?>
                    </span>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($_SESSION['cart'])) { ?>
            <div
                id='commander'>
                <!-- Bouton Commander -->
                <a href="../model/commander.php?commande=true" class="btn" name="commande">Commander</a>
            </div>
    <?php } ?>


