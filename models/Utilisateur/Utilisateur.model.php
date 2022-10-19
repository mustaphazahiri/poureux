<?php
require_once("./models/MainManager.model.php");

class UtilisateurManager extends MainManager
{

    private function getPasswordUser($login)
    {
        $req = "SELECT password FROM user WHERE email = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat['password'];
    }

    public function isCombinaisonValide($login, $password)
    {
        $passwordBD = $this->getPasswordUser($login);
        // echo $passwordBD;
        return password_verify($password, $passwordBD);
    }

    public function estCompteActive($login)
    {
        $req = "SELECT is_valid FROM user WHERE email = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return ((int)$resultat['is_valid'] === 1);
    }
    public function getUserInformation($login)
    {
        $req = "SELECT * FROM user WHERE email = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $resultat = $stmt->fetch(PDO::FETCH_ASSOC);
        $stmt->closeCursor();
        return $resultat;
    }
    public function bdCreerCompte($login, $passwordCrypte, $nom_user, $prenom_user, $adresse, $cp, $ville, $telephone, $clef)
    {

        $req = "INSERT INTO user (nom_user, prenom_user, email, password, adresse, cp,ville, telephone,facebook,is_valid,clef) VALUES (:nom,:prenom,:login,:password, :adresse, :cp,:ville, :telephone, 0,0,:clef) ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nom", $nom_user, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom_user, PDO::PARAM_STR);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $passwordCrypte, PDO::PARAM_STR);
        $stmt->bindValue(":adresse", $adresse, PDO::PARAM_STR);
        $stmt->bindValue(":cp", $cp, PDO::PARAM_INT);
        $stmt->bindValue(":ville", $ville, PDO::PARAM_STR);
        $stmt->bindValue(":telephone", $telephone, PDO::PARAM_STR);
        $stmt->bindValue(":clef", $clef, PDO::PARAM_INT);
        $stmt->execute();
        $isModified = ($stmt->rowcount() > 0);
        $stmt->closeCursor();
        return $isModified;
    }
    public function isLoginAvailable($login)
    {
        $utilisateur = $this->getUserInformation($login);
        return empty($utilisateur);
    }
}
