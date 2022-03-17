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
 * --- IF DATABASE VALUES ARE NOT SET AT ALL, ADD DEFAULT OPTIONS TO DATABASE ---------------------------
 */

	if (!function_exists('gutenborders_default_options')) {
		function gutenborders_default_options() {
			$versionNum = '0.5';
			if (get_option('gutenborders_options') === false) {
				$new_options['gb_version'] = $versionNum;
				$new_options['gb_bordershow'] = 'on';
				$new_options['gb_bordercolor'] = '#c0c0c0';
				$new_options['gb_borderstyle'] = 'dotted';
				$new_options['gb_borderwidth'] = '1';
				$new_options['gb_paddingtop'] = '25';
				$new_options['gb_paddingright'] = '10';
				$new_options['gb_paddingbottom'] = '10';
				$new_options['gb_paddingleft'] = '10';
				$new_options['gb_labelcolor'] = '#ffffff';
				$new_options['gb_labelbackground'] = '#000000';
				$new_options['gb_labelopacity'] = '0.3';
				$new_options['gb_labelsize'] = '18';						
				add_option('gutenborders_options',$new_options);
			} 
		}
	}

/**
 * --- ADD THE .CSS AND .JS TO ADMIN MENU --------------------------------------------------------------
 */
	if (!function_exists('gutenborders_styles')) {
		function gutenborders_styles() {

			$options = get_option('gutenborders_options');
			$versionNum = $options['gb_version'];
			
			$script_vars = array(
				'version' 	=> $options['gb_version'],
				'bordershow'	=> $options['gb_bordershow'],
				'bordercolor'=> $options['gb_bordercolor'],
				'borderstyle'=> $options['gb_borderstyle'],
				'borderwidth'=> $options['gb_borderwidth'],
				'paddingtop'=> $options['gb_paddingtop'],
				'paddingright'=> $options['gb_paddingright'],
				'paddingbottom'=> $options['gb_paddingbottom'],
				'paddingleft'=> $options['gb_paddingleft'],
				'labelcolor'=> $options['gb_labelcolor'],
				'labelbackground'=> $options['gb_labelbackground'],
				'labelopacity'=> $options['gb_labelopacity'],
				'labelsize'=> $options['gb_labelsize']	      
			);

			wp_enqueue_script('gutenbordersLoader', plugins_url('/assets/js/gutenborders.js', __FILE__), array( 'jquery' ), $versionNum, true);
			wp_localize_script( 'gutenbordersLoader', 'gutenborders_loader', $script_vars );

			wp_register_style('gutenbordersAdminStyle', plugins_url('/assets/css/gutenborders.css', __FILE__) );
		    wp_enqueue_style('gutenbordersAdminStyle');		
		}
	}



/**
 * === HOOKS AND ACTIONS AND FILTERS AND SUCH ==========================================================
 */

	$plugin = plugin_basename(__FILE__); 

	register_activation_hook( __FILE__, 'gutenborders_default_options' );

	// add_action( 'enqueue_block_editor_assets', 'gutenborders_load_db_values' );
	add_action( 'enqueue_block_editor_assets', 'gutenborders_styles' );
