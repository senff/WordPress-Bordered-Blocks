<?php
/*
Plugin Name: Gutenborders
Plugin URI: http://www.senff.com/plugins/gutenborders
Description: Gutenborders plugin will add borders to all your blocks in the editor.
Author: Senff
Author URI: http://www.senff.com
Version: 0.91
*/

defined('ABSPATH') or die('INSERT COIN');


/**
 * === FUNCTIONS ========================================================================================
 */

/**
 * --- ON ACTIVATION: IF DATABASE VALUES ARE NOT SET AT ALL, ADD DEFAULT OPTIONS TO DATABASE ---------------------------
 */

	if (!function_exists('gutenborders_default_options')) {
		function gutenborders_default_options() {
			$versionNum = '0.9 RC2';
			if (get_option('gutenborders_options') === false) {
				$new_options['gb_bordershow'] = '';
				$new_options['gb_bordercolor'] = '#c0c0c0';
				$new_options['gb_borderstyle'] = 'dotted';
				$new_options['gb_borderwidth'] = '1';
				$new_options['gb_paddingtop'] = '25';
				$new_options['gb_paddingright'] = '10';
				$new_options['gb_paddingbottom'] = '10';
				$new_options['gb_paddingleft'] = '10';
				$new_options['gb_labelcolor'] = '#ffffff';
				$new_options['gb_labelbackground'] = '#000000';
				$new_options['gb_labelopacity'] = '3';
				$new_options['gb_labelsize'] = '12';						
				add_option('gutenborders_options',$new_options);
			} 
			// Ver
			if (get_option('gutenborders_version') === false) {	
				$new_options['gb_num'] = $versionNum;	
			}
		}
	}

/**
 * --- UPDATE THE VERSION NUMBER IN THE DATABASE --------------------------------------------------------------
 */
	if (!function_exists('gutenborders_version_update')) {
		function gutenborders_version_update() {
			$gb_version = get_option('gutenborders_version');
			$dbVersion = $options['gb_num']; // version in database
			$currentVersion = '0.91'; 

			if ($dbVersion != $currentVersion) {
				$updateversion['gb_num'] = $currentVersion;		
				update_option('gutenborders_version',$updateversion);
			}
		}
	}

/**
 * --- ADD THE .CSS AND .JS TO ADMIN MENU --------------------------------------------------------------
 */
	if (!function_exists('gutenborders_styles')) {
		function gutenborders_styles() {

			$options = get_option('gutenborders_options');
			
			$script_vars = array(
				'version' 		=> $options['gb_version'],
				'bordershow'	=> $options['gb_bordershow'],
				'bordercolor'	=> $options['gb_bordercolor'],
				'borderstyle'	=> $options['gb_borderstyle'],
				'borderwidth'	=> $options['gb_borderwidth'],
				'paddingtop'	=> $options['gb_paddingtop'],
				'paddingright'	=> $options['gb_paddingright'],
				'paddingbottom'	=> $options['gb_paddingbottom'],
				'paddingleft'	=> $options['gb_paddingleft'],
				'labelcolor'	=> $options['gb_labelcolor'],
				'labelbackground'=> $options['gb_labelbackground'],
				'labelopacity'	=> $options['gb_labelopacity'],
				'labelsize'	=> $options['gb_labelsize']	      
			);

			$gb_version = get_option('gutenborders_version');
			$versionNum = $options['gb_num'];			

			wp_enqueue_script('gutenbordersLoader', plugins_url('/assets/js/gutenborders.js', __FILE__), array( 'jquery' ), $versionNum, true);
			wp_localize_script( 'gutenbordersLoader', 'gutenborders_loader', $script_vars );

			wp_register_style('gutenbordersAdminStyle', plugins_url('/assets/css/gutenborders.css', __FILE__) );
		    wp_enqueue_style('gutenbordersAdminStyle');		
		}
	}

/**
 * --- ADD LINK TO SETTINGS PAGE TO SIDEBAR ------------------------------------------------------------
 */
if (!function_exists('gutenborders_menu')) {
    function gutenborders_menu() {
		add_options_page( 'Gutenborders Configuration', 'Gutenborders', 'manage_options', 'gutenbordersconfig', 'gutenborders_config_page' );
    }
}


/**
 * --- ADD LINK TO SETTINGS PAGE TO PLUGIN ------------------------------------------------------------
 */
