<?php
/**
 * Plugin Name: BoldPost
 * Description: BoldPost Plugin, post display plugin for gutenberg page builder.
 * Plugin URI:  https://themewant.com/downloads/boldpost/
 * Author:      Themewant
 * Author URI:  http://themewant.com/
 * Version:     1.0.5
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: boldpost
 * Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'BOLDPO_VERSION', '1.0.5' );
define( 'BOLDPO_PL_ROOT', __FILE__ );
define( 'BOLDPO_PL_URL', plugins_url( '/', BOLDPO_PL_ROOT ) );
define( 'BOLDPO_PL_PATH', plugin_dir_path( BOLDPO_PL_ROOT ) );
define( 'BOLDPO_DIR_URL', plugin_dir_url( BOLDPO_PL_ROOT ) );
define( 'BOLDPO_PLUGIN_BASE', plugin_basename( BOLDPO_PL_ROOT ) );

require_once BOLDPO_PL_PATH . 'class.boldpost.php';
require_once BOLDPO_PL_PATH . 'public/blocks/blocks.php';
require_once BOLDPO_PL_PATH . 'editor/index.php';

register_activation_hook( __FILE__, array( 'BOLDPO_Main', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'BOLDPO_Main', 'deactivate' ) );


/**
 * Initialize the plugin tracker
 *
 * @return void
 */
function boldpost_appsero_init_tracker() {

    if ( ! class_exists( 'Appsero\Client' ) ) {
    include BOLDPO_PL_PATH . 'admin/opt-in/Client.php';
    }

    $client = new Appsero\Client( '528c40ac-37ea-4f2b-8db7-1f0984f46d0a', 'BoldPost – Gutenberg Post Grid &amp; Layout Blocks', __FILE__ );

    // Active insights
    $client->insights()->init();

}
add_action( 'plugins_loaded', 'boldpost_appsero_init_tracker' );