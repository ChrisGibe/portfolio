<?php

function dd($data)
{
    echo '<br><br><br><br><br><br><br><pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function the_custom_excerpt($text, $length = 0)
{
    $length = $length ?: 250;

    echo get_custom_excerpt($text, $length);
}

function get_custom_excerpt($text, $length = 0)
{
    if (!$text) {
        return;
    }

    $length = $length ?: 250;

    $text = wp_strip_all_tags($text, true);

    $return = $text;

    if (strlen($text) > $length) {
        $return = substr($text, 0, strpos($text, ' ', $length));
    }

    return $return;
}

function formatBytes($size, $precision = 2)
{
    $base = log($size, 1024);
    $suffixes = array('', 'Ko', 'Mo', 'Go', 'To');

    return round(pow(1024, $base - floor($base)), $precision) . $suffixes[floor($base)];
}