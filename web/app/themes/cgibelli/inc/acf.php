<?php

/**
 * Autosave definitions as json files for syncing
 * Not a good method for website hosted on LBN
 */
add_filter('acf/settings/save_json', 'saveJson');

/**
 * load acf json file
 */
add_filter('acf/settings/load_json', 'loadJson');

function saveJson($path)
{
    return get_stylesheet_directory() . '/acf/fields';
}

function loadJson($paths)
{
    unset($paths[0]);
    $paths[] = get_stylesheet_directory() . '/acf/fields';
    return $paths;
}

add_action('acf/init', function () {

    /**
     * Register Gutenberg blocks
     */
    require_once get_template_directory() . '/acf/global_blocs.php';

    /**
     * Register Option page
     */
    acf_add_options_page([
        'page_title' => __('Theme Options', 'cgibelli'),
        'menu_slug' => 'theme-options',
        'parent_slug' => 'themes.php',
        'capability' => 'edit_posts',
        'redirect' => false
    ]);

    /**
     * Register ACF option field
     */

    require_once get_template_directory() . '/acf/fields/theme-option/logo.php';
});


add_filter('acf/fields/wysiwyg/toolbars', function ($toolbars) {

    // Register a basic toolbar with a single row of options
    $toolbars['ADN Simplify'][1] = ['formatselect', 'bold', 'italic', 'underline', 'forecolor', 'link', 'unlink'];

    // Register another toolbar, this time with two rows of options.
    $toolbars['ADN Advanced'][1] = ['formatselect', 'bold', 'italic', 'underline', 'strikethrough', 'forecolor', 'wp_adv'];
    $toolbars['ADN Advanced'][2] = ['bullist', 'numlist', 'alignleft', 'aligncenter', 'alignright'];

    return $toolbars;
});