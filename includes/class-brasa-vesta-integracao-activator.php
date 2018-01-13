<?php

/**
 * Fired during plugin activation
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Plugin_Name
 * @subpackage Plugin_Name/includes
 * @author     Your Name <email@example.com>
 */
class Plugin_Name_Activator {



	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		// Register settings using the Settings API
		function wpdocs_register_my_setting() {
		    register_setting( 'my-options-group', 'my-option-name', 'intval' );
		}
		add_action( 'admin_init', 'wpdocs_register_my_setting' );

		// Modify capability
		function wpdocs_my_page_capability( $capability ) {
		    return 'edit_others_posts';
		}
		add_filter( 'option_page_capability_my-options-group', 'wpdocs_my_page_capability' );
		echo''
	}

}