if (!function_exists('gutenborders_settings_link')) {
function gutenborders_settings_link($links) { 
	$settings_link = '<a href="options-general.php?page=gutenbordersconfig">Settings</a>'; 
	array_unshift($links, $settings_link); 
	return $links; 
	}
}

/**
 * --- THE WHOLE ADMIN SETTINGS PAGE -------------------------------------------------------------------
 */
if (!function_exists('gutenborders_config_page')) {
	function gutenborders_config_page() {
	// Retrieve plugin configuration options from database and put them in variables
	$gutenborders_options = get_option( 'gutenborders_options' );
	$gb_bordershow = ( isset( $gutenborders_options['gb_bordershow'] ) ) ? $gutenborders_options['gb_bordershow'] : '';
	$gb_borderstyle = ( isset( $gutenborders_options['gb_borderstyle'] ) ) ? $gutenborders_options['gb_borderstyle'] : ''; 
	$gb_bordercolor = ( isset( $gutenborders_options['gb_bordercolor'] ) ) ? $gutenborders_options['gb_bordercolor'] : '';
	$gb_borderwidth = ( isset( $gutenborders_options['gb_borderwidth'] ) ) ? $gutenborders_options['gb_borderwidth'] : '';
	$gb_paddingtop = ( isset( $gutenborders_options['gb_paddingtop'] ) ) ? $gutenborders_options['gb_paddingtop'] : '';
	$gb_paddingright = ( isset( $gutenborders_options['gb_paddingright'] ) ) ? $gutenborders_options['gb_paddingright'] : ''; 
	$gb_paddingbottom = ( isset( $gutenborders_options['gb_paddingbottom'] ) ) ? $gutenborders_options['gb_paddingbottom'] : ''; 
	$gb_paddingleft = ( isset( $gutenborders_options['gb_paddingleft'] ) ) ? $gutenborders_options['gb_paddingleft'] : ''; 
	$gb_labelbackground = ( isset( $gutenborders_options['gb_labelbackground'] ) ) ? $gutenborders_options['gb_labelbackground'] : ''; 
	$gb_labelcolor = ( isset( $gutenborders_options['gb_labelcolor'] ) ) ? $gutenborders_options['gb_labelcolor'] : ''; 
	$gb_labelsize = ( isset( $gutenborders_options['gb_labelsize'] ) ) ? $gutenborders_options['gb_labelsize'] : ''; 
	$gb_labelopacity = ( isset( $gutenborders_options['gb_labelopacity'] ) ) ? $gutenborders_options['gb_labelopacity'] : ''; 

	?>

	<div id="gutenborders-settings-general" class="wrap">

		<h2><?php _e('Gutenborders Settings','Gutenborders'); ?></h2>

		<p><?php _e('Gutenborders adds (customizable) borders and labels to all Blocks in the Post/Page editor, to give you a clearer overview of the structure of your content.<br>A toggle switch at the top of the page will allow you to quickly switch between the default editor view and the bordered view.','Gutenborders'); ?></p>

		<div class="main-content">

			<h2 class="nav-tab-wrapper">	
				<a class="nav-tab" href="#main"><?php _e('Settings','Gutenborders'); ?></a>
				<a class="nav-tab" href="#faq"><?php _e('FAQ/Troubleshooting','Gutenborders'); ?></a>
				<a class="nav-tab" href="#supported-blocks"><?php _e('Supported Blocks','Gutenborders'); ?></a>
				<a class="nav-tab" href="#plugin-info"><?php _e('About','Gutenborders'); ?></a>
			</h2>

			<br>

			<?php 

				if ( isset( $_GET['message'] ) && ($_GET['message'] == '1')) { 
					echo '<div id="message" class="fade updated"><p><strong>'.__('Settings updated.','Gutenborders').'</strong></p></div>';
				}	

				if ( isset( $_GET['warning'] ) && ($_GET['warning'] == '1')) { 
					echo '<div id="message" class="error"><p><strong>WARNING! Please review the following settings:</strong></p><ul style="list-style-type: disc; margin: 0 0 20px 24px;">';
 			

					if ( isset( $_GET['borderwarning'] ) && ($_GET['borderwarning'] == 'true')) { 
						echo '<li>One or more settings for the <strong>BORDER</strong> were empty or invalid and were reverted to their previous values.</li>';
					} 	

					if ( isset( $_GET['paddingwarning'] ) && ($_GET['paddingwarning'] == 'true')) { 
						echo '<li>One or more settings for the <strong>PADDING</strong> were empty or invalid and were reverted to their previous values.</li>';
					} 	

					if ( isset( $_GET['labelwarning'] ) && ($_GET['labelwarning'] == 'true')) { 
						echo '<li>One or more settings for the <strong>LABEL</strong> were empty or invalid and were reverted to their previous values.</li>';
					} 	

					echo '</ul></div>';
				} 


			?>
		
			<div class="tabs-content">

				<div id="gutenborders-main">

					<form method="post" action="admin-post.php">

						<input type="hidden" name="action" value="save_gutenborders_options" />
						<!-- Adding security through hidden referrer field -->
						<?php wp_nonce_field( 'gutenborders' ); ?>


						<table class="form-table">
							<tr>
								<td colspan="2">

									<table class="form-table">
										<tr>
											<th scope="row"><?php _e('Default State','Gutenborders'); ?> </th>
											<td>
												<fieldset>
													<input type="checkbox" id="gb_bordershow" name="gb_bordershow" <?php if (esc_attr($gb_bordershow )) echo ' checked="checked" ';?> />
													<label for="gb_bordershow"><strong><?php _e('Show borders & labels by default','Gutenborders'); ?></strong></label>
													<br><em><?php _e('Selecting this option will always show the borders/labels of all Blocks on page load, which may cause performance issues.<br>Regardless of this setting, you can always quicky switch between showing/hiding the borders on any Post/Page.','Gutenborders'); ?></em>
												</fieldset>
											</td>
										</tr>
									</table>

								</td>
							</tr>

							<tr>
								<td class="no-padding">

									<table class="border-table">
										<tr><th colspan="2" class="table-title"><input type="button" value="<?php _e('Reset to defaults','Gutenborders'); ?>" class="button-reset-border button-reset button-secondary"/><h2><?php _e('Borders','Gutenborders'); ?></h2></th></tr>
										<tr>
											<th scope="row"><?php _e('Border Style:','Gutenborders'); ?> <a href="#" title="<?php _e('Choose what type of line should be used for the borders.','Gutenborders'); ?>" class="help">?</a></th>
											<td class="borderstyle">
												<fieldset><input type="radio" id="gb_type_1" name="gb_borderstyle" value="solid" <?php if (esc_attr( $gb_borderstyle ) == "solid") {echo 'checked';} ?>><label id="borderstyle-1" for="gb_type_1">Solid</label></fieldset>
												<fieldset><input type="radio" id="gb_type_2" name="gb_borderstyle" value="dashed" <?php if (esc_attr( $gb_borderstyle ) == "dashed") {echo 'checked';} ?>><label id="borderstyle-2" for="gb_type_2">Dashed</label></fieldset>
												<fieldset><input type="radio" id="gb_type_3" name="gb_borderstyle" value="dotted" <?php if (esc_attr( $gb_borderstyle ) == "dotted") {echo 'checked';} ?>><label id="borderstyle-3" for="gb_type_3">Dotted</label></fieldset>
											</td>
										</tr>								

										<tr>
											<th scope="row"><?php _e('Border Color:','Gutenborders'); ?> <a href="#" title="<?php _e('Choose the color of the borders.','Gutenborders'); ?>" class="help">?</a></th>
											<td class="bordercolor">
												<input type="text" name="gb_bordercolor" value="<?php echo esc_attr( $gb_bordercolor ) ?>" class="field-colorpicker" />
											</td>
										</tr>

										<tr>
											<th scope="row"><?php _e('Border Width (1-5):','Gutenborders'); ?> <a href="#" title="<?php _e('Choose the width of the borders (1-10).','Gutenborders'); ?>" class="help">?</a></th>
											<td class="borderwidth">
												<input type="number" min="1" max="5" name="gb_borderwidth" value="<?php echo esc_attr( $gb_borderwidth ) ?>" /> px
											</td>
										</tr>
									</table>

								</td>
								<td rowspan="3" class="preview-cell">

									<div class="prev-block">
										<span class="block-label">HEADING</span>
										<h3>PREVIEW</h3>
									</div>

									<p class="prev-block">
										<span class="block-label">PARAGRAPH</span>
										This is to give you a very rough idea how the blocks will look in your editor. Actual results may be different, depending on your theme. <strong>To view changes before you save/submit the settings, select the button below</strong>:
									</p>

									<div class="prev-block">
										<span class="block-label">BUTTONS</span>
										
										<div class="prev-block" style="display: inline-block;">
											<span class="block-label">BUTTON</span>

											<input type="button" value="<?php _e('SHOW ME A PREVIEW!','Gutenborders'); ?>" class="button-preview button-secondary"/>				
										</div>

									</div>

									<div class="prev-block columns" data-type="COLUMNS">
										<span class="block-label">COLUMNS</span>
										
										<div class="prev-block column column-left" data-type="COLUMN">
											<span class="block-label">COLUMN</span>

											<p class="prev-block"> 
												<span class="block-label">PARAGRAPH</span>
												And now a picture of a beautiful girl:
											</p>

											<div class="prev-image" data-type="IMAGE">
												<span class="block-label">IMAGE</span>
												<img src="<?php 
												define('sophieURL', plugins_url('/assets/img/sophie.png', __FILE__));
												$sophie = sophieURL;
												echo $sophie; ?>">
											</div>											

										</div>
			
										<div class="prev-block column column-right" data-type="COLUMN">
											<span class="block-label">COLUMN</span>
											
											<p class="prev-block"> 
												<span class="block-label">PARAGRAPH</span>
												We also have space for an additional fun fact.
											</p>

											<div class="prev-block"> 
												<span class="block-label">LIST</span>
												<ul>
													<li>Q: What did the drummer call his twin daughters?</li>
													<li>A: Anna One, Anna Two.</li>
												</ul>
											</div>	

											<p class="prev-block"> 
												<span class="block-label">PARAGRAPH</span>											
												It's not really a fun fact, actually. Let's just call it what it is -- it's a <strong>dad joke</strong>. And not a particularly good one. Then again, isn't that the definition of a dad joke?
											</p>
										</div>
									</div>

									<style type="text/css">
										.preview-cell div, .preview-cell p  {
											border: <?php echo esc_attr( $gb_borderstyle ).' '.esc_attr( $gb_borderwidth ).'px '.esc_attr( $gb_bordercolor ) ?>;
											padding: <?php echo esc_attr( $gb_paddingtop ).'px '.esc_attr( $gb_paddingright ).'px '.esc_attr( $gb_paddingbottom ).'px '.esc_attr( $gb_paddingleft ).'px ;' ?>;
										}
										.preview-cell .block-label {
											background: <?php echo esc_attr( $gb_labelbackground ) ?>;
											color: <?php echo esc_attr( $gb_labelcolor ) ?>;
											font-size: <?php echo esc_attr( $gb_labelsize ) ?>px;
											height: <?php echo (esc_attr( $gb_labelsize )*1.5) ?>px;
											line-height: <?php echo (esc_attr( $gb_labelsize )*1.5) ?>px;
											opacity: <?php echo (esc_attr( $gb_labelopacity ))/10 ?>;
										}
									</style>

								</td>
							</tr>

							<tr>
								<td>

									<table class="padding-table">
										<tr><th colspan="3" class="table-title"><input type="button" value="<?php _e('Reset to defaults','Gutenborders'); ?>" class="button-reset-padding button-reset button-secondary"/><h2><?php _e('Spacing','Gutenborders'); ?></h2></th></tr>
										<tr>
											<td> </td>
											<td>
												<input type="number" min="1" max="50" name="gb_paddingtop" value="<?php echo esc_attr( $gb_paddingtop ) ?>" />
											</td>
											<td> </td>			
										</tr>
										<tr>
											<td>
												<input type="number" min="1" max="50" name="gb_paddingleft" value="<?php echo esc_attr( $gb_paddingleft ) ?>" />
											</td>
											<td class="padding-preview" style="border: <?php echo esc_attr( $gb_borderstyle ) ?> <?php echo esc_attr( $gb_borderwidth ) ?>px <?php echo esc_attr( $gb_bordercolor ) ?>"> </td>
											<td>
												<input type="number" min="1" max="50" name="gb_paddingright" value="<?php echo esc_attr( $gb_paddingright ) ?>" /> 
											</td>			
										</tr>
										<tr>
											<td> </td>
											<td>
												<input type="number" min="1" max="50" name="gb_paddingbottom" value="<?php echo esc_attr( $gb_paddingbottom ) ?>" />
											</td>
											<td> </td>			
										</tr>																				
									</table>

								</td>							
							</tr>

							<tr>
								<td class="no-padding">

									<table class="label-table">
										<tr><th colspan="2" class="table-title"><input type="button" value="<?php _e('Reset to defaults','Gutenborders'); ?>" class="button-reset-label button-reset button-secondary"/><h2><?php _e('Labels','Gutenborders'); ?></h2></th></tr>
										<tr>
											<th scope="row"><?php _e('Background color:','Gutenborders'); ?> <a href="#" title="<?php _e('Choose the background color of the labels','Gutenborders'); ?>" class="help">?</a></th>
											<td class="labelbackground">
												<input type="text" name="gb_labelbackground" value="<?php echo esc_attr( $gb_labelbackground ) ?>" class="field-colorpicker" />
											</td>
										</tr>								

										<tr>
											<th scope="row"><?php _e('Text Color:','Gutenborders'); ?> <a href="#" title="<?php _e('Choose the text color of the labels.','Gutenborders'); ?>" class="help">?</a></th>
											<td class="labelcolor">
												<input type="text" name="gb_labelcolor" value="<?php echo esc_attr( $gb_labelcolor ) ?>" class="field-colorpicker" />
											</td>
										</tr>

										<tr>
											<th scope="row"><?php _e('Text size (0-30):','Gutenborders'); ?> <a href="#" title="<?php _e('Choose the text size of the labels. If 0, no labels will be shown at all.','Gutenborders'); ?>" class="help">?</a></th>
											<td class="borderwidth">
												<input type="number" min="0" max="30" name="gb_labelsize" value="<?php echo esc_attr( $gb_labelsize ) ?>" /> px
											</td>
										</tr>

										<tr>
											<th scope="row"><?php _e('Opacity (0-10):','Gutenborders'); ?> <a href="#" title="<?php _e('Choose the opacity size of the labels. 0 = invisible, 10 = full opacity.','Gutenborders'); ?>" class="help">?</a></th>
											<td class="borderwidth">
												<input type="number" min="0" max="10" name="gb_labelopacity" value="<?php echo esc_attr( $gb_labelopacity ) ?>" />
											</td>
										</tr>
									</table>

								</td>							
							</tr>
						</table>

						<input type="button" value="<?php _e('Reset all to defaults','Gutenborders'); ?>" class="button-reset-all button-secondary"/>
						<input type="button" value="<?php _e('Preview','Gutenborders'); ?>" class="button-preview button-secondary"/>
						<input type="submit" value="<?php _e('SAVE SETTINGS','Gutenborders'); ?>" class="button-primary"/>

						<p>&nbsp;</p>
					</form>


				</div>

				<div id="gutenborders-faq">
					<?php include 'assets/faq.php'; ?>
				</div>

				<div id="gutenborders-supported-blocks">
					<?php include 'assets/supported-blocks.php'; ?>
				</div>

				<div id="gutenborders-plugin-info">
					<?php include 'assets/plugin-info.php'; ?>
				</div>

			</div>

		</div>

		<!--
		<div class="main-sidebar">	
			<?php include 'assets/plugin-info.php'; ?>
		</div>
		-->
	</div>

	<?php
	}
}


