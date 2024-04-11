<?php
namespace Form;


class BaseHandleRequest
{
// Propriété privée $errors :
// Cette classe a une propriété privée $errors, qui est utilisée pour stocker les erreurs associées à la validation des données du formulaire.
    private $errors;

// Méthode setEerrorsForm() :
// Cette méthode permet de définir les erreurs du formulaire. Elle prend un tableau d'erreurs en argument et les assigne à la propriété $errors de l'objet.
    public function setErrorsForm(array $errors)
    {
        $this->errors = $errors;
    }

// Méthode getEerrorsForm() :
// Cette méthode permet de récupérer les erreurs du formulaire. Elle retourne simplement la valeur de la propriété $errors.
    public function getEerrorsForm()
    {
        return $this->errors;
    }
// Méthode isValid() :
// Cette méthode vérifie si le formulaire est valide, c'est-à-dire s'il n'y a pas d'erreurs. Elle utilise la fonction empty() pour vérifier si la propriété $errors est vide. Si elle est vide, la méthode retourne true, sinon elle retourne false
    public function isValid()
    {
        $result = empty($this->errors) ? true : false;
        return $result;
    }
 // Méthode isSubmitted() :
// Cette méthode vérifie si le formulaire a été soumis. Elle utilise également la fonction empty() pour vérifier si $_POST est vide. Si $_POST est vide, cela signifie que le formulaire n'a pas été soumis, donc la méthode retourne false, sinon elle retourne true.
    public function isSubmitted()
    {
        $result = empty($_POST) ? false : true;
        return $result;
    }
}