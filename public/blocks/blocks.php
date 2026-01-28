<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;

}

require_once BLDPST_PL_PATH . 'admin/blocks.php';

add_action( 'enqueue_block_assets', 'bldpst_enqueue_block_styles' );
function bldpst_enqueue_block_styles() {
	

    // if swier not existing
	if (!wp_style_is('swiper-css', 'enqueued')) {
		wp_enqueue_style( 'swiper-css', BLDPST_PL_URL . 'assets/lib/swiper/swiper-bundle.min.css', array(), BLDPST_VERSION, 'all' );
	}
	if (!wp_script_is('swiper-js', 'enqueued')) {
		wp_enqueue_script( 'swiper-js', BLDPST_PL_URL . 'assets/lib/swiper/swiper-bundle.min.js', array(),'12.0.3',false );
	}

    // register plugin style if not registered	
	if (!wp_style_is('bldpst-public-style', 'registered')) {
		wp_register_style( 
			'bldpst-public-style', 
			BLDPST_PL_URL . 'public/assets/css/public.css', 
			array(), 
			BLDPST_VERSION 
		);
	}

    
}

$bldpst_blocks_instance = Bold_Post_Blocks::instance();
$bldpst_blocks = $bldpst_blocks_instance->get_blocks();

foreach ($bldpst_blocks as $bldpst_block) {
	if ($bldpst_block['status'] == 'disable') {
		continue;
	}
	require_once __DIR__ . '/' . $bldpst_block['id'] . '/' . $bldpst_block['id'] . '.php';
}
