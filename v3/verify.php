<?php
if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $secret = "6Lek9UkjAAAAAAJC7cuIL80FK-LErmSn-g1zT9dw";
    $response = htmlspecialchars($_POST['g-recaptcha-response']);
    $remoteip = $_SERVER['REMOTE_ADDR'];
    $request = "https://www.google.com/recaptcha/api/siteverify?secret=$secret&response=$response&remoteip=$remoteip";

    $get = file_get_contents($request);
    $decode = json_decode($get, true);

    if ($decode['success'])
        echo "Ok";
    else
        echo "Error";
}
