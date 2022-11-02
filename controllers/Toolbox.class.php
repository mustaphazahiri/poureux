<?php
class Toolbox
{
    public const COULEUR_ROUGE = "alert-danger";
    public const COULEUR_ORANGE = "alert-warning";
    public const COULEUR_VERTE = "alert-success";

    public static function ajouterMessageAlerte($message, $type)
    {
        $_SESSION['alert'][] = [
            "message" => $message,
            "type" => $type
        ];
    }
    // public static function sendMail($destinataire, $sujet, $message)
    // {
    //     $headers = " From: zahiri1979@gmail.com";
    //     if (mail($destinataire, $sujet, $message, $headers)) {
    //         Toolbox::ajouterMessageAlerte("mail envoyé", Toolbox::COULEUR_VERTE);
    //     } else {
    //         Toolbox::ajouterMessageAlerte("echec de l'envoi de mail", Toolbox::COULEUR_ROUGE);
    //     }
    // }
}
