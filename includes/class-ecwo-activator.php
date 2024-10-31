<?php

/**
 * Fired during plugin activation
 *
 * @link       https://orionorigin.com
 * @since      1.0.0
 *
 * @package    ecwo
 * @subpackage ecwo/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    ecwo
 * @subpackage ecwo/includes
 * @author     orion <help@orionorigin.com>
 */
class Ecwo_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wp_rewrite;
			add_option( 'ecwo_do_activation_redirect', true );
			$wp_rewrite->flush_rules( false );
	}

}
