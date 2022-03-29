<h2>
	<?php esc_html_e('FAQ','Bordered Blocks'); ?>/<?php esc_html_e('Troubleshooting','Bordered Blocks'); ?>
</h2>

<p>
	<strong>
		<?php esc_html_e('What does this plugin do, really?','Bordered Blocks'); ?>
	</strong>
</p>

<p>
	<?php esc_html_e('By default, the WordPress editor is relatively clean and minimalistic. This is by design, but it can also be slightly confusing when you -only- the content itself (text & images) but not -which- Blocks are being used on the page, or how they\'re laid out.','Bordered Blocks'); ?>
</p>

<p>
	<?php esc_html_e('Bordered Blocks attempts to solve that by adding borders and labels to every Block in the editor, so you can get a better sense of the layout of your content.','Bordered Blocks'); ?>
</p>

<p>
	<?php esc_html_e('Bonus: you can fully customize the size/color/type of the borders/labels to your needs.','Bordered Blocks'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('Doesn\'t that make the editor a lot more messy?','Bordered Blocks'); ?>
	</strong>
</p>

<p>
	<?php esc_html_e('Although you -can- leave the "bordered" view on when you create/edit pages,','Bordered Blocks'); ?>
	<span class="bold-text">
		<?php esc_html_e('it is not recommended','Bordered Blocks'); ?>
	</span>, 
	<?php esc_html_e('as it will indeed add a lot more information to the editor which may be distracting. It will also have some impact on the performance (although I\'m working on that).  The recommended use is to keep using the default editor view, and only sparingly flip the switch to show the borders and labels of the Blocks on the page.','Bordered Blocks'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('So wait, can borders be turned on and off instantly?','Bordered Blocks'); ?>
	</strong>
</p>

<p>
	<?php esc_html_e('Pretty much, yes. In the plugin\'s settings, you can choose to have the editor show the standard view by default, -OR- the bordered view. If you have the standard view, then flipping the switch at the top of the page will quickly show all borders/labels. If you have the bordered view, flipping the switch will quickly remove all borders/labels and go back to the standard view.','Bordered Blocks'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('Some of my blocks don\'t have a label, look weird, etc.','Bordered Blocks'); ?>
	</strong>
</p>

<p>
	<?php esc_html_e('Bordered Blocks currently only supports the default Blocks that come with WordPress (support for WooCommerce and Jetpack is planned). If you have additional blocks added with plugins (or custom code), and they are not coded exactly following WordPress standards, they may not look as intended with borders and/or labels. If that\'s the case, please reach out to the plugin developer and have them check if all their Blocks have the proper naming with "data-title" attributes.','Bordered Blocks'); ?>
</p>

<p>
	<?php esc_html_e('Also note that the way things look in your editor can also depend on your site\'s theme. To check that, try switching to a default theme temporarily (such as ','Bordered Blocks'); ?>
	<span class="bold-text"><?php esc_html_e('Twenty Twenty','Bordered Blocks'); ?></span>, 
	<span class="bold-text"><?php esc_html_e('Twenty Twenty-One','Bordered Blocks'); ?></span> or 
	<span class="bold-text"><?php esc_html_e('Twenty Twenty-Two','Bordered Blocks'); ?></span><?php esc_html_e(').','Bordered Blocks'); ?>
</p> 

<p>
	<?php esc_html_e('If that resolves the issue, it\'s likely that your theme and Bordered Blocks are not compatible with eachother, and it\'s best to reach out to your theme\'s support team.','Bordered Blocks'); ?>
	<br>
	<?php esc_html_e('If you see that the issue -still- appears when your site is on a default theme, ','Bordered Blocks'); ?>
	<a href="<?php echo esc_url('https://wordpress.org/support/plugin/bordered-blocks'); ?>" target="_blank"><?php esc_html_e( 'let me know','Bordered Blocks'); ?></a>
	<?php esc_html_e('and I can try to look into it a bit more.','Bordered Blocks'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('What\'s next for Bordered Blocks?','Bordered Blocks'); ?>
	</strong>
</p>

<p>
	<?php esc_html_e('The following items are ','Bordered Blocks'); ?>
	<span class="bold-text"><?php esc_html_e('currently not supported','Bordered Blocks'); ?></span>, 
	<?php esc_html_e('but -are- on the roadmap:','Bordered Blocks'); ?></p>
<ul>
	<li>
		<?php esc_html_e('Support for WooCommerce Blocks','Bordered Blocks'); ?>
	</li>
	<li>
		<?php esc_html_e('Support for Jetpack Blocks','Bordered Blocks'); ?>
	</li>
	<li>
		<?php esc_html_e('Performance: have the main "checkBlocks()" JS function run -only- when a Block is being added/edited (currently it runs every second)','Bordered Blocks'); ?>
	</li>
	<li>
		<?php esc_html_e('Multi-language support','Bordered Blocks'); ?>
	</li>
</ul>

<p>
	<strong>
		<?php esc_html_e('What\'s with all the "!important" things in the code? That\'s bad CSS.','Bordered Blocks'); ?>
	</strong>
</p>
<p>
	<?php esc_html_e('Nerd alert! It\'s not overly clean, I know. However, this is really needed to ensure that the styles you choose for the borders/labels override any inline styles coming from the editor itself and/or the theme.','Bordered Blocks'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('I have some ideas for this plugin. Where can I submit them?','Bordered Blocks'); ?>
	</strong>
</p>
<p>
	<?php esc_html_e('Bordered Blocks\'','Bordered Blocks'); ?>
	<a href="<?php echo esc_url('https://wordpress.org/support/plugin/bordered-blocks'); ?>" target="_blank"><?php esc_html_e( 'community support forum','Bordered Blocks'); ?></a> 
	<?php esc_html_e('is a good place, though if you want to add all sorts of -technical- details, it\'s best to report it on the plugin\'s ','Bordered Blocks'); ?>
	<a href="<?php echo esc_url('https://github.com/senff/bordered-blocks/issues'); ?>" target="_blank"><?php esc_html_e( 'Github page','Bordered Blocks'); ?></a>
	<?php esc_html_e('This is also where I consider code contributions.','Bordered Blocks'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('Q: My question isn\'t listed here?','Bordered Blocks'); ?>
	</strong>
</p>
<p>
	<?php esc_html_e('Please go to the plugin\'s ','Bordered Blocks'); ?>
	<a href="<?php echo esc_url('https://wordpress.org/support/plugin/bordered-blocks'); ?>" target="_blank"><?php esc_html_e( 'community support forum','Bordered Blocks'); ?></a>
	<?php esc_html_e('and post a message. Note that support is provided on a voluntary basis and that it is always difficult to troubleshoot, as it will require access to your admin area. Needless to say,','Bordered Blocks'); ?>
	<span class="bold-text" style="color:#ff0000;">
		<?php esc_html_e('NEVER include any passwords of your site on a public forum!','Bordered Blocks'); ?>
	</span>
</p>
