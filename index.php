<?php
session_start();

define("URL", str_replace("index.php", "", (isset($_SERVER['HTTPS']) ? "https" : "http") .
    "://" . $_SERVER['HTTP_HOST'] . $_SERVER["PHP_SELF"]));
require_once("./vendor/autoload.php");
require_once("./controllers/Toolbox.class.php");
require_once("./controllers/Visiteur/Visiteur.controller.php");
require_once("./controllers/Securite.class.php");
require_once("./controllers/Utilisateur/Utilisateur.controller.php");

use GuzzleHttp\Client;

const API_URL = 'https://geo.api.gouv.fr/';

$visiteurController = new VisiteurController();
$utilisateurController = new UtilisateurController();

try {
    if (empty($_GET['page'])) {
        $page = "accueil";
    } else {
        $url = explode("/", filter_var($_GET['page'], FILTER_SANITIZE_URL));
        $page = $url[0];
    }

    switch ($page) {
        case "accueil":
            $visiteurController->accueil();
            break;
        case "connexion":
            $visiteurController->login();
            break;
        case "validation_login":
            if (!empty($_POST['login']) && !empty($_POST['password'])) {
                $login = Securite::secureHTML($_POST['login']);
                $password = Securite::secureHTML($_POST['password']);
                $utilisateurController->validation_login($login, $password);
            } else {
                Toolbox::ajouterMessageAlerte("login ou mot de passe non renseigné", Toolbox::COULEUR_ROUGE);
                header('Location: ' . URL . "connexion");
            }
            echo $_POST['login'] . " - " . $_POST['password'];
            break;
        case "inscription":
            $visiteurController->inscription();
            break;
        case "validation_inscription":
            // echo "test validation inscription";
            if (!empty($_POST['login']) && !empty($_POST['password']) && !empty($_POST['nom_user']) && !empty($_POST['prenom_user']) && !empty($_POST['adresse']) && !empty($_POST['cp']) && !empty($_POST['ville']) && !empty($_POST['telephone'])) {
                $login = Securite::secureHTML($_POST['login']);
                $password = Securite::secureHTML($_POST['password']);
                $nom_user = Securite::secureHTML($_POST['nom_user']);
                $prenom_user = Securite::secureHTML($_POST['prenom_user']);
                $adresse = Securite::secureHTML($_POST['adresse']);
                $cp = Securite::secureHTML($_POST['cp']);
                $ville = Securite::secureHTML($_POST['ville']);
                $telephone = Securite::secureHTML($_POST['telephone']);
                // var_dump($_POST);
                $client = new GuzzleHttp\Client(['base_uri' => API_URL]);

                $response = $client->request('GET', 'communes?codePostal=' . $cp . '&fields=nom&format=json');
                $response = json_decode($response->getBody()->getContents());

                $villes = [];

                foreach ($response as $resp) {
                    array_push($villes, $resp->nom);
                }

                if (in_array($ville, $villes)) {
                    $success = 'Informations envoyées';
                } else {
                    $error = 'Le code postal et la commune ne correspondent pas.';
                }
                $utilisateurController->validation_inscription($login, $password, $nom_user, $prenom_user, $adresse, $cp, $ville, $telephone, $clef);
            } else {
                Toolbox::ajouterMessageAlerte("Toutes les informations sont obligatoires pour pouvoir s'inscrire ", Toolbox::COULEUR_ROUGE);
                header('Location: ' . URL . "inscription");
            }
            break;
        case "renvoyerMailValidation":
            $utilisateurController->renvoyerMailValidation($url[1]);
            echo "test";
            break;
        case "validationMail":
            $utilisateurController->validation_mailCompte($url[1], $url[2]);
            break;

        case "lecollectif":
            $visiteurController->lecollectif();
            break;
        case "nousrejoindre":
            $visiteurController->nousrejoindre();
            break;
        case "actualites":
            $visiteurController->actualites();
            break;
        case "paniersrepas":
            $mainController->paniersrepas();
            break;
        case 'livraisons':
            $mainController->livraisons();
            break;
        case 'contact':
            $visiteurController->contact();
            break;
        case 'mentions':
            $visiteurController->mentions();
            break;
        case 'cgu':
            $visiteurController->cgu();
            break;
        case "compte":
            if (!Securite::isconnected()) {
                Toolbox::ajouterMessageAlerte("Veuillez vous connecter", Toolbox::COULEUR_ROUGE);
                header('Location: ' . URL . "connexion");
            } else {
                switch ($url[1]) {
                        // case "cuisinier":
                        //     $utilisateurController->cuisinier();
                        //     break;
                        // case "livreur":
                        //     $utilisateurController->livreur();
                        //     break;
                    case "profil":
                        $utilisateurController->profil();
                        break;
                    case "deconnexion":
                        $utilisateurController->deconnexion();
                        break;
                    case "validation_modificationMail":
                        $utilisateurController->validation_modificationMail(Securite::secureHTML($_POST['email']));
                        break;
                    case "modificationPassword":
                        $utilisateurController->modificationPassword();
                        break;
                    case "validation_modificationPassword":
                        if (!empty($_POST['ancienPassword']) && !empty($_POST['nouveauPassword']) && !empty($_POST['confirmNouveauPassword'])) {
                            $ancienPassword = Securite::secureHTML($_POST['ancienPassword']);
                            $nouveauPassword = Securite::secureHTML($_POST['nouveauPassword']);
                            $confirmationNouveauPassword = Securite::secureHTML($_POST['confirmNouveauPassword']);
                            $utilisateurController->validation_modificationPassword($ancienPassword, $nouveauPassword, $confirmationNouveauPassword);
                        } else {
                            Toolbox::ajouterMessageAlerte("Vous n'avez pas renseigné toutes les informations", Toolbox::COULEUR_ROUGE);
                            header("Location: " . URL . "compte/modificationPassword");
                        }
                        break;
                         case "suppressionCompte" : $utilisateurController->suppressionCompte();
                                            break;
                    default:
                        throw new Exception("La page n'existe pas");
                }
            }
            break;
        default:
            throw new Exception("La page n'existe pas");
    }
} catch (Exception $e) {
    $visiteurController->pageErreur($e->getMessage());
}
