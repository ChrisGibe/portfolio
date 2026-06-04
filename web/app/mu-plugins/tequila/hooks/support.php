<?php

/**
 * Basic theme settings
 */
add_action('after_setup_theme', function () {
    add_theme_support('automatic-feed-links');

    add_theme_support('title-tag');

    add_theme_support('post-thumbnails');

    add_theme_support('html5', [
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
    ]);

    remove_theme_support('core-block-patterns');

    add_theme_support('soil', [
        'clean-up',
        'disable-asset-versioning',
        'disable-trackbacks',
        'nav-walker',
    ]);
});
