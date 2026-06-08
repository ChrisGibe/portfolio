<?php

/**
 * Register menu locations
 */
add_action('after_setup_theme', function () {
    register_nav_menus([
        'secondary' => esc_html__('Secondary', 'cgibelli'),
        'navigation' => esc_html__('Navigation', 'cgibelli'),
        'social-link' => esc_html__('Social Link', 'cgibelli'),
        'footer' => esc_html__('Footer', 'cgibelli'),
        'sub-footer' => esc_html__('Sub-Footer', 'cgibelli'),
        'links' => esc_html__('Links', 'cgibelli'),
    ]);
});
