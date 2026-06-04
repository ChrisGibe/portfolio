<?php

// Use CPTUI on local, then commit the files so we can load the config without the plugin on prod!
if (!function_exists('cptui_init')) {
    if (file_exists(get_template_directory() . '/cptui/post_types.php')) {
        require_once get_template_directory() . '/cptui/post_types.php';
    }
    if (file_exists(get_template_directory() . '/cptui/taxonomies.php')) {
        require_once get_template_directory() . '/cptui/taxonomies.php';
    }
}

/**
 * Autosave definitions as json files for syncing and php for production
 * @see https://docs.pluginize.com/article/84-save-cptui-settings-data-to-file
 */
add_action('cptui_after_update_post_type', function ($data = []) {
    // JSON
    $cptui_post_types = get_option('cptui_post_types', []);
    $content = json_encode($cptui_post_types);
    file_put_contents(get_template_directory() . '/cptui/post_type_data.json', $content);

    // PHP
    ob_start();
    cptui_get_post_type_code(cptui_get_post_type_data());
    $code = '<?php ' . ob_get_contents();
    ob_clean();
    file_put_contents(get_template_directory() . '/cptui/post_types.php', $code);
});

add_action('cptui_after_update_taxonomy', function ($data = []) {
    // JSON
    $cptui_taxonomies = get_option('cptui_taxonomies', []);
    $content = json_encode($cptui_taxonomies);
    file_put_contents(get_template_directory() . '/cptui/cptui_taxonomy_data.json', $content);

    // PHP
    ob_start();
    cptui_get_taxonomy_code(cptui_get_taxonomy_data());
    $code = '<?php ' . ob_get_contents();
    ob_clean();
    file_put_contents(get_template_directory() . '/cptui/taxonomies.php', $code);
});
