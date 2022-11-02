<?php

class Securite
{
    public static function secureHTML($chaine)
    {
        return htmlentities($chaine);
    }
    public static function isConnected()
    {
        return (!empty($_SESSION['profil']));
    }
    public static function estLivreur()
    {
        return ($_SESSION['profil']['id_role'] == 2);
    }
    public static function estCuisinier()
    {
        return ($_SESSION['profil']['id_role'] == 1);
    }
    public static function estAdmin()
    {
        return ($_SESSION['profil']['id_role'] == 3);
    }
}