if (!function_exists('gutenborders_admin_init')) {
	function gutenborders_admin_init() {
		add_action( 'admin_post_save_gutenborders_options', 'process_gutenborders_options' );
	}
}

/**
 * --- PROCESS THE SETTINGS FORM AFTER SUBMITTING ------------------------------------------------------
 */
if (!function_exists('process_gutenborders_options')) {
	function process_gutenborders_options() {

		if ( !current_user_can( 'manage_options' ))
			wp_die( 'Not allowed');

		check_admin_referer('gutenborders');
		$options = get_option('gutenborders_options');

		foreach ( array('gb_bordershow') as $option_name ) {
			if ( (isset( $_POST[$option_name] )) && ($_POST[$option_name] != '')) {
				$options[$option_name] = true;
			} else {
				$options[$option_name] = false;
			}
		}

		foreach ( array('gb_borderstyle') as $option_name ) {
			if ( (isset( $_POST[$option_name] )) && ($_POST[$option_name] != '')) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			} 
		}

		foreach ( array('gb_bordercolor') as $option_name ) {
			if ( (isset( $_POST[$option_name] )) && (preg_match('/^#[a-f0-9]{6}$/i', $_POST[$option_name])) ) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			} else {
				$warning = 'true';
				$borderwarning = 'true';
			}
		}

		foreach ( array('gb_borderwidth') as $option_name ) {
			if ( (isset( $_POST[$option_name] )) && ($_POST[$option_name] != '')) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			} else {
				$warning = 'true';
				$borderwarning = 'true';				
			}
		}		

		foreach ( array('gb_paddingtop') as $option_name ) {
			if ( (isset( $_POST[$option_name] )) && ($_POST[$option_name] != '')) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			} else {
				$warning = 'true';
				$paddingwarning = 'true';
			}
		}	

		foreach ( array('gb_paddingright') as $option_name ) {
			if ( (isset( $_POST[$option_name] )) && ($_POST[$option_name] != '')) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			} else {
				$warning = 'true';
				$paddingwarning = 'true';				
			}
		}	

		foreach ( array('gb_paddingbottom') as $option_name ) {
			if ( (isset( $_POST[$option_name] )) && ($_POST[$option_name] != '')) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			} else {
				$warning = 'true';
				$paddingwarning = 'true';
			}
		}	

		foreach ( array('gb_paddingleft') as $option_name ) {
			if ( (isset( $_POST[$option_name] )) && ($_POST[$option_name] != '')) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			} else {
				$warning = 'true';
				$paddingwarning = 'true';
			}
		}							

		foreach ( array('gb_labelbackground') as $option_name ) {
			if ( (isset( $_POST[$option_name] )) && (preg_match('/^#[a-f0-9]{6}$/i', $_POST[$option_name])) ) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			} else {
				$warning = 'true';
				$labelwarning = 'true';
			}
		}

		foreach ( array('gb_labelcolor') as $option_name ) {
			if ( (isset( $_POST[$option_name] )) && (preg_match('/^#[a-f0-9]{6}$/i', $_POST[$option_name])) ) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			} else {
				$warning = 'true';
				$labelwarning = 'true';
			}
		}

		foreach ( array('gb_labelsize') as $option_name ) {
			if ( (isset( $_POST[$option_name] )) && ($_POST[$option_name] != '')) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			} else {
				$warning = 'true';
				$labelwarning = 'true';				
			}
		}

		foreach ( array('gb_labelopacity') as $option_name ) {
			if ( (isset( $_POST[$option_name] )) && ($_POST[$option_name] != '')) {
				$options[$option_name] = sanitize_text_field( $_POST[$option_name] );
			} 	else {
				$warning = 'true';
				$labelwarning = 'true';
			}
		}

		update_option( 'gutenborders_options', $options );	

		if ($warning == 'true') {
	 		wp_redirect( add_query_arg(
	 			array('page' => 'gutenbordersconfig', 'message' => '1', 'warning' => '1', 'borderwarning' => $borderwarning, 'paddingwarning' => $paddingwarning, 'labelwarning' => $labelwarning, ),
	 			admin_url( 'options-general.php' ) 
	 			)
	 		);
		} else {
	 		wp_redirect( add_query_arg(
	 			array('page' => 'gutenbordersconfig', 'message' => '1'),
	 			admin_url( 'options-general.php' ) 
	 			)
	 		);	
 		}

		exit;
	}
}


