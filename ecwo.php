<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://orionorigin.com
 * @since             1.0
 * @package           ecwo
 *
 * @wordpress-plugin
 * Plugin Name:       Orion Email Customizer for WooCommerce
 * Plugin URI:        https://orionorigin.com/orion-email-customizer-for-woocommerce
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0
 * Author:            orion
 * Author URI:        https://orionorigin.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ecwo
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ECWO_VERSION', '1.0' );
define( 'ECWO_URL', plugins_url( '/', __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ecwo-activator.php
 */
function activate_ecwo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ecwo-activator.php';
	ecwo_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ecwo-deactivator.php
 */
function deactivate_ecwo() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ecwo-deactivator.php';
	ecwo_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ecwo' );
register_deactivation_hook( __FILE__, 'deactivate_ecwo' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ecwo.php';
require plugin_dir_path( __FILE__ ) . 'includes/functions.php';
define( 'ECWO_DIR', dirname( __FILE__ ) );

if ( ! function_exists( 'o_admin_fields' ) ) {
	require plugin_dir_path( __FILE__ ) . 'includes/utils.php';
}

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0
 */
function run_ecwo() {

	$plugin = new ecwo();
	$plugin->run();

}
run_ecwo();
