<h3>
	<?php esc_html_e('Plugin info','Bordered Blocks'); ?>
</h3>

<?php 
	$options = get_option('borderedblocks_version');
	$version = $options['gb_num'];
?>

<div class="inner">

	<ul>
		<li><strong>
			<?php esc_html_e('Author:','Bordered Blocks'); ?>
			</strong> 
			<a href="<?php echo esc_url('https://profiles.wordpress.org/senff/'); ?>" target="_blank"><?php esc_html_e( 'Senff','Bordered Blocks'); ?></a>
		</li>
		<li><strong>
			<?php esc_html_e('Version:','Bordered Blocks'); ?>
			</strong> 
			<?php echo esc_html($version); ?>
		</li>
		<li><strong>
			<?php esc_html_e('Detailed Documentation:','Bordered Blocks'); ?>
			</strong> 
			<a href="<?php echo esc_url('https://wordpress.org/plugins/bordered-blocks'); ?>" target="_blank"><?php esc_html_e( 'WordPress.org','Bordered Blocks'); ?></a>
		</li>
		<li><strong>
			<?php esc_html_e('Support Forum','Bordered Blocks'); ?>
			</strong>: 
			<a href="<?php echo esc_url('https://wordpress.org/support/plugin/bordered-blocks'); ?>" target="_blank"><?php esc_html_e( 'WordPress.org','Bordered Blocks'); ?></a>
		</li>
		<li><strong>
			<?php esc_html_e('Github:','Bordered Blocks'); ?>
			</strong> 
			<a href="<?php echo esc_url('https://github.com/senff/bordered-blocks'); ?>" target="_blank"><?php esc_html_e( 'Code','Bordered Blocks'); ?></a>
		</li>
		<li><strong>
			<?php esc_html_e('Donate:','Bordered Blocks'); ?>
			</strong> 
			<a href="<?php echo esc_url('https://paypal.senff.com'); ?>" target="_blank"><?php esc_html_e( 'Paypal','Bordered Blocks'); ?></a>
		</li>
		<li><strong>
			<?php esc_html_e('Twitter:','Bordered Blocks'); ?>
			</strong> 
			<a href="<?php echo esc_url('http://www.twitter.com/senff'); ?>" target="_blank"><?php esc_html_e( '@senff','Bordered Blocks'); ?></a>
		</li>
	</ul>

</div>

<p>
	<?php esc_html_e('Please report bugs or feature requests on ','Bordered Blocks'); ?>
	<strong>
		<a href="<?php echo esc_url('https://wordpress.org/support/plugin/bordered-blocks'); ?>" target="_blank"><?php esc_html_e( 'WordPress.org','Bordered Blocks'); ?></a>
	</strong>
</p>
