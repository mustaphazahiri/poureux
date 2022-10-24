<?php

use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

require_once "./includes/Exception.php";
require_once "./includes/PHPMailer.php";
require_once "./includes/SMTP.php";

$mail = new PHPMailer(true);

try {
    //Configuration
    $mail->SMTPDebug = SMTP::DEBUG_SERVER; //informations de debug

    //on configure le SMTP
    $mail->isSMTP();
    $mail->Host = "localhost";
    $mail->Port = 1025;

    //charset

    $mail->charSet = "utf-8";

    //destinataires
    $mail->addAddress("xogik15499@imdutex.com");

    //Expediteur
    $mail->setFrom("zahiri1979@gmail.com");

    //contenu

    $mail->Subject = "validation de votre compte";
    $mail->Body = "veuillez cliquer sur le lien afin de valider votre compte.";

    //on envoie

    $mail->send();
    echo "message envoyé with success";
} catch (Exception) {
    echo 'message non envoyé. Erreur: {$mail->ErrorInfo}';
}
