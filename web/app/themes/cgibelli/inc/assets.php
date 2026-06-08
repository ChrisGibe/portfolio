<?php

/**
 * Register theme assets
 */
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('teq-style', mix('/styles/styles.css'), [], '');
    /*
    wp_enqueue_script('teq-script-manifest', mix('/scripts/manifest.js'), [], '', true);
    wp_enqueue_script('teq-script-vendor', mix('/scripts/vendor.js'), ['teq-script-manifest'], '', true);
    */
    wp_enqueue_script('teq-script-app', mix('/scripts/app.js'), '', '', true);
});

add_action('wp_head', function () {
    $path = get_theme_file_uri('/assets/images/favicons/cgibelli');
    $prefix = strtoupper('cgibelli') . '_'; ?>
    <link rel="apple-touch-icon" sizes="57x57" href="<?= $path . '/' . $prefix . 'apple-icon-57x57.png'; ?>">
    <link rel="apple-touch-icon" sizes="60x60" href="<?= $path . '/' . $prefix . 'apple-icon-60x60.png'; ?>">
    <link rel="apple-touch-icon" sizes="72x72" href="<?= $path . '/' . $prefix . 'apple-icon-72x72.png'; ?>">
    <link rel="apple-touch-icon" sizes="76x76" href="<?= $path . '/' . $prefix . 'apple-icon-76x76.png'; ?>">
    <link rel="apple-touch-icon" sizes="114x114" href="<?= $path . '/' . $prefix . 'apple-icon-114x114.png'; ?>">
    <link rel="apple-touch-icon" sizes="120x120" href="<?= $path . '/' . $prefix . 'apple-icon-120x120.png'; ?>">
    <link rel="apple-touch-icon" sizes="144x144" href="<?= $path . '/' . $prefix . 'apple-icon-144x144.png'; ?>">
    <link rel="apple-touch-icon" sizes="152x152" href="<?= $path . '/' . $prefix . 'apple-icon-152x152.png'; ?>">
    <link rel="apple-touch-icon" sizes="180x180" href="<?= $path . '/' . $prefix . 'apple-icon-180x180.png'; ?>">
    <link rel="icon" type="image/png" sizes="192x192" href="<?= $path . '/' . $prefix . 'android-icon-192x192.png'; ?>">
    <link rel="icon" type="image/png" sizes="32x32" href="<?= $path . '/' . $prefix . 'favicon-32x32.png'; ?>">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= $path . '/' . $prefix . 'favicon-96x96.png'; ?>">
    <link rel="icon" type="image/png" sizes="16x16" href="<?= $path . '/' . $prefix . 'favicon-16x16.png'; ?>">
    <meta name="msapplication-TileImage" content="<?= $path . '/' . $prefix . 'ms-icon-144x144.png'; ?>">
<?php
}, 99);
