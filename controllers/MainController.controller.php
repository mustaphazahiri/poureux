<?php
require_once("models/MainManager.model.php");
require_once("controllers/Toolbox.class.php");

abstract class MainController
{
    private $mainManager;

    public function __construct()
    {
        // $this->mainManager = new MainManager();
    }

    protected function genererPage($data)
    {
        extract($data);
        ob_start();
        require_once($view);
        $page_content = ob_get_clean();
        require_once($template);
    }

    protected function paniersrepas()
    {
        // Toolbox::ajouterMessageAlerte("test", Toolbox::COULEUR_VERTE);

        $data_page = [
            "page_description" => "Description de la page des cuistots",
            "page_title" => "Cuistot, Le Collectif PourEux à Nancy",
            "page_css" => ["main.css"],
            "view" => "views/paniersrepas.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
    protected function livraisons()
    {
        // Toolbox::ajouterMessageAlerte("test", Toolbox::COULEUR_VERTE);

        $data_page = [
            "page_description" => "Description de la page des livreurs",
            "page_title" => "Livreur de repas, Le Collectif PourEux à Nancy",
            "page_css" => ["main.css"],
            "view" => "views/livraisons.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }



    protected function pageErreur($msg)
    {
        $data_page = [
            "page_description" => "Page permettant de gérer les erreurs",
            "page_title" => "Page d'erreur",
            "msg" => $msg,
            "page_css" => ["main.css"],
            "view" => "./views/erreur.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
}
