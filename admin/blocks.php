<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class Bold_Post_Blocks {
    public static function instance() {
        static $instance = null;
        if ( null === $instance ) {
            $instance = new self();
        }
        return $instance;
    }

    public function __construct() {
        add_action( 'init', array( $this, 'register_blocks' ) );
    }

    public function get_blocks() {
        $blocks = [
            [
                'title'       => 'Post Grid',
                'id'        => 'post-grid',
                'description' => 'Post Grid Block',
                'iconName'        => 'grid.svg',
                'status'      => 'disable',
            ],
            [
                'title'       => 'Post List',
                'id'        => 'post-list',
                'description' => 'Post List Block',
                'iconName'    => 'list.svg',
                'status'      => 'disable',
            ],
            [
                'title'       => 'Post Slider',
                'id'        => 'post-slider',
                'description' => 'Post Slider Block',
                'iconName'        => 'slider.svg',
                'status'      => 'disable',
            ],
            [
                'title'       => 'Category List',
                'id'        => 'category-list',
                'description' => 'Category List Block',
                'iconName'        => 'category.svg',
                'status'      => 'disable',
            ]
        ];

        // Merge status from DB
        foreach ($blocks as &$block) {
            $block['status'] = get_option('bldpst_block_' . $block['id'], 'disable');
        }
        unset($block);
        

        return $blocks;
    }

    public function register_blocks() {
    }


}   