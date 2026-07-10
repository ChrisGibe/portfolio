<?php

add_action('wp_ajax_filter_search', 'filter_search');
add_action('wp_ajax_nopriv_filter_search', 'filter_search');

function filter_search()
{

    $list_post_type = ($_REQUEST['post_ctp_list']) ? decodeArrayResponce($_REQUEST['post_ctp_list']) : [];

    if (!empty($list_post_type)) {
        foreach ($list_post_type as $key => $item) {
            unset($list_post_type[$key]);
            $list_post_type[$item] = $item;
        }
    }

    $lang = ($_REQUEST['lang']) ?? 'fr';

    global $sitepress;
    if ($lang && $sitepress) {
        $sitepress->switch_lang($lang);
    }

    $search_term = sanitize_text_field($_REQUEST['search_term']);
    $page = $_REQUEST['page'];
    // $filter_taxo = $_REQUEST['taxo'];
    $filter_by = $_REQUEST['filter_by'];
    $filter_post_type = ($_REQUEST['post_type']) ?: $list_post_type;
    $posts_per_page = 8;

    // $filter_taxo = decodeArrayResponce($filter_taxo);


    $args = [
        'post_type' => $filter_post_type,
        'post_status' => 'publish',
        's' => $search_term,
        'excerpt' => $search_term,
        'paged' => ($page) ?: 1,
        'posts_per_page' => ($posts_per_page) ?: 9,
    ];

    /* if ($filter_taxo) {
         $count = count($filter_taxo);

         if ($count > 1) {
             $args['tax_query'] = [
                 'relation' => 'AND',
             ];
         }

         foreach ($filter_taxo as $key => $taxo) {

             $args['tax_query'][] = [
                 'taxonomy' => $key,
                 'field' => 'slug',
                 'terms' => $taxo,
                 'operator' => 'IN'
             ];

         }
     }*/

    if ($filter_by === 'desc') {
        $args += [
            'orderby' => 'post_date',
            'order' => 'DESC'
        ];
    }

    if ($filter_by === 'asc') {
        $args += [
            'orderby' => 'post_date',
            'order' => 'ASC'
        ];
    }

    $query = new WP_Query($args);

    $posts = [
        'post_total' => ($query->found_posts) ?: 0,
        'page_total' => ($query->max_num_pages) ?: 0,
        'page_current' => (int)($page) ?: 1,
    ];

    while ($query->have_posts()) {
        $query->the_post();
        $post_id = get_the_ID();
        //$terms_list = formatTaxoForViewSearch($post_id, $taxo_show_on_card);
        $post_info = get_post_type_object(get_post_type());
        $post_type_label = ($post_info) ? $post_info->labels->singular_name : null;

        $posts["lists"][] = [
            'title' => get_the_title(),
            'content' => get_custom_excerpt(get_the_excerpt(), 300),
            'link' => get_the_permalink(),
            'date_publication' => get_the_date('d.m.Y'),
            'image' => get_the_post_thumbnail_url($post_id, 'large'),
            'type_content' => $post_type_label,
        ];
    }

    wp_send_json($posts, 200);
    exit();
}


function formatTaxoForViewSearch($post_id, $slug_taxo)
{

    $taxo = '';
    $terms = ($slug_taxo) ? wp_get_post_terms($post_id, $slug_taxo) : [];

    if ($terms) {
        foreach ($terms as $term) {
            $taxo = __($term->name);
        }

        return $taxo;
    }

    return '';

}

add_filter(
    'acf/load_field/key=field_641c64736ba69',
    'acfLoadSeFieldChoicesPostTypeQuery');

function acfLoadSeFieldChoicesPostTypeQuery($field)
{

    $filter_post_type = get_post_types(['public' => true], 'object');

    foreach ($filter_post_type as $post_type) {
        $field['choices'] += [
            $post_type->name => __($post_type->label)
        ];
    }

    return $field;
}


function decodeArrayResponce($data)
{
    if ($data) {
        $data = json_decode(stripslashes($data), false, 512, JSON_THROW_ON_ERROR);

        if (is_object($data)) {
            return (array)$data;
        }
        if (is_array($data)) {
            return (array)$data;
        }
    }

    return [];
}

function generateFilterSearch($fields)
{

    $taxs = get_object_taxonomies('post');

    $args = ['public' => true];
    $filter_post_type = get_post_types($args, 'object');
    $list_filter_post_type = [];

    foreach ($filter_post_type as $key => $post_type) {
        if (in_array($post_type->name, $fields['post_type'], true)) {
            $list_filter_post_type[] = [
                'name' => __($post_type->label, 'cgibelli'),
                'slug' => $post_type->name
            ];
        }
    }

    $array_post_type[] = [
        'name' => __('Type de contenu'),
        'slug' => 'post_type',
        'list' => $list_filter_post_type
    ];

    $array_taxo = [];

    foreach ($taxs as $key => $slug) {
        //taxo a ne pas afficher
        if ($slug === 'post_format' || $slug === 'category') {
            continue;
        }

        $args = ['name' => $slug];
        $taxo = get_taxonomies($args, 'objects');
        $terms = get_terms($slug);

        if ($terms) {
            $array_taxo[$key]['name'] = $taxo[$slug]->label ?? '';
            $array_taxo[$key]['slug'] = $slug ?? '';

            foreach ($terms as $i => $term) {
                $array_taxo[$key]['list'][$i]['slug'] = $term->slug;
                $array_taxo[$key]['list'][$i]['name'] = __($term->name, 'cgibelli');
            }
        }
    }

    $array_filter_by[] = [
        'name' => __('Trier par'),
        'slug' => 'filter_by',
        'list' => [
            [
                'slug' => 'desc',
                'name' => __('décroissant', 'cgibelli'),
            ],
            [
                'slug' => 'asc',
                'name' => __('croissant', 'cgibelli'),
            ]

        ]
    ];

    return [
        'post_type' => $array_post_type,
        'taxo' => array_values($array_taxo),
        'filter_by' => $array_filter_by,
    ];

}
