<?php
// Espace de noms et utilisation de classes :
// L'espace de noms est défini comme Controller\Admin. Cela signifie que ce fichier appartient au namespace Controller\Admin.
// Plusieurs classes sont importées avec l'instruction use. Elles sont utilisées dans ce fichier pour éviter de devoir spécifier le chemin complet de chaque classe à chaque utilisation.

namespace Controller\Admin;

use Service\ImageHandler;
use Controller\BaseController;
use Form\GateauxHandleRequest;
use Model\Entity\Gateaux;
use Model\Repository\GateauxRepository;

// Classe GateauxController :

// Cette classe étend BaseController, ce qui suggère que BaseController contient des fonctionnalités partagées par plusieurs contrôleurs.
// Les propriétés gateauxRepository, form, et product sont déclarées pour gérer respectivement la manipulation des données en base de données, la manipulation du formulaire, et la gestion des produits (gateaux).
class GateauxController extends BaseController
{
    private GateauxRepository $gateauxRepository;
    private GateauxHandleRequest $form;
    private Gateaux $product;

    // Constructeur :

    // Le constructeur initialise les propriétés en instanciant GateauxRepository, GateauxHandleRequest, et Gateaux.
    public function __construct()
    {
        //$this->gateauxRepository = new GateauxRepository;: Cette ligne crée une nouvelle instance de la classe GateauxRepository et l'assigne à la propriété $gateauxRepository de l'objet courant (instance de la classe contenant ce code).
        $this->gateauxRepository = new GateauxRepository;
        $this->form = new GateauxHandleRequest;
        //$this->product = new Gateaux;: Cette ligne crée une nouvelle instance de la classe Gateaux et l'assigne à la propriété $product de l'objet courant.
        $this->product = new Gateaux;
    }
    // Méthode list() :
    // Cette méthode récupère tous les gateaux depuis la base de données via gateauxRepository, puis les passes à la vue pour affichage.
    public function list()
    {

        $list_Gateaux = $this->gateauxRepository->findAll($this->product);

        $this->render("admin/gateaux/list_gateau.html.php", [
            "h1" => "Liste des produits",
            "products" => $list_Gateaux
        ]);
    }

    // Méthode new() :
    // Cette méthode est utilisée pour ajouter un nouveau produit (gateau). Elle gère la soumission du formulaire et l'insertion du produit dans la base de données.
    public function new()
    {
        $product = $this->product;

        $this->form->handleInsertForm($product);
        if ($this->form->isSubmitted() && $this->form->isValid()) {

            ImageHandler::handelPhoto($product);

            $this->gateauxRepository->insertProduct($product);

            return redirection(addLink("home"));
        }

        $errors = $this->form->getEerrorsForm();

        return $this->render("admin/gateaux/ajout_gateau.html.php", [
            "h1" => "Ajouter un nouveau produit",
            "product" => $product,
            "errors" => $errors,
        ]);
    }

    // Méthode edit($id) :
    // Cette méthode est utilisée pour éditer un produit existant. Elle récupère le produit à partir de l'identifiant fourni, traite le formulaire d'édition et met à jour le produit dans la base de données.
    public function edit($id)
    {
        if (!empty($id) && is_numeric($id)) {

            /**
             * @var Gateaux
             */
            $product = $this->product;

            $this->form->handleEditForm($product);

            if ($this->form->isSubmitted() && $this->form->isValid()) {
                $this->gateauxRepository->updateProduct($product);
                return redirection(addLink("home"));
            }

            $errors = $this->form->getEerrorsForm();
            return $this->render("product/form.html.php", [
                "h1" => "Update de l'utilisateur n° $id",
                "product" => $product,
                "errors" => $errors
            ]);
        }
        return redirection("/errors/404.php");
    }

    // Méthode delete($id) :
    // Cette méthode est utilisée pour supprimer un produit. Elle récupère le produit à partir de l'identifiant fourni, puis l'affiche avec un formulaire de confirmation de suppression.
    public function delete($id)
    {
        if (!empty($id) && $id > 0) {
            if (is_numeric($id)) {

                $product = $this->product;
            } else {
                $this->setMessage("danger", "ERREUR 404 : la page demandé n'existe pas");
            }
        } else {
            $this->setMessage("danger", "ERREUR 404 : la page demandé n'existe pas");
        }

        // Rendu de la vue :
        // Les méthodes render() sont utilisées pour rendre les vues correspondantes avec les données appropriées.
        $this->render("product/form.html.php", [
            "h1" => "Suppresion du produit n°$id ?",
            "product" => $product,
            "mode" => "suppression"
        ]);
    }
}