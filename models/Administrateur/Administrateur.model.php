<?php
require_once("./models/MainManager.model.php");

class AdministrateurManager extends MainManager
{
    public function getUtilisateurs()
    {
        $req = $this->getBdd()->prepare("SELECT nom_user, prenom_user, adresse, cp, ville, telephone, is_valid, role.nom_role from user 
            INNER JOIN user_role on user.id_user = user_role.id_user
            INNER JOIN role ON user_role.id_role = role.id_role");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }
    public function bdModificationRoleUser($login, $id_role)
    {
        $req = "UPDATE user set id_role = :id_role WHERE email = :login";
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":id_role", $id_role, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }

    public function bdActivationCompte($login, $is_valid)
    {
        $req = "UPDATE user set is_valid = :is_valid WHERE email = :login"; //UPDATE `user` SET `is_valid` = '1' WHERE `user`.`id_user` = 29;
        $stmt = $this->getBdd()->prepare($req);
        $stmt->bindValue(":login", $login, PDO::PARAM_STR);
        $stmt->bindValue(":is_valid", $is_valid, PDO::PARAM_STR);
        $stmt->execute();
        $estModifier = ($stmt->rowCount() > 0);
        $stmt->closeCursor();
        return $estModifier;
    }
}
