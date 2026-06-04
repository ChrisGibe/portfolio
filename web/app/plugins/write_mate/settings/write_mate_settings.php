<?php

// Add the settings page to the WordPress admin menu
function write_mate_add_settings_page() {
    add_options_page(
        'Write Mate Settings', // Page title
        'Write Mate', // Menu title
        'manage_options', // Capability required to access the page
        'write-mate-settings', // Page slug
        'write_mate_render_settings_page' // Callback function to render the settings page
    );
}
add_action( 'admin_menu', 'write_mate_add_settings_page' );

// Register API Key in the plugin settings
require_once '_partials/api_key.php';
require_once '_partials/form.php';

// Render the settings page
function write_mate_render_settings_page() {
    require 'views/write_mate_settings_view.php';
}