<?php
// require on as importe le fichier inc et init.inc.php
require "inc/init.inc.php";
/* 
URL: index.php?controller=user&method=update&id=32
*/
$admin = $_GET["doc"] ?? null;
$controller = $_GET["controller"] ?? "home";
$method = $_GET["method"] ?? "list";
$id = $_GET["id"] ?? null;

// !empty determine si une varialbe est considere vide.
if (!empty($admin)) {
    $classController = "Controller\\admin\\" . ucfirst($controller) . "Controller";
} else {
    $classController = "Controller\\" . ucfirst($controller) . "Controller";
}
// d_die ca veux il s'arrete et var_dump il continuer

//$classController = "Controller\\" . ucfirst($controller) . "Controller";  // ucfirst: met la première lettre d'un string en majuscule
/* $classController = "Controller\UserController" 
   $method = "list"
*/

/* On peut instancier un objet en utilisant un string pour le nom de la class.
    _⚠ le nom de la class doit être dans une variable pour pouvoir utiliser 'new'
*/

try {
    $controller = new $classController;
    // $UserController->update($id);

    $controller->$method($id);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}