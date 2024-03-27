<?php
/**
 * Summary of namespace Controller
 */
namespace Controller\Admin;

use Service\ImageHandler;
use Controller\BaseController;
use Form\GateauxHandleRequest;
use Model\Entity\Gateaux;
use Model\Repository\GateauxRepository;

class GateauxController extends BaseController
{
    private GateauxRepository $gateauxRepository;
    private GateauxHandleRequest $form;
    private Gateaux $product;

    public function __construct()
    {
        $this->gateauxRepository = new GateauxRepository;
        $this->form = new GateauxHandleRequest;
        $this->product = new Gateaux;
    }

    public function list()
    {

        $list_Gateaux = $this->gateauxRepository->findAll($this->product);

        $this->render("admin/gateaux/list_gateau.html.php", [
            "h1" => "Liste des produits",
            "products" => $list_Gateaux
        ]);
    }

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

        $this->render("product/form.html.php", [
            "h1" => "Suppresion du produit n°$id ?",
            "product" => $product,
            "mode" => "suppression"
        ]);
    }
}