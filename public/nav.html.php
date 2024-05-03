<nav class="navbar2">
    <div>
        <a href="<?= addLink('home', 'list') ?>" class="btn color1">Gateaux</a>
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
                        <!-- debut de la classe admin_menue avec deux bouton ajout pour les gateaux et list pour voir la list des gateaux-->
                            <div class='admin_menu'>
                                <a class="btn color1 ms-2 hoverAdmin" href="">Admin</a>
                                <div id="ajout_list_admin_gateau">
                                    <span>
                                        <a href="<?= addLink('admin/gateaux', 'new') ?>">Ajout</a>
                                    </span>
                                    <span>
                                        <a href="<?= addLink('admin/gateaux', 'list') ?>">Liste</a>
                                    </span>
                                </div>
                                <!--fin-->
                            </div>
                    <?php } ?>
                </div>
        <?php } else { ?>
                <a href="<?= addLink('user', 'new') ?>" class="btn me-2 color1 ">inscription</a>
                <a href="<?= addLink('user', 'login'); ?>" class="btn color1">login</a>
        <?php } ?>
        <!-- classe bouton panier a linterieur il y a un liens. Ce lien est généré dynamiquement à l'aide de de addLink quand l'utilisateur clique sur le bouton il sera redirigé vers cette page-->
        <button class="btn color1 ms-2" type="button">
            <a href="<?= addLink('panier', 'show') ?>">
                <i class="fa-solid fa-cart-arrow-down"></i>
            </a>
            <!-- <span id='nbArticles'> $_SESSION['nombre'] ?? ''; ?></span>: À l'intérieur du bouton, il y a un <span> avec un attribut id de "nbArticles". Ce <span> est utilisé pour afficher le nombre d'articles dans le panier. Ce nombre est récupéré à partir de la variable de session $_SESSION['nombre']. L'opérateur de fusion null (??) est utilisé ici pour fournir une valeur par défaut vide ('') si $_SESSION['nombre'] n'est pas défini ou est null.-->
            <span id='nbArticles'><?= $_SESSION['nombre'] ?? ''; ?>
            </span>
        </button>
        <!-- En résumé, ce code crée un bouton avec une icône de panier et affiche le nombre d'articles dans le panier à côté de l'icône. Lorsque l'utilisateur clique sur le bouton, il est redirigé vers la page de visualisation du panier.-->


    </div>
</nav>
<!-- fin de la nav_bar -->

