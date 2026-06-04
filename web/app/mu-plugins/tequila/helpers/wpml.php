<?php

/**
 * Languages alternatives for current page
 * @see https://wpml.org/wpml-hook/wpml_active_languages/
 * */
function languages_list()
{
    $languages = apply_filters('wpml_active_languages', null, []);
    foreach ($languages as $key => $language) {
        if ($language['active'] == 1) {
            unset($languages[$key]);
        }
    }

    return $languages;
}

function current_language()
{
    $languages = apply_filters('wpml_active_languages', null, []);
    foreach ($languages as $language) {
        if ($language['active'] == 1) {
            return $language;
        }
    }

    return null;
}
