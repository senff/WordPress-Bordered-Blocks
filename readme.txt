=== Gutenborders ===
Contributors: senff, correliebre
Tags: gutenberg, borders, editor, blocks
Plugin URI: http://www.senff.com/
Requires at least: 5.9
Tested up to: 5.9
Stable tag: 0.91
License: GPLv3 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

The Gutenborders plugin will add borders to all your blocks in the editor. 

== Description ==

= Summary =

Gutenborders adds (customizable) borders and labels to all Blocks in the Post/Page editor, to give you a clearer overview of the structure of your content.

A toggle switch at the top of the page will allow you to quickly switch between the default editor view and the bordered view.


= Features =

* Adds borders and labels to your Blocks in the WordPress editor.
* Border styles and labels are customizable.
* Quickly switch between default view (showing the blocks without borders) and custom view (blocks with borders).


== Installation ==

1. Install Gutenborders from the WordPress Plugin Directory. Or, if that doesn't work:
2. Upload the "gutenborders" directory to your "wp-content/plugins" directory.
3. In your WordPress admin, go to PLUGINS and activate "Gutenborders"
4. When editing a Post or Page, notice the borders for every block.
5. Party!


== Frequently Asked Questions ==

= What does this plugin do, really?

By default, the WordPress editor is relatively clean and minimalistic. This is by design, but it can also be slightly confusing when you *only* the content itself (text & images) but not *which* Blocks are being used on the page, or how they're laid out. 
Gutenborders attempts to solve that by adding borders and labels to every Block in the editor, so you can get a better sense of the layout of your content.
Bonus: you can fully customize the size/color/type of the borders/labels to your needs.

= Doesn't that make the editor a lot more messy?

Although you can leave the "bordered" view on when you create/edit pages, it is not recommended, as it will indeed add a lot more information to the editor which may be distracting. It will also have some impact on the performance (although I'm working on that). The recommended use is to keep using the default editor view, and only sparingly flip the switch to show the borders and labels of the Blocks on the page.

= So wait, can borders be turned on and off instantly?

Pretty much, yes. In the plugin's settings, you can choose to have the editor show the standard view by default, or the bordered view. If you have the standard view, then flipping the switch at the top of the page will quickly show all borders/labels. If you have the bordered view, flipping the switch will quickly remove all borders/labels and go back to the standard view.

= Some of my blocks don't have a label, look weird, etc.

Gutenborders currently only supports the default Blocks that come with WordPress (support for WooCommerce and Jetpack is planned). If you have additional blocks added with plugins (or custom code), and they are not coded exactly following WordPress standards, they may not look as intended with borders and/or labels. If that's the case, please reach out to the plugin developer and have them check if all their Blocks have the proper naming with "data-title" attributes.
Also note that the way things look in your editor can also depend on your site's theme. If that's the case, try switching to a default theme temporarily (such as Twenty Twenty, Twenty Twenty-One or Twenty Twenty-Two).
If that resolves the issue, it's likely that your theme and Gutenborders are not compatible with eachother, and it's best to reach out to your theme's support team.
If you see that the issue still appears when your site is on a default theme, let me know at https://wordpress.org/support/plugin/gutenborders and I can look into it a bit more.

= What's next for Gutenborders?

The following items are currently on the roadmap:

* Support for WooCommerce Blocks
* Support for Jetpack Blocks
* Performance: have the main checkBlocks() JS function run only when a Block is being added/edited (currently it runs every second)

= What's with all the "!important" things in the code? That's bad CSS.

Nerd alert! It's not overly clean, I know. However, this is really needed to ensure that the styles you choose for the borders/labels override any inline styles coming from the editor itself and/or the theme.

= I have some ideas for this plugin. Where can I submit them?

Gutenborder's community support forum at https://wordpress.org/support/plugin/gutenborders is a good place, though if you want to add all sorts of technical details, it's best to report it on the plugin's Github page at https://github.com/senff/gutenborders/issues . This is also where I accept code contributions.

= My question isn't listed here.

Please go to the plugin's community support forum at https://wordpress.org/support/plugin/gutenborders and post a message. Note that support is provided on a voluntary basis and that it is always difficult to troubleshoot, as it will require access to your admin area (needless to say, NEVER include any passwords of your site on a public forum!


== Changelog ==

= 0.91 = 
* Security update

= 0.9 =
* Release candidate 1
* Support for all core blocks.

= 0.5 =
* Beta release 
* Global settings screen added

= 0.2 =
* Toggle button added

= 0.1 =
* Initial alpha release 

