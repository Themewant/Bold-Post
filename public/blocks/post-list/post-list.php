<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function bldpst_create_block_post_list_block_init() {
	// Register block-specific styles manually to be sure
	wp_register_style(
		'bldpst-post-list-style',
		plugins_url( 'build/style-index.css', __FILE__ ),
		array('bldpst-public-style'),
		BLDPST_VERSION
	);

	register_block_type( __DIR__ . '/build', array(
		'style'         => 'bldpst-post-list-style',
		'editor_style'  => 'bldpst-post-list-style',
	) );
}
add_action( 'init', 'bldpst_create_block_post_list_block_init' );
