<h3>Plugin info</h3>

<?php 
	$options = get_option('gutenborders_options');
	$version = $options['gb_version'];
?>

<div class="inner">

	<ul>
		<li><strong><?php _e('Author:','Gutenborders'); ?></strong> <a href="http://www.senff.com" target="_blank">Senff</a></li>
		<li><strong><?php _e('Version:','Gutenborders'); ?></strong> <?php echo $version; ?></li>
		<li><strong><?php _e('Detailed Documentation:','Gutenborders'); ?></strong> <a href="https://wordpress.org/plugins/gutenborders" target="_blank">WordPress.org</a></li>
		<li><strong><?php _e('Support Forum','Gutenborders'); ?></strong>: <a href="https://wordpress.org/support/plugin/gutenborders" target="_blank">WordPress.org</a></li>
		<li><strong><?php _e('Github:','Gutenborders'); ?></strong> <a href="https://github.com/senff/gutenborders" target="_blank">Code</a></li>
		<li><strong><?php _e('Donate:','Gutenborders'); ?></strong> <a href="https://paypal.senff.com" target="_blank">Paypal</a></li>
		<li><strong><?php _e('Twitter:','Gutenborders'); ?></strong> <a href="http://www.twitter.com/senff" target="_blank">@Senff</a></li>
	</ul>

</div>

<p><a href="https://wordpress.org/support/plugin/gutenborders" target="_blank"><strong><?php _e('Please Report Bugs','Gutenborders'); ?></strong></a></p>
