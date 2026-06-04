<?php

/**
 * Easily declare a gutenberg block
 */
function block($title, $filename, $category, $icon = null, $tags = [])
{
    if (file_exists(get_template_directory() .'/acf/fields/' . $filename . '.php')) {
        //initialise le champs ACF
        require_once(get_template_directory() . '/acf/fields/' . $filename . '.php');
    }

    //initialise block gutenberg ACF
    acf_register_block_type([
        'name' => basename($filename),
        'title' => $title,
        'description' => '',
        'render_template' => get_template_directory() . '/acf/blocks/' . $filename . '.php',
        'category' => $category,
        'icon' => $icon,
        'keywords' => $tags,
        'supports' => [
            'align' => false,
            'anchor' => true,
        ],
        'example' => [
            'attributes' => [
                'mode' => 'preview',
                'data' => ['is_preview' => true]
            ]
        ]
    ]);
}

/**
 * Access a theme option without querying the database each time
 */
function option($key, $default = null)
{
    static $options;

    if (!$options) {
        $options = get_fields('option');
    }

    return $options[$key] ?? $default;
}

/**
 * Bidirectional acf relations
 * @see https://www.advancedcustomfields.com/resources/bidirectional-relationships/
 */
function acf_sync_fields($value, $post_id, $field)
{
    $field_name = $field['name'];
    $field_key = $field['key'];
    $global_name = 'is_updating_' . $field_name;
    if (!empty($GLOBALS[$global_name])) {
        return $value;
    }

    $GLOBALS[$global_name] = 1;

    // Add
    if (is_array($value)) {
        foreach ($value as $post_id2) {
            $value2 = get_field($field_name, $post_id2, false);
            if (empty($value2)) {
                $value2 = array();
            }
            if (in_array($post_id, $value2)) {
                continue;
            }
            $value2[] = $post_id;
            update_field($field_key, $value2, $post_id2);
        }
    }

    // Remove
    $old_value = get_field($field_name, $post_id, false);
    if (is_array($old_value)) {
        foreach ($old_value as $post_id2) {
            if (is_array($value) && in_array($post_id2, $value)) {
                continue;
            }
            $value2 = get_field($field_name, $post_id2, false);
            if (empty($value2)) {
                continue;
            }
            $pos = array_search($post_id, $value2);
            unset($value2[$pos]);
            update_field($field_key, $value2, $post_id2);
        }
    }

    $GLOBALS[$global_name] = 0;

    return $value;
}

add_filter('acf/fields/wysiwyg/toolbars', function ($toolbars) {

    $toolbars['ADN Mini'][1] = ['bold', 'italic', 'underline', 'forecolor'];

    // Register a basic toolbar with a single row of options
    $toolbars['ADN Simplify'][1] = ['formatselect', 'bold', 'italic', 'underline', 'forecolor', 'link', 'unlink'];

    // Register another toolbar, this time with two rows of options.
    $toolbars['ADN Advanced'][1] = ['formatselect', 'bold', 'italic', 'underline', 'strikethrough', 'forecolor', 'wp_adv'];
    $toolbars['ADN Advanced'][2] = ['bullist', 'numlist', 'alignleft', 'aligncenter', 'alignright'];


    return $toolbars;
});