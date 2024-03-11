<div class="body1">
    <h1><?= $h1 ?></h1>
    <div class="class3">
        <?php
        foreach ($gateaux as $gateau) { ?>
                <div class="card" style="width: 18rem;">
                    <img src='<?= ROOT . UPLOAD_GATEAUX_IMG . $gateau->getPhoto(); ?>' class="card-img-top" alt="verrine">
                    <div class="card-body">
                        <p class="prix_gateau">
                            <?= $gateau->getPrix(); ?>
                            €
                        </p>
                        <h5 class="card-title">
                            <?= $gateau->getNomGateau(); ?>
                        </h5>
                        <p class="card-text">
                            <?= $gateau->getDescription(); ?>
                        </p>
                        <div class='btnAchat'>
                            <form method="post" class="add-to-cart-form">
                                <input type="hidden" name="id_gateaux" value="<?= $gateau->getId(); ?>">
                                <input type="hidden" name="qte" value="1">
                                <input type="hidden" name="nom_du_gateaux" value="<?= $gateau->getNomGateau(); ?>">
                                <input type="hidden" name="photo" value="<?= $gateau->getPhoto(); ?>">
                                <input type="hidden" name="prix" value="<?= $gateau->getPrix(); ?>">
                                <input type="hidden" name="description" value="<?= $gateau->getDescription(); ?>">
                                <div class="btn-cards">
                                    <input type="submit" class="btn addToCartBtn" id="<?= $gateau->getId(); ?>" value="Ajouter au panier">
                                    <a href="../model/DetailsController.php?id_gateau=<?= $gateau->getId(); ?>" class='btn'>Voir les details
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
        <?php }
        ?>
    </div>
</div>
<div class="bg-gateau"></div>

