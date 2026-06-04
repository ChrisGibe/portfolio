<?php

/**
 * A parent/child array tree for a menu location
 */
function menu($location)
{
    $locations = get_nav_menu_locations();
    if (!array_key_exists($location, $locations)) {
        return [];
    }

    $menu = wp_get_nav_menu_object($locations[$location]);
    if (empty($menu)) {
        return [];
    }

    $items = wp_get_nav_menu_items($menu->term_id);

    return !empty($items) ? buildTree($items, 0) : [];
}

/**
 * Get WP object menu
 */
function wp_get_menu_by_location($location){
    $locations = get_nav_menu_locations();
    if ( ! array_key_exists( $location, $locations ) ) {
        return [];
    }

    $menu = wp_get_nav_menu_object( $locations[ $location ] );
    if ( empty( $menu ) ) {
        return [];
    }

    return $menu;
}


/**
 * Builds the menu recursively according to parent/child menu order
 * @internal
 */
function buildTree(array &$elements, $parentId = 0)
{
    $branch = [];
    foreach ($elements as &$element) {
        if ($element->menu_item_parent == $parentId) {
            $children = buildTree($elements, $element->ID);
            if ($children) {
                $element->children = $children;
            }

            $branch[$element->menu_order] = $element;
            unset($element);
        }
    }
    return $branch;
}
