<?php
/*
Plugin Name: HTTP Basic Auth Protection
*/

add_action('init', function () {
    // Cibler uniquement les tentatives d'accès à la page de login ou à l'admin
    global $pagenow;
    if ($pagenow !== 'wp-login.php' && !is_admin()) {
        return;
    }

    // Récupération des identifiants envoyés par le navigateur
    $authUser = $_SERVER['PHP_AUTH_USER'] ?? null;
    $authPw   = $_SERVER['PHP_AUTH_PW'] ?? null;

    // Définir tes identifiants de sécurité
    $validUser = 'TON_UTILISATEUR';
    $validPass = 'TON_MOT_DE_PASSE';

    if ($authUser !== $validUser || $authPw !== $validPass) {
        header('WWW-Authenticate: Basic realm="Zone Protegee"');
        header('HTTP/1.0 401 Unauthorized');
        echo 'Accès refusé.';
        exit;
    }
});