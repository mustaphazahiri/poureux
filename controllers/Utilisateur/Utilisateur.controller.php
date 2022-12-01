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
                Securite::genererCookieConnexion();
                echo $_SESSION['profil'][Securite::COOKIE_NAME];
                echo "<br />";
                echo $_COOKIE[Securite::COOKIE_NAME];
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
        $_SESSION['profil']["id_role"] = $datas['id_role'];
        $data_page = [
            "page_description" => "Description de la page espace membre",
            "page_title" => "Se connecter à l'espace membre",
            "utilisateur" => $datas,
            "page_css" => ["main.css"],
            "page_javascript" => ['profil.js'],
            "view" => "views/utilisateur/profil.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
    public function cuisinier()
    {
        $datas = $this->utilisateurManager->getUserInformation($_SESSION['profil']['login']);
        $_SESSION['profil']["id_role"] = $datas['id_role'];
        $data_page = [
            "page_description" => "Description de la page espace Cuisinier",
            "page_title" => "l'espace Cuisinier",
            "utilisateur" => $datas,
            "page_css" => ["main.css"],
            "page_javascript" => ['profil.js'],
            "view" => "views/utilisateur/paniersrepas.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
    public function livreur()
    {
        $datas = $this->utilisateurManager->getUserInformation($_SESSION['profil']['login']);
        $_SESSION['profil']["id_role"] = $datas['id_role'];
        $data_page = [
            "page_description" => "Description de la page espace Livreur",
            "page_title" => "l'espace Livreur",
            "utilisateur" => $datas,
            "page_css" => ["main.css"],
            "page_javascript" => ['profil.js'],
            "view" => "views/utilisateur/livraisons.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }

    public function deconnexion()
    {
        unset($_SESSION['profil']);
        setcookie(Securite::COOKIE_NAME, "", time() - 3600);
        header("Location: " . URL . "lecollectif");
        Toolbox::ajouterMessageAlerte("vous êtes maintenant déconnectés ", Toolbox::COULEUR_VERTE);
    }
    public function validation_inscription($login, $password, $nom_user, $prenom_user, $adresse, $cp, $ville, $telephone, $facebook, $clef, $id_role)
    {
        if ($this->utilisateurManager->isLoginAvailable($login)) {
            $passwordCrypte = password_hash($password, PASSWORD_DEFAULT);
            $clef = rand(0, 9999);
            if ($this->utilisateurManager->bdCreerCompte($login, $passwordCrypte, $nom_user, $prenom_user, $adresse, $cp, $ville, $telephone, $facebook, $clef, $id_role)) {
                // $this->sendMailValidation($login, $clef);
                Toolbox::ajouterMessageAlerte('Votre compte a été crée, un administrateur vous contactera prochainement', Toolbox::COULEUR_VERTE);
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
    // private function sendMailValidation($login, $clef)
    // {
    //     $urlVerif = URL . "validationMail/" . $login . "/" . $clef;
    //     $sujet = " creation du compte sur le site poureux.fr";
    //     $message = " Afin de valider votre compte merci de cliquer sur le lien suivant " . $urlVerif;
    //     Toolbox::sendMail($login, $sujet, $message);
    // }
    // public function renvoyerMailValidation($login)
    // {
    //     $utilisateur = $this->utilisateurManager->getUserInformation($login);
    //     $this->sendMailValidation($utilisateur['login'], $utilisateur['clef']);
    //     header("Location: " . URL . "connexion");
    // }
    // public function validation_mailCompte($login, $clef)
    // {
    //     if ($this->utilisateurManager->bdValidationMailCompte($login, $clef)) {
    //         Toolbox::ajouterMessageAlerte("le compte a été activé avec succès", Toolbox::COULEUR_VERTE);
    //         header("Location: " . URL . 'connexion');
    //     } else {
    //         Toolbox::ajouterMessageAlerte("le compte n'a pas été activé !", Toolbox::COULEUR_ROUGE);
    //         header("Location: " . URL . 'inscription');
    //     }
    // }
    public function validation_modificationMail($email)
    {
        if ($this->utilisateurManager->bdModificationMailUser($_SESSION['profil']['login'], $email)) {
            Toolbox::ajouterMessageAlerte("La modification est effectuée", Toolbox::COULEUR_VERTE);
        } else {
            Toolbox::ajouterMessageAlerte("Aucune modification effectuée", Toolbox::COULEUR_ROUGE);
        }
        header("Location: " . URL . "compte/profil");
    }
    public function modificationPassword()
    {
        $data_page = [
            "page_description" => "Page de modification du password",
            "page_title" => "Page de modification du password",
            "page_css" => ["main.css"],
            "page_javascript" => ["modificationPassword.js"],
            "view" => "views/Utilisateur/modificationPassword.view.php",
            "template" => "views/common/template2.php"
        ];
        $this->genererPage($data_page);
    }
    public function validation_modificationPassword($ancienPassword, $nouveauPassword, $confirmationNouveauPassword)
    {
        if ($nouveauPassword === $confirmationNouveauPassword) {
            if ($this->utilisateurManager->isCombinaisonValide($_SESSION['profil']['login'], $ancienPassword)) {
                $passwordCrypte = password_hash($nouveauPassword, PASSWORD_DEFAULT);
                if ($this->utilisateurManager->bdModificationPassword($_SESSION['profil']['login'], $passwordCrypte)) {
                    Toolbox::ajouterMessageAlerte("La modification du password a été effectuée", Toolbox::COULEUR_VERTE);
                    header("Location: " . URL . "compte/profil");
                } else {
                    Toolbox::ajouterMessageAlerte("La modification a échouée", Toolbox::COULEUR_ROUGE);
                    header("Location: " . URL . "compte/modificationPassword");
                }
            } else {
                Toolbox::ajouterMessageAlerte("La combinaison login / ancien password ne correspond pas", Toolbox::COULEUR_ROUGE);
                header("Location: " . URL . "compte/modificationPassword");
            }
        } else {
            Toolbox::ajouterMessageAlerte("Les passwords ne correspondent pas", Toolbox::COULEUR_ROUGE);
            header("Location: " . URL . "compte/modificationPassword");
        }
    }
    public function suppressionCompte()
    {
        if ($this->utilisateurManager->bdSuppressionCompte($_SESSION['profil']['login'])) {
            Toolbox::ajouterMessageAlerte("La suppression du compte est effectuée", Toolbox::COULEUR_VERTE);
            $this->deconnexion();
        } else {
            Toolbox::ajouterMessageAlerte("La suppression n'a pas été effectuée. Contactez l'administrateur", Toolbox::COULEUR_ROUGE);
            header("Location: " . URL . "compte/profil");
        }
    }
    public function joinRoleUser($id_role)
    {
        $this->utilisateurManager->joinRoleUser($id_role);
        Toolbox::ajouterMessageAlerte('la table USER_ROLE a été mise à jour', Toolbox::COULEUR_VERTE);
        header("Location: " . URL . "connexion");
    }

    public function pageErreur($msg)
    {
        parent::pageErreur($msg);
    }
}

// public function inscription(){

// }