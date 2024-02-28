<?php
require_once('../inc/header.php');
require_once('../model/action_admin.php');
$gateaux = gateaux_liste();

?>   

<div class="class3">
    <?php
    foreach ($gateaux as $gateau) { ?>
        <div class="card" style="width: 18rem;">
            <img src='../asset/img/<?= $gateau['photo']; ?>' class="card-img-top" alt="verrine">
            <div class="card-body">
                <p class="prix_gateau">
                    <?= $gateau['prix']; ?>
                    €
                </p>
                <h5 class="card-title">
                    <?php echo $gateau['nom_du_gateaux']; ?>
                </h5>
                <p class="card-text">
                    <?= $gateau['description']; ?>
                </p>
                <div class='btnAchat'>
                    <form method="post" class="add-to-cart-form">
                        <input type="hidden" name="id_gateaux" value="<?= $gateau['id_gateaux']; ?>">
                        <input type="hidden" name="qte" value="1">
                        <input type="hidden" name="nom_du_gateaux" value="<?= $gateau['nom_du_gateaux']; ?>">
                        <input type="hidden" name="photo" value="<?= $gateau['photo']; ?>">
                        <input type="hidden" name="prix" value="<?= $gateau['prix']; ?>">
                        <input type="hidden" name="description" value="<?= $gateau['description']; ?>">
                        <div class="btn-cards">
                            <input type="submit" class="btn addToCartBtn" id="<?= $gateau['id_gateaux']; ?>"
                                value="Ajouter au panier">
                            <a href="../model/DetailsController.php?id_gateau=<?= $gateau['id_gateaux'] ?>" class='btn'>Voir
                                les details
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }
    ?>
    <div class="bg-gateau"></div>
</div>
<?php include_once "../inc/footer.php" ?>