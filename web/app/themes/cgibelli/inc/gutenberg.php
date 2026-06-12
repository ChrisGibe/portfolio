<?php

/**
 * Hide non-acf blocks
 */
add_filter('allowed_block_types_all', function ($allowed_block_types, $block_editor_context) {
    return array_merge(['core/block', 'core/html'], array_keys(acf_get_block_types()));
}, 10, 2);

/**
 * Define blocks categories
 */
add_filter('block_categories_all', function ($block_categories, $editor_context) {
    return array_merge($block_categories, [
        [
            'slug'  => 'hp',
            'title' => 'HP',
            'icon'  => null,
        ], [
            'slug'  => 'posts',
            'title' => 'Articles',
            'icon'  => null,
        ], [
            'slug'  => 'events',
            'title' => 'Evenements',
            'icon'  => null,
        ], [
            'slug'  => 'speakers',
            'title' => 'Intervenants',
            'icon'  => null,
        ],  [
            'slug'  => 'medias',
            'title' => 'Médias',
            'icon'  => null,
        ], [
            'slug'  => 'content',
            'title' => 'Contenu',
            'icon'  => null,
        ],
    ]);
}, 10, 2);
