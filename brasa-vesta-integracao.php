<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the
 * plugin admin area. This file also defines a function that starts the plugin.
 *
 * @link              http://code.tutsplus.com/tutorials/creating-custom-admin-pages-in-wordpress-1
 * @since             1.0.0
 * @package           Custom_Admin_Settings
 *
 * @wordpress-plugin
 * Plugin Name:       Custom Admin Settings
 * Plugin URI:        http://code.tutsplus.com/tutorials/creating-custom-admin-pages-in-wordpress-1
 * Description:       Demonstrates how to write custom administration pages in WordPress.
 * Version:           1.0.0
 * Author:            Tom McFarlin
 * Author URI:        https://tommcfarlin.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
     die;
}

// Include the shared dependency.
include_once( plugin_dir_path( __FILE__ ) . 'shared/class-deserializer.php' );
include_once( plugin_dir_path( __FILE__ ) . 'shared/ajax-functions.php' );

// Include the dependencies needed to instantiate the plugin.
foreach ( glob( plugin_dir_path( __FILE__ ) . 'admin/*.php' ) as $file ) {
    include_once $file;
}

add_action( 'plugins_loaded', 'brasa_vesta_plugin' );
/**
 * Starts the plugin.
 *
 * @since 1.0.0
 */

function brasa_vesta_plugin() {



function brasa_vesta_load_scripts() {
 wp_enqueue_script('jquery-ui-core');// enqueue jQuery UI Core
 wp_enqueue_script('jquery-ui-tabs');// enqueue jQuery UI Tabs
 wp_enqueue_script('brasa-vesta-js', plugin_dir_url( __FILE__ ) . 'assets/js/brasa-vesta-integracao.js');
 wp_enqueue_style('brasa-vesta', plugin_dir_url( __FILE__ ) . 'assets/css/brasa-vesta-integracao.css');
 $brasa_vesta_nonce = wp_create_nonce( 'brasa_vesta_nonce' );

 wp_localize_script( 'brasa-vesta-js', 'my_ajax_obj', array(
     'ajax_url' => admin_url( 'admin-ajax.php' ),
     'nonce'    => $brasa_vesta_nonce,
 ) );
}

add_action( 'wp_enqueue_scripts', 'brasa_vesta_load_scripts' );
$plugin_url = plugin_dir_url(  __FILE__ );
define( 'BRASA_VESTA_PLUGIN_URL', $plugin_url);

    $serializer = new Serializer();
    $serializer->init();
    $deserializer = new Deserializer();
    $plugin = new Submenu( new Submenu_Page($deserializer) );
    $plugin->init();

}
