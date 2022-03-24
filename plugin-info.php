<h3>Plugin info</h3>

<?php 
	$options = get_option('gutenborders_version');
	$version = $options['gb_num'];
?>

<div class="inner">

	<ul>
		<li><strong><?php _e('Author:','Gutenborders'); ?></strong> <a href="https://profiles.wordpress.org/senff/" target="_blank">Senff</a></li>
		<li><strong><?php _e('Version:','Gutenborders'); ?></strong> <?php echo $version; ?></li>
		<li><strong><?php _e('Detailed Documentation:','Gutenborders'); ?></strong> <a href="https://wordpress.org/plugins/gutenborders" target="_blank">WordPress.org</a></li>
		<li><strong><?php _e('Support Forum','Gutenborders'); ?></strong>: <a href="https://wordpress.org/support/plugin/gutenborders" target="_blank">WordPress.org</a></li>
		<li><strong><?php _e('Github:','Gutenborders'); ?></strong> <a href="https://github.com/senff/gutenborders" target="_blank">Code</a></li>
		<li><strong><?php _e('Donate:','Gutenborders'); ?></strong> <a href="https://paypal.senff.com" target="_blank">Paypal</a></li>
		<li><strong><?php _e('Twitter:','Gutenborders'); ?></strong> <a href="http://www.twitter.com/senff" target="_blank">@Senff</a></li>
	</ul>

</div>

<p><?php _e('Please report bugs or feature requests on <a href="https://wordpress.org/support/plugin/gutenborders" target="_blank"><strong>WordPress.org</strong></a>','Gutenborders'); ?>.</p>
