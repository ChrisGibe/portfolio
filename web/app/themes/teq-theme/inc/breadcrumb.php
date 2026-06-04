<?php

if ( function_exists( 'yoast_breadcrumb' ) ) {
	yoast_breadcrumb( '', '' );
	add_filter( 'wpseo_breadcrumb_separator', function ( $separator ) {
		return $separator;
	} );

	function doublee_filter_yoast_breadcrumb_items( $link_output, $link ) {

		$page_permalink = get_permalink();

		if ( $page_permalink !== null && $page_permalink === $link['url'] ) {
			return '<span class="current petrol">' . $link['text'] . '</span>';
		}

		return '<a href="' . $link['url'] . '"><span style="color: black">' . $link['text'] . '</span></a>';
	}

	add_filter( 'wpseo_breadcrumb_single_link', 'doublee_filter_yoast_breadcrumb_items', 10, 2 );



	function doublee_filter_yoast_breadcrumb_output( $output ){

		$from = '<span>';
		$to = '</span>';

		return str_replace( $from, $to, $output );
	}
	add_filter( 'wpseo_breadcrumb_output', 'doublee_filter_yoast_breadcrumb_output' );
}