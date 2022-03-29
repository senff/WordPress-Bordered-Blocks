<?php
/*
Plugin Name: Bordered Blocks
Plugin URI: https://wordpress.org/plugins/bordered-blocks
Description: Bordered Blocks adds subtle borders to all blocks in the WordPress Post/Page editor, to give you a clearer view of the layout of the blocks are on your page. Switch easily between default (clean) view, and bordered (clear) view.
Author: Senff
Author URI: http://www.senff.com
Version: 0.95
*/

defined('ABSPATH') or die('INSERT COIN');


/**
 * === FUNCTIONS ========================================================================================
 */

/**
 * --- ON ACTIVATION: IF DATABASE VALUES ARE NOT SET AT ALL, ADD DEFAULT OPTIONS TO DATABASE ---------------------------
 */

	function borderedblocks_default_options() {
		$versionNum = '0.95';
		if (get_option('borderedblocks_options') === false) {
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
			add_option('borderedblocks_options',$new_options);
		} 
		// Ver
		if (get_option('borderedblocks_version') === false) {	
			$new_options['gb_num'] = $versionNum;	
		}
	}

/**
 * --- UPDATE THE VERSION NUMBER IN THE DATABASE --------------------------------------------------------------
 */

	function borderedblocks_version_update() {
		$gb_version = get_option('borderedblocks_version');
		$dbVersion = $options['gb_num']; // version in database
		$currentVersion = '0.95'; 

		if ($dbVersion != $currentVersion) {
			$updateversion['gb_num'] = $currentVersion;		
			update_option('borderedblocks_version',$updateversion);
		}
	}


/**
 * --- ADD THE .CSS AND .JS TO ADMIN MENU --------------------------------------------------------------
 */

	function borderedblocks_styles() {

		$options = get_option('borderedblocks_options');
		
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

		$gb_version = get_option('borderedblocks_version');
		$versionNum = $options['gb_num'];			

		wp_enqueue_script('borderedblocksLoader', plugins_url('/assets/js/bordered-blocks.js', __FILE__), array( 'jquery' ), $versionNum, true);
		wp_localize_script( 'borderedblocksLoader', 'borderedblocks_loader', $script_vars );

		wp_register_style('borderedblocksAdminStyle', plugins_url('/assets/css/bordered-blocks.css', __FILE__) );
	    wp_enqueue_style('borderedblocksAdminStyle');		
	}


/**
 * --- ADD LINK TO SETTINGS PAGE TO SIDEBAR ------------------------------------------------------------
 */

    function borderedblocks_menu() {
		add_options_page( 'Bordered Blocks Configuration', 'Bordered Blocks', 'manage_options', 'borderedblocksconfig', 'borderedblocks_config_page' );
    }


/**
 * --- ADD LINK TO SETTINGS PAGE TO PLUGIN ------------------------------------------------------------
 */

	function borderedblocks_settings_link($links) { 
		$settings_link = '<a href="options-general.php?page=borderedblocksconfig">Settings</a>'; 
		array_unshift($links, $settings_link); 
		return $links; 
	}

/**
 * --- THE WHOLE ADMIN SETTINGS PAGE -------------------------------------------------------------------
 */

