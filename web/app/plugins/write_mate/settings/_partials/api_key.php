<?php

// Register API Key in the plugin settings
function write_mate_register_settings() {
    register_setting( 'write-mate-settings-group', 'write_mate_api_key' );
}
add_action( 'admin_init', 'write_mate_register_settings' );