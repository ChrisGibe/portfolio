<?php


/**
 *  load chatbot script
 **/
function init_write_mate_view()
{
    if(!empty(get_option( 'write_mate_api_key' ) )) {

        $script_url = plugins_url( 'assets/dist/index.js' , __DIR__ );
        $css_url = plugins_url( 'assets/dist/index.css' , __DIR__ );

        echo '
            <script>const apiKey = \'' . esc_html(get_option('write_mate_api_key')) . '\'</script>
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
            <script type="module" crossorigin src="'. $script_url .'"></script>
            <link rel="stylesheet" href="'. $css_url .'">
        ';
    }
}

/**
 *  add chatbot
 **/
function init_write_mate_script(){
    if(!empty(get_option( 'write_mate_api_key' ) )) {
        echo "
            <script>
                var elemDiv = document.createElement('div');
                elemDiv.setAttribute('id', 'chat_app');
                jQuery('#wpwrap').append(elemDiv);                
            </script>
        ";
    }
}

/**
 *  global init
 **/
add_action( 'admin_init', 'init_write_mate_admin' );
function init_write_mate_admin() {

    $allowed_post_types = array();
    $post_types = get_post_types( array( 'public' => true ), 'objects' );
    foreach ( $post_types as $post_type ) {
        if((int)get_option('write_mate_'.$post_type->name) === 1){
            $allowed_post_types[] = $post_type->name;
        }
    }

    // If post type allowed to dispaly chatbox
    global $pagenow;
    if ('post.php' === $pagenow && isset($_GET['post']) && in_array(get_post_type( $_GET['post'] ), $allowed_post_types, true) ){
        add_action('admin_head', 'init_write_mate_view');
        add_action('admin_footer', 'init_write_mate_script');
    }elseif('post-new.php' === $pagenow && isset($_GET['post_type']) && in_array($_GET['post_type'], $allowed_post_types, true) ){
        add_action('admin_head', 'init_write_mate_view');
        add_action('admin_footer', 'init_write_mate_script');
    }elseif('post-new.php' === $pagenow && !isset($_GET['post_type']) && in_array('post', $allowed_post_types, true)){
        add_action('admin_head', 'init_write_mate_view');
        add_action('admin_footer', 'init_write_mate_script');
    }
}