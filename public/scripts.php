<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
add_action( 'wp_enqueue_scripts', 'bldpst_enqueue_block_scripts' );
function bldpst_enqueue_block_scripts() {
	wp_enqueue_style( 'bldpst-public-style', BLDPST_PL_URL . 'public/assets/css/public.css', array(), BLDPST_VERSION );
}