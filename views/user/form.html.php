<?php
// Initialisation de la variable $mode :

// La ligne $mode = $mode ?? "insertion"; initialise la variable $mode à la valeur de $mode s'il est défini, sinon elle lui attribue la valeur par défaut "insertion".
// Cela signifie que si la variable $mode est déjà définie, elle conserve sa valeur actuelle. Sinon, elle prend la valeur "insertion".
$mode = $mode ?? "insertion";
// Inclusion du fichier de vue errors_form.html.php :
// La ligne require "views/errors_form.html.php"; inclut le fichier de vue errors_form.html.php.
// Ce fichier est probablement destiné à afficher des messages d'erreur ou des informations de formulaire, comme son nom l'indique.
require "views/errors_form.html.php";
// Utilisation du $mode dans le fichier de vue inclus :
// Après l'inclusion du fichier errors_form.html.php, le script peut utiliser la variable $mode à l'intérieur de ce fichier pour déterminer le mode d'affichage ou de traitement des erreurs, s'il y a lieu.
?>
<!--En résumé, ce code initialise la variable $mode à "insertion" par défaut, puis inclut un fichier de vue qui probablement affiche des messages d'erreur ou des informations de formulaire. Le fichier de vue inclus peut utiliser la variable $mode selon les besoins de son fonctionnement. -->


<form method="post">
    <div class="form-group mt-3">
        <label for="firstname">Prénom</label>
        <input type="text" name="firstname" id="firstname" class="form-control" value="<?= $user->getFirstname() ?>" <?= $mode == "suppression" ? "disabled" : "" ?> required>
    </div>

    <div class="form-group mt-3">
        <label for="lastname">Nom</label>
        <input type="text" name="lastname" id="lastname" class="form-control" value="<?= $user->getLastname() ?>" <?= $mode == "suppression" ? "disabled" : "" ?> required>
    </div>

    <div class="form-group mt-3">
        <label for="password">Mot de passe
            <sup>*</sup>
        </label>
        <input type="text" name="password" id="password" class="form-control" <?= $mode == "suppression" ? "disabled" : "" ?> required>
    </div>

    <div class="form-group mt-3">
        <label for="email">Email
            <sup>*</sup>
        </label>
        <input type="email" name="email" id="email" class="form-control" value="<?= $user->getEmail() ?>" <?= $mode == "suppression" ? "disabled" : "" ?> required>
    </div>

    <div class="form-group mt-3">
        <label for="birthday">Date de naissance
            <sup>*</sup>
        </label>
        <input type="date" name="birthday" id="birthday" class="form-control" value="<?= $user->getBirthday() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>required>

    </div>

    <div class="form-group mt-3">
        <label for="phone">Numéro de téléphone
            <sup>*</sup>
        </label>
        <input type="text" name="phone" id="phone" class="form-control" value="<?= $user->getPhone() ?>" <?= $mode == "suppression" ? "disabled" : "" ?>required>
    </div>
    <div class="d-flex justify-content-between mt-3">
        <button type="submit" class="btn btn-primary" name="register">
            <?= $mode == "suppression" ? "Confirmer" : "Enregistrer" ?>
        </button>
        <a href="<?= addLink("user") ?>" class="btn btn-danger">Annuler</a>
    </div>
</form>

