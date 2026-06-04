<?php

/**
 * Prevents cache generation on non-prod envs
 */
if (defined('WP_ENV') && WP_ENV !== 'production') {
    add_filter('do_rocket_generate_caching_files', '__return_false');
}

/**
 * Enables admin users to purge cache
 * @see web/app/plugins/wp-rocket/inc/Engine/Capabilities/Manager.php
 */
add_action('init', function () {
    $role = get_role('administrator');
    $role->add_cap('rocket_purge_posts', true);
    $role->add_cap('rocket_purge_cache', true);
    $role->add_cap('rocket_manage_options', true);
}, 12);
