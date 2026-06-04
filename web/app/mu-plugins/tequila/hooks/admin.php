<?php

/**
 * Hide admin bar on front
 */
add_filter('show_admin_bar', '__return_false');

/**
 * Hide admin menu items
 */
add_action('admin_init', function () {
    remove_menu_page('edit-comments.php'); // Comments
});

/**
 * Disable default taxonomies: category and tag
 */
add_action('init', function () {
    register_taxonomy('post_tag', []);
    register_taxonomy('category', []);
});
