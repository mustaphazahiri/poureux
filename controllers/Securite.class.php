<?php

class Securite
{
    public const COOKIE_NAME = "timers";

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
    public static function genererCookieConnexion()
    {
        $ticket = session_id() . microtime() . rand(0, 999999);
        $ticket = hash("sha512", $ticket);
        setcookie(self::COOKIE_NAME, $ticket, time() + (60 * 20));
        $_SESSION['profil'][self::COOKIE_NAME] = $ticket;
    }
    public static function checkCookieConnexion()
    {
        return $_COOKIE[self::COOKIE_NAME] === $_SESSION['profil'][self::COOKIE_NAME];
    }
}
