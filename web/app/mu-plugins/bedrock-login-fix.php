<?php
/*
Plugin Name: Fix Bedrock Admin Redirect
*/

// Intercepte l'accès à wp-admin si non connecté pour éviter la redirection vers /wp/wp-login.php
add_action('wp_loaded', function () {
    global $pagenow;
    
    // Si on essaie d'accéder à l'admin et qu'on n'est pas connecté
    if (is_admin() && !is_user_logged_in() && !wp_doing_ajax() && $pagenow !== 'wp-login.php') {
        $redirect = urlencode($_SERVER['REQUEST_URI']);
        wp_redirect(home_url('/wp-login.php?redirect_to=' . $redirect));
        exit;
    }
});

// Force toutes les URLs de login générées par WP à pointer sur la racine web
add_filter('site_url', function ($url, $path, $scheme) {
    if ($path === 'wp-login.php' || $path === 'wp-login.php?') {
        return home_url('/wp-login.php');
    }
    return $url;
}, 99, 3);