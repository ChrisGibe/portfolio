<?php

/**
 * Reads mix-manifest.json and return the file with hash id for better cache
 */
function mix($path, $directory = '/assets')
{
    static $manifest;

    $path = str_replace($directory, '', '/' . ltrim($path, '/'));

    if (!isset($manifest)) {
        $manifest_path = get_theme_file_path($directory . '/mix-manifest.json');
        if (!file_exists($manifest_path)) {
            return get_current_theme_file_uri($directory . $path);
        }
        $manifest = json_decode(file_get_contents($manifest_path), true);
    }

    if (!array_key_exists($path, $manifest)) {
        return get_current_theme_file_uri($directory . $path);
    }

    $path = '/' . ltrim($manifest[$path], '/');

    return get_current_theme_file_uri($directory . $path);
}


/**
 * Return the file_uri of the current site
 *
 */

function get_current_theme_file_uri($file){

    $uri = get_theme_file_uri($file);

    $uri = str_replace(network_site_url(),get_site_url().'/',$uri);

    return $uri ;
}
