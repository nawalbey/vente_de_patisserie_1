<div class="class5">
    <h1>Detail de :
        <?= $gateau->getNomGateau() ?></h1>
    <section class='card_detail'>

        <div class="card card-height" style="width: 18rem;">
            <img src='<?= ROOT . UPLOAD_GATEAUX_IMG .$gateau->getPhoto(); ?>' class="card-img-top" alt="verrine">
            <div class="card-body">
                <p class="prix_gateau">
                    <?= $gateau->getPrix() ?>
                    €
                </p>
                <h5 class="card-title">
                    <?= $gateau->getNomGateau(); ?>
                </h5>
                <p class="card-text">
                    <?= $gateau->getDescription(); ?>
                </p>
            </div>
        </div>
    </section>

</div>

