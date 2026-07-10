<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body id="swup" <?php body_class(is_front_page() ? '-homepage transition-fade' : 'transition-fade'); ?>>
    <?php wp_body_open(); ?>

    <?php get_template_part('template-parts/header'); ?>

        <main class="main clearfix">
