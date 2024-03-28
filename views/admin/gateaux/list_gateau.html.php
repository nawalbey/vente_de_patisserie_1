<div class="list_gateau">
    <div style="width: 1500px; margin: auto;">
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
                            <td>
                                <img src="<?= ROOT . UPLOAD_GATEAUX_IMG . $gateaux->getPhoto() ?>" alt="photo des produits" style="width: 400px; height: 400px;">
                            </td>
                        </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>

