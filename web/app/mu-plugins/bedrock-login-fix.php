<?php
/*
Plugin Name: Bedrock Login URL Fix
Description: Force l'URL de connexion sur /wp-login.php a la racine web au lieu de /wp/wp-login.php
*/

add_filter('site_url', function ($url, $path, $scheme) {
    if ($path === 'wp-login.php' && ($scheme === 'login' || $scheme === 'login_post' || $scheme === 'relative')) {
        return home_url('/wp-login.php');
    }
    return $url;
}, 10, 3);

add_filter('login_url', function ($login_url, $redirect, $force_reauth) {
    $url = home_url('/wp-login.php');
    if (!empty($redirect)) {
        $url = add_query_arg('redirect_to', urlencode($redirect), $url);
    }
    if ($force_reauth) {
        $url = add_query_arg('reauth', '1', $url);
    }
    return $url;
}, 10, 3);