<?php
include_once('../inc/header.php');
?>

<div class="class5">
    <h1>Detail de : <?= $_SESSION['detail_gateau']['nom_du_gateaux'] ?></h1>
    <section class='card_detail'>

        <div class="card card-height" style="width: 18rem;">
            <img src='../asset/img/<?= $_SESSION['detail_gateau']['photo']; ?>' class="card-img-top" alt="verrine">
            <div class="card-body">
                <p class="prix_gateau">
                    <?= $_SESSION['detail_gateau']['prix']; ?>
                    €
                </p>
                <h5 class="card-title">
                    <?= $_SESSION['detail_gateau']['nom_du_gateaux']; ?>
                </h5>
                <p class="card-text">
                    <?= $_SESSION['detail_gateau']['description']; ?>
                </p>
            </div>
        </div>
    </section>

</div>

