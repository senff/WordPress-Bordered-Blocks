
<h2><?php _e('FAQ','Gutenborders'); ?>/<?php _e('Troubleshooting','Gutenborders'); ?></h2>

<p><strong><?php _e('Q: What does this plugin do, really?','Gutenborders'); ?></strong></p>

<p>By default, the WordPress editor is relatively clean and minimalistic. This is by design, but it can also be slightly confusing when you see all the content but not <em>which</em> Blocks are being used on the page, or <em>how they're laid out</em>.</p>

<p>Gutenborders adds borders and labels to every Block in the editor when you create/edit content, so you can get a better sense of the layout of your content.</p>

<p>Bonus: you can fully customize the size/color/type of the borders/labels to your needs.</p>

<p><strong><?php _e('Q: Doesn\'t that make the editor a lot more messy?','Gutenborders'); ?></strong></p>

<p>Although you <em>can</em> leave the "bordered" view on when you create/edit pages, <span class="bold-text">it is not recommended</span>, as it will indeed add a lot more information to the editor which may be distracting. It will also have some impact on the performance (although I'm working on that).  The recommended use is to keep using the default editor view, and only sparingly flip the switch to show the borders and labels of the Blocks on the page.</p>

<p><strong><?php _e('Q: So wait, can borders be turned on and off instantly?','Gutenborders'); ?></strong></p>

<p>Pretty much, yes. In the plugin's settings, you can choose to have the editor show the standard view by default, <em>or</em> the bordered view. If you have the standard view, then flipping the switch at the top of the page will quickly show all borders/labels. If you have the bordered view, flipping the switch will quickly remove all borders/labels and go back to the standard view.

<p><strong><?php _e('Q: Some of my blocks don\'t have a label, look weird, etc.','Gutenborders'); ?></strong></p>

<p>Gutenborders currently only supports the <em>default Blocks</em> that come with WordPress (support for WooCommerce and Jetpack is planned). If you have additional blocks added with plugins (or custom code), and they are not coded exactly following WordPress standards, they may not look as intended with borders and/or labels. If that's the case, please reach out to the plugin developer and have them check if all their Blocks have the proper naming with "data-title" attributes.</p>
<p>Also note that the way things look in your editor can also depend on your site's theme. If that's the case, try switching to a default theme temporarily (such as <span class="bold-text">Twenty Twenty</span>, <span class="bold-text">Twenty Twenty-One</span> or <span class="bold-text">Twenty Twenty-Two</span>).</p> 
<p>If that resolves the issue, it's likely that your theme and Gutenborders are not compatible with eachother, and it's best to reach out to your theme's support team.<br>If you see that the issue <em>still</em> appears when your site is on a default theme, <a href="https://wordpress.org/support/plugin/gutenborders" target="_blank">let me know</a> and I can look into it a bit more.</p>

<p><strong><?php _e('Q: What\'s next for Gutenborders?','Gutenborders'); ?></strong></p>
<p>The following items are currently on the roadmap:</p>
<ul>
	<li>Support for WooCommerce Blocks</li>
	<li>Support for Jetpack Blocks</li>
	<li>Performance: have the main <span class="bold-text">checkBlocks()</span> JS function run <em>only</em> when a Block is being added/edited (currently it runs every second)</li>
</ul>

<p><strong><?php _e('Q: What\'s with all the "!important" things in the code? That\'s bad CSS.','Gutenborders'); ?></strong></p>
<p>Nerd alert! It's not overly clean, I know. However, this is really needed to ensure that the styles you choose for the borders/labels override any inline styles coming from the editor itself and/or the theme.</p>

<p><strong><?php _e('Q: I have some ideas for this plugin. Where can I submit them?','Gutenborders'); ?></strong></p>
<p>Gutenborder's <a href="https://wordpress.org/support/plugin/gutenborders" target="_blank">community support forum</a> is a good place, though if you want to add all sorts of <em>technical</em> details, it's best to report it on the plugin's <a href="https://github.com/senff/gutenborders/issues" target="_blank">Github page</a>. This is also where I accept code contributions.</p>

<p><strong><?php _e('Q: My question isn\'t listed here.','Gutenborders'); ?></strong></p>
<p>Please go to the plugin's <a href="https://wordpress.org/support/plugin/gutenborders" target="_blank">community support forum</a> and post a message. Note that support is provided on a voluntary basis and that it is always difficult to troubleshoot, as it will require access to your admin area (needless to say, <span class="bold-text">NEVER</span> include any passwords of your site on a public forum!</p>