<?php
// commenter l'appel du fichier si besoin d'utiliser la fontionnalier ou non

require_once __DIR__ . '/inc/dev.php';
require_once __DIR__ . '/inc/acf.php';
require_once __DIR__ . '/inc/assets.php';
require_once __DIR__ . '/inc/gutenberg.php';
require_once __DIR__ . '/inc/menu.php';

// Disable WordPress emoji polyfill (useless on modern browsers)
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');
remove_filter('the_content_feed', 'wp_staticize_emoji');
remove_filter('comment_text_rss', 'wp_staticize_emoji');
remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
add_filter('tiny_mce_plugins', fn($plugins) => is_array($plugins) ? array_diff($plugins, ['wpemoji']) : []);
add_filter('wp_resource_hints', function ($urls, $relation_type) {
    if ('dns-prefetch' === $relation_type) {
        $urls = array_diff($urls, [apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/')]);
    }
    return $urls;
}, 10, 2);
