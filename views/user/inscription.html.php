<div>
    <?php if (isset($errors)) {
        foreach ($errors as $e) { ?>
                <div>
                    <?= $e ?>
            <?php }
    } ?>
    </div>

    <div class="container-height class1">
        <form method="post" class="form_inscription">
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
</div>

<!--Condition <if (isset($errors)) { :

Cette ligne vérifie si la variable $errors est définie. La fonction isset() est utilisée pour vérifier si une variable est définie et non nulle.
Boucle foreach :

Si la condition isset($errors) est vraie (c'est-à-dire que la variable $errors est définie), alors une boucle foreach est initiée.
Cette boucle parcourt chaque élément du tableau $errors. À chaque itération, la valeur de l'élément en cours est stockée dans la variable $e.
Affichage du message d'erreur :

À l'intérieur de la boucle foreach, chaque message d'erreur est affiché dans une <div>. La balise $e est utilisée pour afficher la valeur de la variable $e, qui contient le message d'erreur.
Fermeture de la <div> :

Après l'affichage du message d'erreur, la balise de fermeture </div> est utilisée pour fermer la <div> qui contient le message d'erreur.
Fermeture de la boucle foreach :

Enfin, la boucle foreach est fermée avec la balise ce qui marque la fin de la boucle.
En résumé, ce code vérifie d'abord si la variable $errors est définie. Si c'est le cas, il parcourt chaque élément de ce tableau et affiche son contenu dans une <div>. Cela permet d'afficher tous les messages d'erreur présents dans le tableau $errors, le cas échéant. Si la variable $errors n'est pas définie, cette section de code ne générera aucun affichage.--<

