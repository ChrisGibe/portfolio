<?php
// Meta description par page (fallback : extrait, puis description du site)

add_action('wp_head', function () {
    $description = '';

    if (is_singular()) {
        // 1. Champ ACF "meta_description" si renseigné
        if (function_exists('get_field')) {
            $description = (string) get_field('meta_description');
        }
        // 2. Sinon, l'extrait de la page
        if (empty($description) && has_excerpt()) {
            $description = get_the_excerpt();
        }
    }

    // 3. Fallback : description générale du site
    if (empty($description)) {
        $description = get_bloginfo('description');
    }

    if (!empty($description)) {
        $description = trim(wp_strip_all_tags($description));
        printf('<meta name="description" content="%s">' . "\n", esc_attr($description));
    }
}, 1);
