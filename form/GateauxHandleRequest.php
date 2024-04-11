<?php

// Ce code PHP semble être une partie d'une application web, probablement utilisée pour manipuler des formulaires relatifs à des gâteaux dans un système de gestion de produits. Voici une explication détaillée du code :

// Namespace et imports :
// Le code commence par définir un namespace Form et importe plusieurs classes nécessaires à l'intérieur de ce namespace. Ces classes semblent être utilisées pour manipuler des données de formulaire et interagir avec d'autres parties de l'application, telles que les entités de modèle (Gateaux, Product), les services (ImageHandler, Session), et les repositories (GateauxRepository).

namespace Form;

use Model\Entity\Gateaux;
use Model\Repository\GateauxRepository;

// Classe GateauxHandleRequest :
// Cette classe semble être responsable de manipuler les données des formulaires liés aux gâteaux.
class GateauxHandleRequest extends BaseHandleRequest
{
    private GateauxRepository $productRepository;

    public function __construct()
    // Constructeur :
// Le constructeur initialise un objet GateauxRepository qui semble être une sorte de couche d'accès aux données pour les entités de gâteaux.
    {
        $this->productRepository = new GateauxRepository;
    }

    // Méthode handleInsertForm :
// Cette méthode semble être utilisée pour traiter les données d'un formulaire d'insertion de gâteau. Elle vérifie si la requête HTTP est de type POST, extrait les données du formulaire à partir de $_POST, vérifie la validité des données, et enregistre les erreurs éventuelles dans un tableau.
    public function handleInsertForm(Gateaux $product)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            extract($_POST);
            $errors = [];

            if (!(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK)) {
                $errors[] = "Veuillez sélectionner une image à télécharger pour continuer.";
            }
            // Validation des données :
// Vérification de la présence et de la validité de l'image téléchargée.
// Vérification que le prix est numérique et non vide.

            if (!is_numeric($p_gateau)) {
                $errors[] = "Le prix doit avoir une valeur numérique";
            }
            if (empty($p_gateau)) {
                $errors[] = "Le prix ne peut pas être vide";
            }

// Traitement des erreurs :
// Si aucune erreur n'est détectée, les données du formulaire sont utilisées pour mettre à jour l'objet Gateaux. Sinon, les erreurs sont enregistrées dans l'objet GateauxHandleRequest à l'aide de la méthode setEerrorsForm.
            if (empty($errors)) {
                $product->setNomGateau($n_gateau);
                $product->setDescription($d_gateau ?? null);
                $product->setPrix($p_gateau);
                return $this;
            }
            $this->setErrorsForm($errors);
            return $this;
        }
    }
    // Méthode handleEditForm :
// Cette méthode semble être similaire à handleInsertForm, mais adaptée pour le formulaire d'édition de gâteau. Elle vérifie également la validité des données, y compris le nom, le prix, le stock et la catégorie.
// Retour :
// Dans les deux méthodes, si aucune erreur n'est détectée, la méthode retourne l'instance de GateauxHandleRequest. Sinon, elle retourne également l'instance, mais avec les erreurs enregistrées.
    public function handleEditForm(Gateaux $product)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            extract($_POST);
            $errors = [];
            // Vérification de la validité du formulaire
            if (empty($n_gateau)) {
                $errors[] = "Le nom ne peut pas être vide";
            }
            if (strlen($n_gateau) < 4) {
                $errors[] = "Le nom doit avoir au moins 4 caractères";
            }
            if (strlen($n_gateau) > 20) {
                $errors[] = "Le nom ne peut avoir plus de 20 caractères";
            }

            if (!(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK)) {
                $errors[] = "Veuillez sélectionner une image à télécharger pour continuer.";
            }

            if (!is_numeric($p_gateau)) {
                $errors[] = "Le prix doit avoir une valeur numérique";
            }
            if (empty($p_gateau)) {
                $errors[] = "Le prix ne peut pas être vide";
            }

            if (empty($errors)) {
                $product->setNomGateau($nom_gateau);
                $product->setDescription($description ?? null);
                $product->setPrix($p_gateau);
                return $this;
            }

            $this->setErrorsForm($errors);
            return $this;
        }
    }
}