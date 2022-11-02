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
    public function bdCreerCompte($login, $passwordCrypte, $nom_user, $prenom_user, $adresse, $cp, $ville, $telephone, $facebook, $clef, $id_role)
    {

        $req = "INSERT INTO user (nom_user, prenom_user, email, password, adresse, cp,ville, telephone,facebook,is_valid,clef,id_role) VALUES (:nom,:prenom,:login,:password, :adresse, :cp,:ville, :telephone, :facebook,0,:clef,:id_role) ";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":nom", $nom_user, PDO::PARAM_STR);
        $stmt->bindValue(":prenom", $prenom_user, PDO::PARAM_STR);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $passwordCrypte, PDO::PARAM_STR);
        $stmt->bindValue(":adresse", $adresse, PDO::PARAM_STR);
        $stmt->bindValue(":cp", $cp, PDO::PARAM_INT);
        $stmt->bindValue(":ville", $ville, PDO::PARAM_STR);
        $stmt->bindValue(":telephone", $telephone, PDO::PARAM_STR);
        $stmt->bindValue(":facebook", $facebook, PDO::PARAM_INT);
        $stmt->bindValue(":clef", $clef, PDO::PARAM_INT);
        $stmt->bindValue(":id_role", $id_role, PDO::PARAM_INT);
        $stmt->execute();
        $isModified = ($stmt->rowcount() > 0);
        $stmt->closeCursor();
        return $isModified;
    }
    public function joinRoleUser($id_role)
    {
        $req = "INSERT INTO `user_role`(`id_role`, `id_user`) VALUES (:id_role,)";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":id_role", $id_role, PDO::PARAM_INT);
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
    public function bdValidationMailCompte($login, $clef)
    {
        $req = "UPDATE user set is_valid =1 where email= :login and clef= :clef";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":clef", $clef, PDO::PARAM_INT);
        $stmt->execute();
        $isModified = ($stmt->rowcount() > 0);
        $stmt->closeCursor();
        return $isModified;
    }
    public function bdModificationMailUser($login, $mail)
    {
        $req = "UPDATE user set email  WHERE email = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":mail", $mail, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
    public function bdModificationPassword($login, $password)
    {
        $req = "UPDATE user set password = :password WHERE email = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":password", $password, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
    public function bdSuppressionCompte($login)
    {
        $req = "DELETE FROM user WHERE email = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
}
