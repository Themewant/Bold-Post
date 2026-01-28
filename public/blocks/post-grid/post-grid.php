<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function bldpst_create_block_post_grid_block_init() {
	// Register block-specific styles manually to be sure
	wp_register_style(
		'bldpst-post-grid-style',
		plugins_url( 'build/style-index.css', __FILE__ ),
		array('bldpst-public-style'),
		BLDPST_VERSION
	);

	register_block_type( __DIR__ . '/build', array(
		'style'         => 'bldpst-post-grid-style',
		'editor_style'  => 'bldpst-post-grid-style',
	) );
}
add_action( 'init', 'bldpst_create_block_post_grid_block_init' );