function borderedblocks_config_page() {
	// Retrieve plugin configuration options from database and put them in variables
	$borderedblocks_options = get_option( 'borderedblocks_options' );
	$gb_bordershow = ( isset( $borderedblocks_options['gb_bordershow'] ) ) ? $borderedblocks_options['gb_bordershow'] : '';
	$gb_borderstyle = ( isset( $borderedblocks_options['gb_borderstyle'] ) ) ? $borderedblocks_options['gb_borderstyle'] : ''; 
	$gb_bordercolor = ( isset( $borderedblocks_options['gb_bordercolor'] ) ) ? $borderedblocks_options['gb_bordercolor'] : '';
	$gb_borderwidth = ( isset( $borderedblocks_options['gb_borderwidth'] ) ) ? $borderedblocks_options['gb_borderwidth'] : '';
	$gb_paddingtop = ( isset( $borderedblocks_options['gb_paddingtop'] ) ) ? $borderedblocks_options['gb_paddingtop'] : '';
	$gb_paddingright = ( isset( $borderedblocks_options['gb_paddingright'] ) ) ? $borderedblocks_options['gb_paddingright'] : ''; 
	$gb_paddingbottom = ( isset( $borderedblocks_options['gb_paddingbottom'] ) ) ? $borderedblocks_options['gb_paddingbottom'] : ''; 
	$gb_paddingleft = ( isset( $borderedblocks_options['gb_paddingleft'] ) ) ? $borderedblocks_options['gb_paddingleft'] : ''; 
	$gb_labelbackground = ( isset( $borderedblocks_options['gb_labelbackground'] ) ) ? $borderedblocks_options['gb_labelbackground'] : ''; 
	$gb_labelcolor = ( isset( $borderedblocks_options['gb_labelcolor'] ) ) ? $borderedblocks_options['gb_labelcolor'] : ''; 
	$gb_labelsize = ( isset( $borderedblocks_options['gb_labelsize'] ) ) ? $borderedblocks_options['gb_labelsize'] : ''; 
	$gb_labelopacity = ( isset( $borderedblocks_options['gb_labelopacity'] ) ) ? $borderedblocks_options['gb_labelopacity'] : ''; 

	?>

	<div id="borderedblocks-settings-general" class="wrap">

		<h2><?php esc_html_e('Bordered Blocks Settings','Bordered Blocks'); ?></h2>

		<p>
			<?php esc_html_e('Bordered Blocks adds (customizable) borders and labels to all Blocks in the Post/Page editor, to give you a clearer overview of the structure of your content.','Bordered Blocks'); ?>
			<br>
			<?php esc_html_e('A toggle switch at the top of the page will allow you to quickly switch between the default clean editor view and the bordered clear view.','Bordered Blocks'); ?>
		</p>

		<div class="main-content">

			<h2 class="nav-tab-wrapper">	
				<a class="nav-tab" href="#main"><?php esc_html_e('Settings','Bordered Blocks'); ?></a>
				<a class="nav-tab" href="#faq"><?php esc_html_e('FAQ/Troubleshooting','Bordered Blocks'); ?></a>
				<a class="nav-tab" href="#supported-blocks"><?php esc_html_e('Supported Blocks','Bordered Blocks'); ?></a>
				<a class="nav-tab" href="#plugin-info"><?php esc_html_e('About','Bordered Blocks'); ?></a>
			</h2>

			<br>

			<?php 

				if ( isset( $_GET['message'] ) && ($_GET['message'] == '1')) { 
					echo '<div id="message" class="fade updated"><p><strong>';
					esc_html_e('Settings updated.','Bordered Blocks');
					echo '</strong></p></div>';
				}	

				if ( isset( $_GET['warning'] ) && ($_GET['warning'] == '1')) { 
					echo '<div id="message" class="error"><p><strong>';
					esc_html_e('WARNING! Please review the following settings:','Bordered Blocks');
					echo '</strong></p><ul style="list-style-type: disc; margin: 0 0 20px 24px;">';
 			

					if ( isset( $_GET['borderwarning'] ) && ($_GET['borderwarning'] == 'true')) { 
						echo '<li>';
						esc_html_e('One or more settings for the','Bordered Blocks');
						echo ' <strong>';
						esc_html_e('BORDER','Bordered Blocks');
						echo '</strong> ';
						esc_html_e('were empty or invalid and were reverted to their previous values.','Bordered Blocks');
						echo '</li>';
					} 	

					if ( isset( $_GET['paddingwarning'] ) && ($_GET['paddingwarning'] == 'true')) { 
						echo '<li>';
						esc_html_e('One or more settings for the','Bordered Blocks');
						echo ' <strong>';
						esc_html_e('PADDING','Bordered Blocks');
						echo '</strong> ';
						esc_html_e('were empty or invalid and were reverted to their previous values.','Bordered Blocks');
						echo '</li>';
					} 	

					if ( isset( $_GET['labelwarning'] ) && ($_GET['labelwarning'] == 'true')) { 
						echo '<li>';
						esc_html_e('One or more settings for the','Bordered Blocks');
						echo ' <strong>';
						esc_html_e('LABEL','Bordered Blocks');
						echo '</strong> ';
						esc_html_e('were empty or invalid and were reverted to their previous values.','Bordered Blocks');
						echo '</li>';
					} 	

					echo '</ul></div>';
				} 

			?>
		
			<div class="tabs-content">

				<div id="borderedblocks-main">

					<form method="post" action="admin-post.php">

						<input type="hidden" name="action" value="save_borderedblocks_options" />
						<!-- Adding security through hidden referrer field -->
						<?php wp_nonce_field( 'borderedblocks' ); ?>

						<table class="form-table">
							<tr>
								<td colspan="2">

									<table class="form-table">
										<tr>
											<th scope="row"><?php esc_html_e('Default State','Bordered Blocks'); ?> </th>
											<td>
												<fieldset>
													<input type="checkbox" id="gb_bordershow" name="gb_bordershow" <?php if (esc_attr($gb_bordershow )) echo ' checked="checked" ';?> />
													<label for="gb_bordershow"><strong><?php esc_html_e('Show borders & labels by default','Bordered Blocks'); ?></strong></label>
													<br><em><?php esc_html_e('Selecting this option will always show the borders/labels of all Blocks on page load, which may cause performance issues.<br>Regardless of this setting, there will always be a toggle button at the top of on any Post/Page in the editor, allowing you to quicky switch between showing/hiding the borders.','Bordered Blocks'); ?></em>
												</fieldset>
											</td>
										</tr>
									</table>

								</td>
							</tr>

							<tr>
								<td class="no-padding">

									<table class="border-table">
										<tr>
											<th colspan="2" class="table-title">
												<input type="button" value="<?php esc_attr_e('Reset to defaults','Bordered Blocks'); ?>" class="button-reset-border button-reset button-secondary"/>
												<h2><?php esc_html_e('Borders','Bordered Blocks'); ?></h2>
											</th>
										</tr>
										<tr>
											<th scope="row">
												<?php esc_html_e('Border Style:','Bordered Blocks'); ?> 
												<a href="<?php echo esc_url('#'); ?>" class="<?php echo esc_attr('help') ?>" title="<?php esc_attr_e('Choose what type of line should be used for the borders.','Bordered Blocks'); ?>"><?php echo esc_html('?'); ?></a>
											</th>
											<td class="borderstyle">
												<fieldset><input type="radio" id="<?php echo esc_attr('gb_type_1') ?>" name="<?php echo esc_attr('gb_borderstyle') ?>" value="<?php esc_attr_e('solid','Bordered Blocks'); ?>" <?php if (esc_attr( $gb_borderstyle ) == "solid") {echo 'checked';} ?>><label id="<?php echo esc_attr('borderstyle-1') ?>" for="<?php echo esc_attr('gb_type_1') ?>"><?php esc_html_e('Solid','Bordered Blocks'); ?></label></fieldset>
												<fieldset><input type="radio" id="<?php echo esc_attr('gb_type_2') ?>" name="<?php echo esc_attr('gb_borderstyle') ?>" value="<?php esc_attr_e('dashed','Bordered Blocks'); ?>" <?php if (esc_attr( $gb_borderstyle ) == "dashed") {echo 'checked';} ?>><label id="<?php echo esc_attr('borderstyle-2') ?>" for="<?php echo esc_attr('gb_type_2') ?>"><?php esc_html_e('Dashed','Bordered Blocks'); ?></label></fieldset>
												<fieldset><input type="radio" id="<?php echo esc_attr('gb_type_3') ?>" name="<?php echo esc_attr('gb_borderstyle') ?>" value="<?php esc_attr_e('dotted','Bordered Blocks'); ?>" <?php if (esc_attr( $gb_borderstyle ) == "dotted") {echo 'checked';} ?>><label id="<?php echo esc_attr('borderstyle-3') ?>" for="<?php echo esc_attr('gb_type_3') ?>"><?php esc_html_e('Dotted','Bordered Blocks'); ?></label></fieldset>
											</td>
										</tr>								
										<tr>
											<th scope="row">
												<?php esc_html_e('Border Color:','Bordered Blocks'); ?> 
												<a href="<?php echo esc_url('#'); ?>" class="<?php echo esc_attr('help') ?>" title="<?php esc_attr_e('Choose the color of the borders.','Bordered Blocks'); ?>"><?php echo esc_html('?'); ?></a>
											</th>
											<td class="bordercolor">
												<input type="text" name="<?php echo esc_attr('gb_bordercolor') ?>" value="<?php echo esc_attr( $gb_bordercolor ) ?>" class="<?php echo esc_attr('field-colorpicker') ?>" />
											</td>
										</tr>
										<tr>
											<th scope="row">
												<?php esc_html_e('Border Width (1-10):','Bordered Blocks'); ?> 
												<a href="<?php echo esc_url('#'); ?>" class="<?php echo esc_attr('help') ?>" title="<?php esc_attr_e('Choose the width of the borders (1-10).','Bordered Blocks'); ?>"><?php echo esc_html('?'); ?></a>
											</th>
											<td class="borderwidth">
												<input type="number" min="1" max="10" name="<?php echo esc_attr('gb_borderwidth') ?>" value="<?php echo esc_attr( $gb_borderwidth ) ?>" /> px
											</td>
										</tr>
									</table>

								</td>
								<td rowspan="3" class="preview-cell">

									<div class="prev-block">
										<span class="block-label"><?php esc_html_e('HEADING','Bordered Blocks'); ?></span>
										<h3><?php esc_html_e('PREVIEW','Bordered Blocks'); ?></h3>
									</div>

									<p class="prev-block">
										<span class="block-label"><?php esc_html_e('PARAGRAPH','Bordered Blocks'); ?></span>
										<?php esc_html_e('This is to give you a very rough idea how the blocks will look in your editor. Actual results may be different, depending on your theme.','Bordered Blocks'); ?>
										<strong>
											<?php esc_html_e('To view changes before you save/submit the settings, select the button below:','Bordered Blocks'); ?>
										</strong>
									</p>

									<div class="prev-block">
										<span class="block-label"><?php esc_html_e('BUTTONS','Bordered Blocks'); ?></span>
										
										<div class="prev-block" style="display: inline-block;">
											<span class="block-label"><?php esc_html_e('BUTTON','Bordered Blocks'); ?></span>
											<input type="button" value="<?php _e('SHOW ME A PREVIEW!','Bordered Blocks'); ?>" class="button-preview button-primary"/>				
										</div>

									</div>

									<div class="prev-block columns" data-type="COLUMNS">
										<span class="block-label"><?php esc_html_e('COLUMNS','Bordered Blocks'); ?></span>
										
										<div class="prev-block column column-left" data-type="COLUMN">
											<span class="block-label"><?php esc_html_e('COLUMN','Bordered Blocks'); ?></span>

											<p class="prev-block"> 
												<span class="block-label"><?php esc_html_e('PARAGRAPH','Bordered Blocks'); ?></span>
												<?php esc_html_e('And now a picture of a beautiful girl:','Bordered Blocks'); ?>
											</p>

											<div class="prev-image" data-type="IMAGE">
												<span class="block-label"><?php esc_html_e('IMAGE','Bordered Blocks'); ?></span>
												<?php define('sophieURL', plugins_url('/assets/img/sophie.png', __FILE__)); ?>
												<img src="<?php echo esc_attr(sophieURL); ?>">												
											</div>											

										</div>
			
										<div class="prev-block column column-right" data-type="COLUMN">
											<span class="block-label"><?php esc_html_e('COLUMN','Bordered Blocks'); ?></span>
											
											<p class="prev-block"> 
												<span class="block-label"><?php esc_html_e('PARAGRAPH','Bordered Blocks'); ?></span>
												<?php esc_html_e('We also have space for an additional joke.','Bordered Blocks'); ?>
											</p>

											<div class="prev-block"> 
												<span class="block-label"><?php esc_html_e('LIST','Bordered Blocks'); ?></span>
												<ul>
													<li><?php esc_html_e('Q: What did the drummer call his twin daughters?','Bordered Blocks'); ?></li>
													<li><?php esc_html_e('A: Anna One, Anna Two.','Bordered Blocks'); ?></li>
												</ul>
											</div>	

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
										<tr>
											<th colspan="3" class="table-title">
												<input type="button" value="<?php esc_attr_e('Reset to defaults','Bordered Blocks'); ?>" class="button-reset-padding button-reset button-secondary"/>
												<h2><?php esc_html_e('Padding','Bordered Blocks'); ?></h2>
											</th>
										</tr>								
										<tr>
											<td> </td>
											<td>
												<input type="number" min="1" max="50" name="<?php echo esc_attr('gb_paddingtop') ?>" value="<?php echo esc_attr( $gb_paddingtop ) ?>" />
											</td>
											<td> </td>			
										</tr>
										<tr>
											<td>
												<input type="number" min="1" max="50" name="<?php echo esc_attr('gb_paddingleft') ?>" value="<?php echo esc_attr( $gb_paddingleft ) ?>" />
											</td>
											<td class="<?php echo esc_attr('padding-preview') ?>" style="<?php echo esc_attr( 'border:' ).esc_attr( $gb_borderstyle ).' '.esc_attr( $gb_borderwidth ).'px '.esc_attr( $gb_bordercolor ) ?>"> </td>
											<td>
												<input type="number" min="1" max="50" name="<?php echo esc_attr('gb_paddingright') ?>" value="<?php echo esc_attr( $gb_paddingright ) ?>" /> 
											</td>			
										</tr>
										<tr>
											<td> </td>
											<td>
												<input type="number" min="1" max="50" name="<?php echo esc_attr('gb_paddingbottom') ?>" value="<?php echo esc_attr( $gb_paddingbottom ) ?>" />
											</td>
											<td> </td>			
										</tr>																				
									</table>

								</td>							
							</tr>

							<tr>
								<td class="no-padding">

									<table class="label-table">
										<tr>
											<th colspan="2" class="table-title">
												<input type="<?php echo esc_attr('button') ?>" value="<?php esc_attr_e('Reset to defaults','Bordered Blocks'); ?>" class="button-reset-label button-reset button-secondary"/>
												<h2><?php esc_html_e('Labels','Bordered Blocks'); ?></h2>
											</th>
										</tr>	
										<tr>
											<th scope="row">
												<?php esc_html_e('Background color:','Bordered Blocks'); ?>
												<a href="<?php echo esc_url('#'); ?>" class="<?php echo esc_attr('help') ?>" title="<?php esc_attr_e('Choose the background of the labels.','Bordered Blocks'); ?>"><?php echo esc_html('?'); ?></a>
											</th>
											<td class="labelbackground">
												<input type="text" name="<?php echo esc_attr('gb_labelbackground') ?>" value="<?php echo esc_attr( $gb_labelbackground ) ?>" class="<?php echo esc_attr('field-colorpicker') ?>" />
											</td>
										</tr>								

										<tr>
											<th scope="row">
												<?php esc_html_e('Text Color:','Bordered Blocks'); ?> 
												<a href="<?php echo esc_url('#'); ?>" class="<?php echo esc_attr('help') ?>" title="<?php esc_attr_e('Choose the color of the labels.','Bordered Blocks'); ?>"><?php echo esc_html('?'); ?></a>
											</th>
											<td class="labelcolor">
												<input type="text" name="<?php echo esc_attr('gb_labelcolor') ?>" value="<?php echo esc_attr( $gb_labelcolor ) ?>" class="<?php echo esc_attr('field-colorpicker') ?>" />
											</td>
										</tr>

										<tr>
											<th scope="row">
												<?php esc_html_e('Text size (0-30):','Bordered Blocks'); ?> 
												<a href="<?php echo esc_url('#'); ?>" class="<?php echo esc_attr('help') ?>" title="<?php esc_attr_e('Choose the text size of the labels. If 0, no labels will be shown at all.','Bordered Blocks'); ?>"><?php echo esc_html('?'); ?></a>
											</th>
											<td class="borderwidth">
												<input type="number" min="1" max="30" name="<?php echo esc_attr('gb_labelsize') ?>" value="<?php echo esc_attr( $gb_labelsize ) ?>" /> px
											</td>
										</tr>

										<tr>
											<th scope="row">
												<?php esc_html_e('Opacity (0-10):','Bordered Blocks'); ?> 
												<a href="<?php echo esc_url('#'); ?>" class="<?php echo esc_attr('help') ?>" title="<?php esc_attr_e('Choose the opacity size of the labels. 0 = invisible, 10 = full opacity.','Bordered Blocks'); ?>"><?php echo esc_html('?'); ?></a>
											</th>
											<td class="borderwidth">
												<input type="number" min="1" max="10" name="<?php echo esc_attr('gb_labelopacity') ?>" value="<?php echo esc_attr( $gb_labelopacity ) ?>" />
											</td>
										</tr>
									</table>

								</td>							
							</tr>
						</table>

						<input type="<?php echo esc_attr('button') ?>" value="<?php esc_attr_e('Reset all to defaults','Bordered Blocks'); ?>" class="button-reset-all button-secondary"/>
						<input type="<?php echo esc_attr('button') ?>" value="<?php esc_attr_e('Preview','Bordered Blocks'); ?>" class="button-preview button-secondary"/>
						<input type="<?php echo esc_attr('submit') ?>" value="<?php esc_attr_e('SAVE SETTINGS','Bordered Blocks'); ?>" class="button-primary"/>

						<p>&nbsp;</p>
					</form>


				</div>

				<div id="borderedblocks-faq">
					<?php include 'assets/faq.php'; ?>
				</div>

				<div id="borderedblocks-supported-blocks">
					<?php include 'assets/supported-blocks.php'; ?>
				</div>

				<div id="borderedblocks-plugin-info">
					<?php include 'assets/plugin-info.php'; ?>
				</div>

			</div>

		</div>

	</div>

	<?php
	}

	function borderedblocks_admin_init() {
		add_action( 'admin_post_save_borderedblocks_options', 'borderedblocks_process_options' );
	}

