<?php

/**
 * Remove WPML generator meta tag on front
 */
add_action('after_setup_theme', function () {
    if (!empty($GLOBALS['sitepress'])) {
        global $sitepress;
        remove_action('wp_head', [$sitepress, 'meta_generator_tag']);
    }
});
