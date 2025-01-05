<h2>
	<?php esc_html_e('FAQ','bordered-blocks'); ?>/<?php esc_html_e('Troubleshooting','bordered-blocks'); ?>
</h2>

<p>
	<strong>
		<?php esc_html_e('What does this plugin do, really?','bordered-blocks'); ?>
	</strong>
</p>

<p>
	<?php esc_html_e('By default, the WordPress editor is relatively clean and minimalistic. This is by design, but it can also be slightly confusing when you -only- the content itself (text & images) but not -which- Blocks are being used on the page, or how they\'re laid out.','bordered-blocks'); ?>
</p>

<p>
	<?php esc_html_e('Bordered Blocks attempts to solve that by adding borders and labels to every Block in the editor, so you can get a better sense of the layout of your content.','bordered-blocks'); ?>
</p>

<p>
	<?php esc_html_e('Bonus: you can fully customize the size/color/type of the borders/labels to your needs.','bordered-blocks'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('Doesn\'t that make the editor a lot more messy?','bordered-blocks'); ?>
	</strong>
</p>

<p>
	<?php esc_html_e('Although you -can- leave the "bordered" view on when you create/edit pages,','bordered-blocks'); ?>
	<span class="bold-text">
		<?php esc_html_e('it is not recommended','bordered-blocks'); ?>
	</span>, 
	<?php esc_html_e('as it will indeed add a lot more information to the editor which may be distracting. It will also have some impact on the performance (although I\'m working on that).  The recommended use is to keep using the default editor view, and only sparingly flip the switch to show the borders and labels of the Blocks on the page.','bordered-blocks'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('Can borders be turned on and off instantly in the editor?','bordered-blocks'); ?>
	</strong>
</p>

<p>
	<?php esc_html_e('While that used to be the case until version 1.1.3, this option has been removed for now as it did not appear to be working anymore with WordPress 6.6.2. I will look into adding this again, but for now, the borders are always showing in the editor as long as the plugin is active.','bordered-blocks'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('Some of my blocks don\'t have a label, look weird, etc.','bordered-blocks'); ?>
	</strong>
</p>

<p>
	<?php esc_html_e('Bordered Blocks currently only supports the default Blocks that come with WordPress and WooCommerce. If you have additional blocks added with plugins (or custom code), and they are not coded exactly following WordPress standards, they may not look as intended with borders and/or labels. If that\'s the case, please reach out to the plugin developer and have them check if all their Blocks have the proper naming with "data-title" attributes.','bordered-blocks'); ?>
</p>

<p>
	<?php esc_html_e('Also note that the way things look in your editor can also depend on your site\'s theme. To check that, try switching to a default theme temporarily (such as ','bordered-blocks'); ?>
	<span class="bold-text"><?php esc_html_e('Twenty Twenty','bordered-blocks'); ?></span>, 
	<span class="bold-text"><?php esc_html_e('Twenty Twenty-One','bordered-blocks'); ?></span> or 
	<span class="bold-text"><?php esc_html_e('Twenty Twenty-Two','bordered-blocks'); ?></span><?php esc_html_e(').','bordered-blocks'); ?>
</p> 

<p>
	<?php esc_html_e('If that resolves the issue, it\'s likely that your theme and Bordered Blocks are not compatible with eachother, and it\'s best to reach out to your theme\'s support team.','bordered-blocks'); ?>
	<br>
	<?php esc_html_e('If you see that the issue -still- appears when your site is on a default theme, ','bordered-blocks'); ?>
	<a href="https://wordpress.org/support/plugin/bordered-blocks" target="_blank"><?php esc_html_e('let me know','bordered-blocks'); ?></a>
	<?php esc_html_e('and I can try to look into it a bit more.','bordered-blocks'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('What\'s next for Bordered Blocks?','bordered-blocks'); ?>
	</strong>
</p>

<p>
	<?php esc_html_e('The following items are ','bordered-blocks'); ?>
	<span class="bold-text"><?php esc_html_e('currently not supported','bordered-blocks'); ?></span>, 
	<?php esc_html_e('but -are- on the roadmap:','bordered-blocks'); ?></p>
<ul>
	<li>
		<?php esc_html_e('Re-introducing the toggle to show/hide borders instantly in the editor','bordered-blocks'); ?>
	</li>	
	<li>
		<?php esc_html_e('Support for Jetpack Blocks','bordered-blocks'); ?>
	</li>
	<li>
		<?php esc_html_e('Performance: have the main "checkBlocks()" JS function run -only- when a Block is being added/edited (currently it runs every second)','bordered-blocks'); ?>
	</li>
	<li>
		<?php esc_html_e('Full multi-language support','bordered-blocks'); ?>
	</li>
</ul>

<p>
	<strong>
		<?php esc_html_e('What\'s with all the "!important" things in the code? That\'s bad CSS.','bordered-blocks'); ?>
	</strong>
</p>
<p>
	<?php esc_html_e('Nerd alert! It\'s not overly clean, I know. However, this is really needed to ensure that the styles you choose for the borders/labels override any inline styles coming from the editor itself and/or the theme.','bordered-blocks'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('I have some ideas for this plugin. Where can I submit them?','bordered-blocks'); ?>
	</strong>
</p>
<p>
	<?php esc_html_e('Bordered Blocks\'','bordered-blocks'); ?>
	<a href="https://wordpress.org/support/plugin/bordered-blocks" target="_blank"><?php esc_html_e('community support forum','bordered-blocks'); ?></a> 
	<?php esc_html_e('is a good place, though if you want to add all sorts of -technical- details, it\'s best to report it on the plugin\'s ','bordered-blocks'); ?>
	<a href="https://github.com/senff/bordered-blocks/issues" target="_blank"><?php esc_html_e('Github page','bordered-blocks'); ?></a>
	<?php esc_html_e('This is also where I consider code contributions.','bordered-blocks'); ?>
</p>

<p>
	<strong>
		<?php esc_html_e('Q: My question isn\'t listed here?','bordered-blocks'); ?>
	</strong>
</p>
<p>
	<?php esc_html_e('Please go to the plugin\'s ','bordered-blocks'); ?>
	<a href="https://wordpress.org/support/plugin/bordered-blocks'" target="_blank"><?php esc_html_e('community support forum','bordered-blocks'); ?></a>
	<?php esc_html_e('and post a message. Note that support is provided on a voluntary basis and that it is always difficult to troubleshoot, as it will require access to your admin area. Needless to say,','bordered-blocks'); ?>
	<span class="bold-text" style="color:#ff0000;">
		<?php esc_html_e('NEVER include any passwords of your site on a public forum!','bordered-blocks'); ?>
	</span>
</p>
