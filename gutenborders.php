<?php
/*
Plugin Name: Gutenborders
Plugin URI: http://www.senff.com/plugins/gutenborders
Description: Gutenborders plugin will add borders to all your blocks in the editor.
Author: Senff
Author URI: http://www.senff.com
Version: 0.1
*/

defined('ABSPATH') or die('INSERT COIN');


/**
 * === FUNCTIONS ========================================================================================
 */


/**
 * --- ADD THE .CSS AND .JS TO ADMIN MENU --------------------------------------------------------------
 */
if (!function_exists('gutenborders_styles')) {
	function gutenborders_styles() {

		wp_register_script('gutenbordersAdminScript', plugins_url('/assets/js/gutenborders.js', __FILE__), array( 'jquery' ), '1.0');
		wp_enqueue_script('gutenbordersAdminScript');

		wp_register_style('gutenbordersAdminStyle', plugins_url('/assets/css/gutenborders.css', __FILE__) );
	    wp_enqueue_style('gutenbordersAdminStyle');		
	}
}


/**
 * === HOOKS AND ACTIONS AND FILTERS AND SUCH ==========================================================
 */

$plugin = plugin_basename(__FILE__); 

add_action('admin_enqueue_scripts', 'gutenborders_styles' );
