<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
class Bold_Post_API {
    public static function instance() {
        static $instance = null;
        if ( null === $instance ) {
            $instance = new self();
        }
        return $instance;
    }

    public function __construct() {
        add_action( 'rest_api_init', array( $this, 'register_routes' ) );
    }

    public function register_routes() {
        register_rest_route( 'bldpst/v1', '/update-block-status', array(
            'methods' => 'POST',
            'callback' => array( $this, 'update_block_status' ),
            'permission_callback' => function () {
                return current_user_can('edit_posts'); // or custom capability
            }
        ) );
    }

    public function update_block_status( $request ) {
        $block_id = $request->get_param( 'blockId' );
        $status = $request->get_param( 'status' );


        
        // Update the block status in the database
        update_option( 'bldpst_block_' . $block_id, $status );

        $saved_status = get_option( 'bldpst_block_' . $block_id );
        
        return rest_ensure_response( array( 'status' => 'success', 'saved_status' => $saved_status ) );
    }

}

Bold_Post_API::instance();