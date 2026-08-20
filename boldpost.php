<?php
/**
 * Plugin Name: BoldPost 
 * Description: BoldPost Plugin, post display plugin for the block editor.
 * Plugin URI:  https://themewant.com/downloads/boldpost/
 * Author:      Themewant
 * Author URI:  http://themewant.com/
 * Version:     1.0.7
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: boldpost
 * Domain Path: /languages
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'BOLDPO_VERSION', '1.0.7' );
define( 'BOLDPO_PL_ROOT', __FILE__ );
define( 'BOLDPO_PL_URL', plugins_url( '/', BOLDPO_PL_ROOT ) );
define( 'BOLDPO_PL_PATH', plugin_dir_path( BOLDPO_PL_ROOT ) );
define( 'BOLDPO_DIR_URL', plugin_dir_url( BOLDPO_PL_ROOT ) );
define( 'BOLDPO_PLUGIN_BASE', plugin_basename( BOLDPO_PL_ROOT ) );

require_once BOLDPO_PL_PATH . 'class.boldpost.php';
require_once BOLDPO_PL_PATH . 'admin/post-types.php';
require_once BOLDPO_PL_PATH . 'admin/NoticeDashboard/NoticeDashboard.php';
require_once BOLDPO_PL_PATH . 'public/blocks/blocks.php';
require_once BOLDPO_PL_PATH . 'editor/index.php';
require_once BOLDPO_PL_PATH . 'admin/opt-in/vendor/autoload.php';
require_once BOLDPO_PL_PATH . 'admin/opt-in/Appsero_Tracker.php';

register_activation_hook( __FILE__, array( 'BOLDPO_Main', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'BOLDPO_Main', 'deactivate' ) );

BOLDPO_Main::instance();

if ( class_exists( '\BoldPo\Tracking\Appsero_Tracker' ) ) {
    \BoldPo\Tracking\Appsero_Tracker::instance();
}
