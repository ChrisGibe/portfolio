<?php

// Register post type in the plugin settings
function write_mate_register_settings_form() {

    $post_types = get_post_types( array( 'public' => true ), 'objects' );
    foreach ( $post_types as $post_type ) {
        if($post_type->name != 'attachment'){
            register_setting('write-mate-settings-group', 'write_mate_'.$post_type->name);
        }
    }
}
add_action( 'admin_init', 'write_mate_register_settings_form' );