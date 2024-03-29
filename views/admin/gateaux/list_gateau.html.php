<!--class list_gateaux-->
<div
    class="list_gateau">
    <!-- css-->
    <div style="width: 1500px; margin: auto; padding-top: 25px; "></div>
    <!--tableau avec une classe table1-->
    <table class="table1">
        <thead>
            <tr>
                <th>id gateaux</th>
                <th>nom du gateaux</th>
                <th>description</th>
                <th>prix</th>
                <th>photo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $gateaux) { ?>
                    <!--php foreach ($products as $gateaux) { ?> : C'est une boucle foreach en PHP. Elle parcourt chaque élément du tableau $products et à chaque itération, elle assigne la valeur de l'élément à la variable $gateaux-->
                    <tr>
                        <td>
                            <?= $gateaux->getId(); ?>
                        </td>
                        <td>
                            <?= $gateaux->getNomGateau(); ?>
                        </td>
                        <td>
                            <?= $gateaux->getDescription(); ?>
                        </td>
                        <td>
                            <?= $gateaux->getPrix(); ?>
                        </td>
                        <!-- $gateaux->getId(); ?>, <= $gateaux->getNomGateau(); ?, ?= $gateaux->getDescription(); ?, ?= $gateaux->getPrix(); ?> : Ce sont des instructions PHP qui affichent les différentes propriétés de l'objet $gateaux. Ces propriétés sont probablement récupérées à partir d'une base de données ou d'une autre source de données. Les balises ?= ? sont une syntaxe raccourcie pour ?php echo ?, elles affichent le résultat de l'expression PHP à l'intérieur.-->
                        <td>
                            <img src="<?= ROOT . UPLOAD_GATEAUX_IMG . $gateaux->getPhoto() ?>" alt="photo des produits" style="width: 400px; height: 400px;">
                        </td>

                        <!-- <img> qui affiche une image. L'attribut src spécifie l'URL de l'image. Dans ce cas, l'URL est générée à partir de la concaténation de trois variables : ROOT, UPLOAD_GATEAUX_IMG et le résultat de la méthode getPhoto() de l'objet $gateaux. L'attribut alt fournit un texte alternatif pour l'image, et les styles width et height définissent la largeur et la hauteur de l'image respectivement (dans ce cas, 400 pixels pour chaque dimension).
                         En résumé, ce code PHP et HTML génère des lignes de tableau contenant des informations sur des produits (probablement des gâteaux) stockés dans un tableau $products. Chaque ligne représente un produit et affiche son identifiant, son nom, sa description, son prix et une image.-->

                    </tr>
            <?php } ?>
        </tbody>
    </table>
</div></div>
<!--tr : C'est un élément HTML utilisé pour définir une ligne dans un tableau.
td : C'est un élément HTML utilisé pour définir une cellule dans un tableau.-->

