<?php

/**
 * Extracted from admin-ajax.php
 */

define('DOING_AJAX', true);

require_once  __DIR__ . '/wp/wp-load.php';

send_origin_headers();

header('X-Robots-Tag: noindex');

//if (!isset($_SERVER['HTTP_X_REQUESTED_WITH']) || strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) !== 'xmlhttprequest') {
//    header('Content-Type: text/html; charset=' . get_option('blog_charset'));
//    wp_die('0', 400);
//}

if (empty($_REQUEST['action'])) {
	wp_send_json_error('0', 400);
}

send_nosniff_header();
nocache_headers();

$action = (isset($_REQUEST['action'])) ? $_REQUEST['action'] : '';

$lang = (isset($_REQUEST['wpml_lang'])) ? $_REQUEST['wpml_lang'] : '';
if (!empty($lang)) {
	global $sitepress;
	$sitepress->switch_lang($lang);
}

if (is_user_logged_in()) {
	if (!has_action("wp_ajax_{$action}")) {
		wp_send_json_error('0', 400);
	}

	do_action("wp_ajax_{$action}");
} else {
	if (!has_action("wp_ajax_nopriv_{$action}")) {
		wp_send_json_error('0', 400);
	}

	do_action("wp_ajax_nopriv_{$action}");
}

wp_send_json_error('0');
