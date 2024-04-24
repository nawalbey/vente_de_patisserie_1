<?php
//On démarre une nouvelle session
session_start();
include_once "../inc/header.php";
require_once "../model/function.php";

?>
<div class="container">
    <?php
    if (isset($_SESSION['message'])) {
        echo $_SESSION['message'];
        unset($_SESSION['message']);
    }
    ?>
    <table class="table">
        <thead>
            <tr>
                <th>id Gateaux</th>
                <th>nom du Gateaux</th>
                <th>description</th>
                <th>prix</th>
                <th>photo</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($listGateaux as $Gateaux) { ?>
                    <tr>

                        <td>
                            <?= $Gateaux['id_Gateaux']; ?>


                        </td>
                        <td>
                            <?= $Gateaux['nom_du_Gateaux']; ?>
                        </td>
                        <td>
                            <?= $Gateaux['description']; ?>
                        </td>
                        <td>
                            <?= $Gateaux['prix']; ?>
                        </td>

                    </tr>
            <?php } ?>
        </tbody>
    </table>


</div>
<?php include_once "../inc/footer.php"; ?>

