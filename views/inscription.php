<?php include_once "../inc/header.php" ?>

<div class="class1">
    <div class="container container-height">
        <form action="../model/db_inscription.php" method="post">
            <h1>Inscription</h1>
            <div>
                <div class="form-group">
                    <label>nom</label>
                    <input type="text" class="form-control" name="nom">
                </div>
                <div class="form-group">
                    <label>prenom</label>
                    <input type="text" class="form-control" name="prenom">
                </div>
                <div class="form-group">
                    <label>email</label>
                    <input type="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <label>mot_de_passe</label>
                    <input type="password" class="form-control" name="mot_de_passe">
                </div>

                <div class="form-group">
                    <label>adresse</label>
                    <input type="text" class="form-control" name="adresse">
                </div>
                <div class="form-group">
                    <label>numero_telephone</label>
                    <input type="number" class="form-control" name="numero_telephone">
                </div>
                <div class="form-group">
                    <label>date de naissance</label>
                    <input type="date" class="form-control" name="date_de_naissance">
                </div>

            </div>
            <div class="button1">
                <button type="submit" id="bouton" class="btn  mt-5 mb-5" name="inscription" value="submit">Inscription</button>
            </div>
        </form>
    </div>
    <?php include_once "../inc/footer2.php" ?>
</div>

