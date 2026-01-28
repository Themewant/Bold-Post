<?php
/**
 * Plugin Name: Bold Post
 * Description: Bold Post Plugin, post display plugin for gutenberg, elementor and bricks builder.
 * Plugin URI:  https://themewant.com/downloads/bold-post/
 * Author:      Themewant
 * Author URI:  http://themewant.com/
 * Version:     1.0.0
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: bold-post
 * Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'BLDPST_VERSION', '1.0.0' );
define( 'BLDPST_PL_ROOT', __FILE__ );
define( 'BLDPST_PL_URL', plugins_url( '/', BLDPST_PL_ROOT ) );
define( 'BLDPST_PL_PATH', plugin_dir_path( BLDPST_PL_ROOT ) );
define( 'BLDPST_DIR_URL', plugin_dir_url( BLDPST_PL_ROOT ) );
define( 'BLDPST_PLUGIN_BASE', plugin_basename( BLDPST_PL_ROOT ) );

require_once BLDPST_PL_PATH . 'class.bold-post.php';
require_once BLDPST_PL_PATH . 'public/blocks/blocks.php';
require_once BLDPST_PL_PATH . 'editor/index.php';

register_activation_hook( __FILE__, array( 'Bold_Post', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Bold_Post', 'deactivate' ) );