/**
 * --- PROCESS THE SETTINGS FORM AFTER SUBMITTING ------------------------------------------------------
 */

	function borderedblocks_process_options() {

		if ( !current_user_can( 'manage_options' ))
			wp_die( 'Not allowed');

		check_admin_referer('borderedblocks');
		$options = get_option('borderedblocks_options');

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

		update_option( 'borderedblocks_options', $options );	

		if ($warning == 'true') {
	 		wp_redirect( add_query_arg(
	 			array('page' => 'borderedblocksconfig', 'message' => '1', 'warning' => '1', 'borderwarning' => $borderwarning, 'paddingwarning' => $paddingwarning, 'labelwarning' => $labelwarning, ),
	 			admin_url( 'options-general.php' ) 
	 			)
	 		);
		} else {
	 		wp_redirect( add_query_arg(
	 			array('page' => 'borderedblocksconfig', 'message' => '1'),
	 			admin_url( 'options-general.php' ) 
	 			)
	 		);	
 		}

		exit;
	}



/**
 * --- CONFIG .JS and .CSS  --------------------------------------------------------------
 */

	function borderedblocks_admin($hook) {
		if ($hook != 'settings_page_borderedblocksconfig') {
			return;
		}

		wp_register_script('borderedblocksAdminScript', plugins_url('/assets/js/bordered-blocks-admin.js', __FILE__), array( 'jquery' ), '1.0');
		wp_enqueue_script('borderedblocksAdminScript');

		wp_register_style('borderedblocksAdminStyle', plugins_url('/assets/css/bordered-blocks-admin.css', __FILE__) );
	    wp_enqueue_style('borderedblocksAdminStyle');		
	}


	function borderedblocks_color_picker( $hook_suffix ) {
	    wp_enqueue_style( 'wp-color-picker' );
	    wp_enqueue_script( 'borderedblocksColorpicker', plugins_url('/assets/js/colorpicker.js', __FILE__ ), array( 'wp-color-picker' ), false, true );
	}


/**
 * === HOOKS AND ACTIONS AND FILTERS AND SUCH ==========================================================
 */

	$plugin = plugin_basename(__FILE__); 

	register_activation_hook( __FILE__, 'borderedblocks_default_options' );
	add_action('enqueue_block_editor_assets', 'borderedblocks_styles' );
	add_action('admin_menu', 'borderedblocks_menu');
	add_action('admin_init', 'borderedblocks_admin_init' );
	add_action('admin_init', 'borderedblocks_version_update' );	
	add_action('admin_enqueue_scripts', 'borderedblocks_admin' );	
	add_action('admin_enqueue_scripts', 'borderedblocks_color_picker' );
	add_filter("plugin_action_links_$plugin", 'borderedblocks_settings_link' );

