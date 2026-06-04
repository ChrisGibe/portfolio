<div class="wrap">
    <h1><?php echo __('Write Mate Settings', 'write-mate') ?></h1>
    <form method="post" action="options.php">
        <?php settings_fields( 'write-mate-settings-group' ); ?>
        <?php do_settings_sections( 'write-mate-settings-group' ); ?>
        <table class="form-table">
            <tr>
                <th scope="row"><?php echo __('API Key', 'write-mate') ?></th>
                <td><input type="text" name="write_mate_api_key" value="<?php echo esc_attr( get_option( 'write_mate_api_key' ) ); ?>"></td>
            </tr>
            <tr>
                <th scope="row"><?php echo __('Display on Posts Type', 'write-mate') ?> :</th>
            </tr>
            <?php
                $post_types = get_post_types( array( 'public' => true ), 'objects' );
                foreach ( $post_types as $post_type ) {
                    if($post_type->name != 'attachment') {
                        echo '<tr>
                                <th scope="row">' . $post_type->labels->name . '</th>
                                <td><input type="checkbox" name="' . 'write_mate_' . $post_type->name . '" value="1" ' . checked(1, get_option('write_mate_' . $post_type->name), false) . ' /></td>
                              </tr>';
                    }
                }
            ?>
        </table>
        <?php submit_button(); ?>
    </form>
</div>