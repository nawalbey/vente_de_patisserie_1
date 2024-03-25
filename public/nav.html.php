<nav class="navbar2">
    <div>
        <a href="<?= addLink('home','list') ?>" class="btn color1">Gateaux</a>
        <div class="imgchocolat">
            <img src="<?= ROOT . UPLOAD_GATEAUX_IMG . "31727589-piece-de-chocolat-gateau-avec-fondu-chocolat-et-epars-chocolat-puces-generatif-ai-photo.jpg" ?>" alt="piece de chocolat">
        </div>
    </div>
    <div>
        <h2>vente de patisserie</h2>
    </div>
    <div class="navbar1">
        <?php if ($userConnecte = Service\Session::getUserConnected()) { ?>
                <div class="bienvenue1">
                    <h3>Bienvenue
                        <?= $userConnecte->getPrenom(); ?></h3>
                    <a href="<?= addLink('user', 'logout') ?>" class="btn color1">Se déconnecter</a>
                    <?php if ($userConnecte->getRole() == 'admin') { ?>
                            <a class="btn color1 ms-2" href="../admin/admin.php">Admin</a>
                    <?php } ?>
                </div>
        <?php } else { ?>
                <a href="<?= addLink('user','new') ?>" class="btn me-2 color1 ">inscription</a>
                <a href="<?= addLink('user','login'); ?>" class="btn color1">login</a>
        <?php } ?>
        <button class="btn color1 ms-2" type="button">
            <a href="<?= addLink('panier','show') ?>">
                <i class="fa-solid fa-cart-arrow-down"></i>
            </a>
            <span id='nbArticles'><?= $_SESSION['nombre'] ?? ''; ?>
            </span>
        </button>


    </div>
</nav>
<!-- fin de la nav_bar -->

