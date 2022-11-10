<?php
require_once("./controllers/MainController.controller.php");
require_once("./models/Administrateur/Administrateur.model.php");

class AdministrateurController extends MainController
{
    private $administrateurManager;

    public function __construct()
    {
        $this->administrateurManager = new AdministrateurManager();
    }

    public function droits()
    {
        $utilisateurs = $this->administrateurManager->getUtilisateurs();

        $data_page = [
            "page_description" => "Gestion des droits",
            "page_title" => "Gestion des droits",
            "utilisateurs" => $utilisateurs,
            "page_css" => ["main.css"],
            "view" => "views/Administrateur/droits.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
    public function validation_modificationRole($login, $id_role)
    {
        if ($this->administrateurManager->bdModificationRoleUser($login, $id_role)) {
            Toolbox::ajouterMessageAlerte("La modification a été prise en compte", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("La modification n'a pas été prise en compte", Toolbox::COULEUR_ROUGE);
            var_dump($_POST['login']);
        }
        header("Location: " . URL . "administration/droits");
    }
    public function validation_compte($email, $is_valid)
    {
        if ($this->administrateurManager->bdActivationCompte($email, $is_valid)) {
            Toolbox::ajouterMessageAlerte("L'activation du compte a été prise en compte", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("L'activation du compte n'a pas été prise en compte", Toolbox::COULEUR_ROUGE);
            var_dump($_POST);
        }
        // header("Location: " . URL . "administration/droits");
    }
    public function pageErreur($msg)
    {
        parent::pageErreur($msg);
    }
}
