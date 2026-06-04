<?php

/**
 * Register menu locations
 */
add_action('after_setup_theme', function () {
    register_nav_menus([
        'secondary' => esc_html__('Secondary', 'teq-theme'),
        'navigation' => esc_html__('Navigation', 'teq-theme'),
        'social-link' => esc_html__('Social Link', 'teq-theme'),
        'footer' => esc_html__('Footer', 'teq-theme'),
        'sub-footer' => esc_html__('Sub-Footer', 'teq-theme'),
        'links' => esc_html__('Links', 'teq-theme'),
    ]);
});
