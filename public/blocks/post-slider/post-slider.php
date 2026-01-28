<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

function bldpst_create_block_post_slider_block_init() {
	// Register block-specific styles manually to be sure
	wp_register_style(
		'bldpst-post-slider-style',
		plugins_url( 'build/style-index.css', __FILE__ ),
		array('bldpst-public-style'),
		BLDPST_VERSION
	);

	register_block_type( __DIR__ . '/build', array(
		'style'         => 'bldpst-post-slider-style',
		'editor_style'  => 'bldpst-post-slider-style',
	) );
}
add_action( 'init', 'bldpst_create_block_post_slider_block_init' );