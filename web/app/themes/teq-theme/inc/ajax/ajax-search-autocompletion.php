<?php

add_action('wp_ajax_filter_search_autocompletion', 'filter_search_autocompletion');
add_action('wp_ajax_nopriv_filter_search_autocompletion', 'filter_search_autocompletion');

function filter_search_autocompletion()
{

    $list_post_type = $_REQUEST['post_ctp_list'];
    $list_post_type = decodeArrayResponce($list_post_type);

    foreach ($list_post_type as $key => $item) {
        unset($list_post_type[$key]);
        $list_post_type[$item] = $item;
    }

    $lang = ($_REQUEST['lang']) ?? 'fr';

    global $sitepress;
    if ($lang && $sitepress) {
        $sitepress->switch_lang($lang);
    }


    $search_term = sanitize_text_field($_REQUEST['search_term']);
    $filter_post_type = ($_REQUEST['post_type']) ?: $list_post_type;
    $posts_per_page = 4;


    $args = [
        'post_type' => $filter_post_type,
        'post_status' => 'publish',
        's' => $search_term,
        'excerpt' => $search_term,
        'paged' => 1,
        'posts_per_page' => $posts_per_page,
    ];

    $query = new WP_Query($args);

    $posts["lists"] = [];

    while ($query->have_posts()) {
        $query->the_post();

        $posts["lists"][] = [
            'title' => get_the_title(),
            'link' => get_the_permalink(),
        ];
    }

    wp_send_json($posts, 200);
    exit();
}
