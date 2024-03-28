<!-- Messages -->
<?php

// Récupération des messages de session :

// Tout d'abord, le code utilise la classe Session pour récupérer les messages stockés en session. Il semble que ces messages ont été ajoutés précédemment à l'aide de la méthode setMessage() de la classe BaseController.

use Service\Session;

// Affichage des messages :

// Ensuite, le code vérifie si des messages ont été récupérés. S'il y a des messages, il itère sur chaque type de message (par exemple, "success", "danger", etc.).
// Pour chaque type de message, il crée une <div> avec la classe alert de Bootstrap, en utilisant la classe alert-<?= $type pour définir la couleur de l'alerte en fonction du type de message.
// À l'intérieur de chaque <div> d'alerte, il itère sur tous les messages de ce type et les affiche à l'intérieur de <div> séparés.

$messages = Session::getMessages();

?>

<?php if ($messages): ?>

    <!--Boucle foreach :-->

    <!--La boucle foreach est utilisée pour parcourir les messages de chaque type. Pour chaque type de message, une <div> d'alerte est créée avec la classe appropriée pour le style Bootstrap.-->

    <?php foreach ($messages as $type => $messagesType): ?>

        <!--Affichage des messages :

À l'intérieur de chaque <div> d'alerte, une autre boucle foreach est utilisée pour afficher chaque message du type correspondant.-->

            <div class="alert alert-<?= $type ?> m-0"> <?php foreach ($messagesType as $msg): ?>

                <div><?= $msg ?></div>

            <?php endforeach; ?>

        </div>

    <?php endforeach; ?>

<?php endif; ?>

<!--en résumé, ce code récupère les messages stockés en session, les classe par type, puis les affiche dans des boîtes
d'alerte colorées en fonction de leur type. Cela est souvent utilisé pour afficher des messages utilisateur tels que des
succès, des avertissements ou des erreurs après des opérations telles que l'envoi d'un formulaire.-->

