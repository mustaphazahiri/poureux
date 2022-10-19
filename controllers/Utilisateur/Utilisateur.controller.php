<?php
require_once("./controllers/MainController.controller.php");
require_once("./models/Utilisateur/Utilisateur.model.php");

class UtilisateurController extends MainController
{
    private $utilisateurManager;

    public function __construct()
    {
        $this->utilisateurManager = new UtilisateurManager();
    }
    public function validation_login($login, $password)
    {
        if ($this->utilisateurManager->isCombinaisonValide($login, $password)) {
            if ($this->utilisateurManager->estCompteActive($login)) {
                Toolbox::ajouterMessageAlerte("Bienvenue dans votre espace membre " . $login . " !", Toolbox::COULEUR_VERTE);
                $_SESSION['profil'] = [
                    "login" => $login,
                ];
                header("Location: " . URL . "compte/profil");
            } else {
                $msg = "Le compte " . $login . " n'a pas été activé par mail. ";
                $msg .= "<a href='renvoyerMailValidation/" . $login . "'>Renvoyez le mail de validation</a>";
                Toolbox::ajouterMessageAlerte($msg, Toolbox::COULEUR_ROUGE);
                //renvoyer le mail de validation
                header("Location: " . URL . "connexion");
            }
        } else {
            Toolbox::ajouterMessageAlerte("Combinaison Login / Mot de passe n'est pas conforme ", Toolbox::COULEUR_ROUGE);
            header("Location: " . URL . "connexion");
        }
    }

    public function profil()
    {
        $datas = $this->utilisateurManager->getUserInformation($_SESSION['profil']['login']);
        $_SESSION['profil']["role"] = $datas['role'];
        $data_page = [
            "page_description" => "Description de la page espace membre",
            "page_title" => "Se connecter à l'espace membre",
            "utilisateur" => $datas,
            "view" => "views/utilisateur/profil.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }

    public function deconnexion()
    {

        unset($_SESSION['profil']);
        header("Location: " . URL . "lecollectif");
        Toolbox::ajouterMessageAlerte("vous êtes maintenant déconnectés ", Toolbox::COULEUR_VERTE);
    }
    public function validation_inscription($login, $password, $nom_user, $prenom_user, $adresse, $cp, $ville, $telephone, $clef)
    {
        if ($this->utilisateurManager->isLoginAvailable($login)) {
            $passwordCrypte = password_hash($password, PASSWORD_DEFAULT);
            $clef = rand(0, 9999);
            if ($this->utilisateurManager->bdCreerCompte($login, $passwordCrypte, $nom_user, $prenom_user, $adresse, $cp, $ville, $telephone, $clef)) {
                $this->sendMailValidation($login, $clef);
                Toolbox::ajouterMessageAlerte('Votre compte a été crée, un mail de validation vous sera envoyé', Toolbox::COULEUR_VERTE);
                header("Location: " . URL . "connexion");
            } else {
                Toolbox::ajouterMessageAlerte('Erreur lors de la création du compte', Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "inscription");
            }
        } else {
            Toolbox::ajouterMessageAlerte('un compte existe déjà avec cet email', Toolbox::COULEUR_ROUGE);
            header("Location: " . URL . "inscription");
        }
    }
    private function sendMailValidation($login, $clef)
    {
        $urlVerif = URL . "validationMail/" . $login . "/" . $clef;
        $sujet = " creation du compte sur le site poureux.fr";
        $message = " Afin de valider votre compte merci de cliquer sur le lien suivant " . $urlVerif;
        Toolbox::sendMail($login, $sujet, $message);
    }
    public function renvoyerMailValidation($login)
    {
        $utilisateur = $this->utilisateurManager->getUserInformation($login);
        $this->sendMailValidation($utilisateur['login'], $utilisateur['clef']);
        header("Location: " . URL . "connexion");
    }
    public function pageErreur($msg)
    {
        parent::pageErreur($msg);
    }
}

// public function inscription(){

// }