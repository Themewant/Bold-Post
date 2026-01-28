<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Bold_Post {
    public static function instance() {
        static $instance = null;
        if ( null === $instance ) {
            $instance = new self();
        }
        return $instance;
    }

    public function __construct() {
        add_action( 'plugins_loaded', array( $this, 'init' ) );
    }

    public function init() {
        // Initialize the plugin
        add_action( 'admin_init', array( $this, 'register_settings' ) );
        add_action( 'admin_menu', array( $this, 'add_menu' ) );
        //add_action( 'admin_menu', array( $this, 'submenus' ) );
        $this->includes();
    }

    public function register_settings() {
        register_setting( 'bold_post_settings', 'bold_post_version', 'sanitize_text_field' );
    }

    public function includes() {
        require_once BLDPST_PL_PATH . 'public/class.helper.php';
        require_once BLDPST_PL_PATH . 'admin/api.php';
        require_once BLDPST_PL_PATH . 'admin/blocks.php';
        require_once BLDPST_PL_PATH . 'editor/featured-posts.php';
        require_once BLDPST_PL_PATH . 'admin/index.php';
        require_once BLDPST_PL_PATH . 'public/scripts.php';
    }

    public function add_menu() {
        add_menu_page(
            'Bold Post',
            'Bold Post',
            'manage_options',
            'bold-post',
            array( $this, 'render_menu_page' ),
            BLDPST_PL_URL . 'public/assets/img/icons/plugin-icon-18_18.svg', // image icon
            26
        );
    }

    public function submenus() {
        add_submenu_page(
            'bold-post',
            'Blocks',
            'Blocks',
            'manage_options',
            'bold-post',
            array( $this, 'render_blocks_page' )
        );
    }

    public function render_menu_page() {
        echo '<div class="bldpst-options-wrap">';
        echo '<div id="bldpst-dashboard"></div>';
        echo '</div>';
    }

    public function render_blocks_page() {
        echo '<div class="bldpst-options-wrap">';
        echo '<div id="bldpst-blocks">Bold Post Blocks</div>';
        echo '</div>';
    }

    public static function activate() {
        update_option( 'bold_post_version', BLDPST_VERSION );
    }

    public static function deactivate() {
        delete_option( 'bold_post_version' );
    }
}

Bold_Post::instance();