/**
 * --- CONFIG .JS and .CSS  --------------------------------------------------------------
 */
if (!function_exists('gutenborders_admin')) {
	function gutenborders_admin($hook) {
		if ($hook != 'settings_page_gutenbordersconfig') {
			return;
		}

		wp_register_script('gutenbordersAdminScript', plugins_url('/assets/js/gutenborders-admin.js', __FILE__), array( 'jquery' ), '1.0');
		wp_enqueue_script('gutenbordersAdminScript');

		wp_register_style('gutenbordersAdminStyle', plugins_url('/assets/css/gutenborders-admin.css', __FILE__) );
	    wp_enqueue_style('gutenbordersAdminStyle');		
	}
}

if (!function_exists('enqueue_color_picker')) {
	function enqueue_color_picker( $hook_suffix ) {
	    wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_script( 'gutenbordersColorpicker', plugins_url('/assets/js/colorpicker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	}
}

/**
 * === HOOKS AND ACTIONS AND FILTERS AND SUCH ==========================================================
 */

	$plugin = plugin_basename(__FILE__); 

	register_activation_hook( __FILE__, 'gutenborders_default_options' );
	add_action('enqueue_block_editor_assets', 'gutenborders_styles' );
	add_action('admin_menu', 'gutenborders_menu');
	add_action('admin_init', 'gutenborders_admin_init' );
	add_action('admin_init', 'gutenborders_version_update' );	
	add_action('admin_enqueue_scripts', 'gutenborders_admin' );	
	add_action('admin_enqueue_scripts', 'enqueue_color_picker' );
	add_filter("plugin_action_links_$plugin", 'gutenborders_settings_link' );

