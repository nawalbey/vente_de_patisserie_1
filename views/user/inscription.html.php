<div>
    <!--<div> : Début d'une division HTML.-->
    <!--if (isset($errors)) { : Une structure conditionnelle en PHP vérifiant si la variable $errors est définie et non vide. Cette variable est généralement utilisée pour stocker des messages d'erreur.-->
    <?php if (isset($errors)) {
        foreach ($errors as $e) { ?><div>
                <?= $e ?>
            <?php }
    } ?>
        <!--foreach ($errors as $e) { ?> : Une boucle foreach en PHP qui parcourt le tableau $errors, chaque élément étant temporairement stocké dans la variable $e.-->
        <!--: Début d'une autre division HTML, utilisée pour chaque message d'erreur.-->
        <!--
        $e : Cette balise permet d'afficher le contenu de la variable $e, qui est un message d'erreur.--><!-- En résumé, ce code affiche chaque message d'erreur contenu dans le tableau $errors (s'il est défini et non vide) dans des balises <div>. Si la variable $errors est définie mais vide, aucun message d'erreur ne sera affiché.-->


    </div>

    <div class="container-height class1">
        <form method="post" class="form_inscription">
            <h1>Inscription</h1>
            <div>
                <div class="form-group">
                    <label>nom</label>
                    <input type="text" class="form-control" name="nom" required>
                </div>
                <div class="form-group">
                    <label>prenom</label>
                    <input type="text" class="form-control" name="prenom" required>
                </div>
                <div class="form-group">
                    <label>email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>
                <div class="form-group">
                    <label>mot_de_passe</label>
                    <input type="password" class="form-control" name="mot_de_passe" required>
                </div>

                <div class="form-group">
                    <label>adresse</label>
                    <input type="text" class="form-control" name="adresse" required>
                </div>
                <div class="form-group">
                    <label>numero_telephone</label>
                    <input type="number" class="form-control" name="numero_telephone" required>
                </div>
                <div class="form-group">
                    <label>date de naissance</label>
                    <input type="date" class="form-control" name="date_de_naissance" required>
                </div>

            </div>
            <div class="button1">
                <button type="submit" id="bouton" class="btn  mt-5 mb-5" name="inscription" value="submit">Inscription</button>
            </div>
        </form>
    </div>
</div>



