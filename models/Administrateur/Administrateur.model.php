<?php
require_once("./models/MainManager.model.php");

class AdministrateurManager extends MainManager
{
    public function getUtilisateurs()
    {
        $req = $this->getBdd()->prepare("SELECT is_valid,nom_user,prenom_user,role.nom_role as id_role FROM user inner join role on user.id_role-role.id_role");
        $req->execute();
        $datas = $req->fetchAll(PDO::FETCH_ASSOC);
        $req->closeCursor();
        return $datas;
    }
}
