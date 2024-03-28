<!--Condition if (!empty($errors)) :

Cette ligne vérifie si la variable $errors n'est pas vide. Si elle contient des éléments, cela signifie qu'il y a des erreurs à afficher.-->
<?php if (!empty($errors)): ?>
    <!--Div d'erreur <div class="error-formulaire"> :
Si des erreurs sont présentes (c'est-à-dire que la condition dans le if est vraie), une <div> avec la classe error-formulaire est générée pour contenir les messages d'erreur.-->
    <div
        class="error-formulaire">
        <!--Boucle foreach pour parcourir les erreurs :
        Ensuite, une boucle foreach est utilisée pour parcourir chaque élément du tableau $errors. À chaque itération, le message d'erreur est récupéré dans la variable $err.-->
        <?php foreach ($errors as $err): ?>
            <!--Affichage des messages d'erreur :
        
        À l'intérieur de la boucle foreach, chaque message d'erreur est affiché dans une <div> avec la classe text-danger, qui est une classe Bootstrap pour afficher du texte en rouge pour indiquer une erreur.-->
            <div class="text-danger"><?= $err ?></div>
            <!--ermeture de la div d'erreur :
        
        Une fois toutes les erreurs affichées, la <div> contenant les messages d'erreur est fermée avec </div>.-->
        <?php endforeach; ?>
        <!--Fin de la condition if :
    
    Enfin, la balise de fin endif; est utilisée pour terminer la condition if commencée au début du code. Cela indique la fin de la logique conditionnelle qui vérifie si des erreurs sont présentes.-->
    </div>
<?php endif; ?>
<!--En résumé, ce code vérifie si des erreurs sont présentes dans le tableau $errors. S'il y en a, il les affiche dans une boîte d'erreur avec un style spécifique pour les distinguer des autres contenus de la page. Si aucun erreur n'est présent, cette section de code n'affiche rien. C'est une technique courante pour afficher des messages d'erreur lors de la soumission de formulaires.-->

