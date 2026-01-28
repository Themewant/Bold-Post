<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function bldpst_create_block_category_list_block_init() {
	// Register block-specific styles
	wp_register_style(
		'bldpst-category-list-style',
		plugins_url( 'build/style-index.css', __FILE__ ),
		array('bldpst-public-style'),
		BLDPST_VERSION
	);

	register_block_type( __DIR__ . '/build', array(
		'style'         => 'bldpst-category-list-style',
		'editor_style'  => 'bldpst-category-list-style',
	) );
}
add_action( 'init', 'bldpst_create_block_category_list_block_init' );
