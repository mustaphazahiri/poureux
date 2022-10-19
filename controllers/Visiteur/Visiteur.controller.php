
<?php
require_once("./controllers/MainController.controller.php");
require_once("./models/Visiteur/Visiteur.model.php");

class VisiteurController extends MainController
{
    private $visiteurManager;

    public function __construct()
    {
        $this->visiteurManager = new VisiteurManager();
    }

    public function accueil()
    {

        $data_page = [
            "page_description" => "Description de la page d'accueil",
            "page_title" => "Le Collectif PourEux à Nancy",
            "view" => "views/Visiteur/accueil.view.php",
            "template" => "views/common/template.php"
        ];
        $this->genererPage($data_page);
    }
    public function login()
    {

        $data_page = [
            "page_description" => "Description de la page espace membre",
            "page_title" => "Se connecter à l'espace membre",
            "view" => "views/Visiteur/connexion.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
    public function inscription()
    {
        $data_page = [
            "page_description" => "Description de la page d'inscription",
            "page_title" => "S'inscrire pour devenir bénévole'",
            "view" => "views/Visiteur/inscription.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
    public function lecollectif()
    {
        $data_page = [
            "page_description" => "Description de la page qui sommes nous",
            "page_title" => "Qui sommes nous?",
            "view" => "views/lecollectif.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
    public function nousrejoindre()
    {
        // Toolbox::ajouterMessageAlerte("test", Toolbox::COULEUR_VERTE);

        $data_page = [
            "page_description" => "Description de la page pour devenir bénévole",
            "page_title" => "Rejoindre Le Collectif PourEux à Nancy",
            "view" => "views/nousrejoindre.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
    public function actualites()
    {
        $utilisateurs = $this->visiteurManager->getUtilisateurs();
        $data_page = [
            "page_description" => "Description de la page d'actualités du collectif",
            "page_title" => "Actualités du Collectif PourEux à Nancy",
            "utilisateurs" => $utilisateurs,
            "view" => "views/actualites.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
    public function contact()
    {
        $data_page = [
            "page_description" => "Description de la page contact",
            "page_title" => "Contacter Le Collectif PourEux à Nancy",
            "view" => "views/contact.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
    public function mentions()
    {
        $data_page = [
            "page_description" => "La page des mentions légales ",
            "page_title" => "Les mentions légales du site",
            "view" => "views/mentions.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
    public function cgu()
    {
        $data_page = [
            "page_description" => "La page des condition generales d'utilisation ",
            "page_title" => "Les conditions generales d'utilisation du site",
            "view" => "views/cgu.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }



    public function pageErreur($msg)
    {
        parent::pageErreur($msg);
    }
}
