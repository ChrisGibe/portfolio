<?php
$header = option( 'header', [] );
?>

<img class="d-flex" src="<?= get_template_directory_uri(); ?>/assets/images/tequila-ds.svg"
     alt="<?= ! empty( $header['titre'] ) ? $header['titre'] : get_bloginfo( 'name' ); ?>"
     loading="lazy"
/>