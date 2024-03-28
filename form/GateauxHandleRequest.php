<?php

namespace Form;

use Model\Entity\Gateaux;
use Model\Entity\Product;
use Service\ImageHandler;
use Service\Session as Sess;
use Model\Repository\GateauxRepository;

class GateauxHandleRequest extends BaseHandleRequest
{
    private $productRepository;

    public function __construct()
    {
        $this->productRepository = new GateauxRepository;
    }

    public function handleInsertForm(Gateaux $product)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            extract($_POST);
            $errors = [];

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
                $product->setNomGateau($n_gateau);
                $product->setDescription($d_gateau ?? null);
                $product->setPrix($p_gateau);
                return $this;
            }
            $this->setEerrorsForm($errors);
            return $this;
        }
    }
    public function handleEditForm(Gateaux $product)
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            extract($_POST);
            $errors = [];
            // Vérification de la validité du formulaire
            if (empty($nom_gateau)) {
                $errors[] = "Le nom ne peut pas être vide";
            }
            if (strlen($nom_gateau) < 4) {
                $errors[] = "Le nom doit avoir au moins 4 caractères";
            }
            if (strlen($nom_gateau) > 20) {
                $errors[] = "Le nom ne peut avoir plus de 20 caractères";
            }

            if (!(isset($_FILES["photo"]) && $_FILES["photo"]["error"] == UPLOAD_ERR_OK)) {
                $errors[] = "Veuillez sélectionner une image à télécharger pour continuer.";
            }

            if (!is_numeric($prix)) {
                $errors[] = "Le prix doit avoir une valeur numérique";
            }
            if (empty($prix)) {
                $errors[] = "Le prix ne peut pas être vide";
            }
            if (!is_numeric($stock)) {
                $errors[] = "Le stock doit avoir une valeur numérique";
            }
            if (empty($stock)) {
                $errors[] = "Le stock ne peut pas être vide";
            }
            if (empty($cat_id)) {
                $errors[] = "La category ne peut pas être vide";
            }

            if (empty($errors)) {
                $product->setNomGateau($nom_gateau);
                $product->setDescription($description ?? null);
                $product->setPrix($prix);
                return $this;
            }

            $this->setEerrorsForm($errors);
            return $this;
        }
    }
}