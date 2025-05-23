# Bordered Blocks
* Contributors: senff, correliebre
* Donate link: https://donate.senff.com
* Tags: gutenberg, borders, editor, blocks, labels
* Plugin URI: https://wordpress.org/plugins/bordered-blocks/
* Requires at least: 5.9
* Tested up to: 6.7
* Stable tag: 1.1.6
* License: GPLv3 or later
* License URI: http://www.gnu.org/licenses/gpl-3.0.html

Bordered Blocks adds subtle borders to all blocks in the WordPress Post/Page editor.


## Description

### Summary

Bordered Blocks adds (customizable) borders and labels to all Blocks in the Post/Page editor, to give you an instant overview of the layout of your page and how all Blocks relate to eachother.

Choose between the default CLEAN view, or a CLEAR view.


### Features

* Adds borders and labels to your Blocks in the WordPress editor.
* Border styles and labels are customizable; change the color, size, type you prefer.
* Quickly switch between default clean view (showing the blocks without borders) and custom clear view (blocks with borders).

## Installation 

1. Install Bordered Blocks from the WordPress Plugin Directory. Or, if that doesn't work:
2. Download the Bordered Blocks plugin from the WordPress Plugin Directory and unzip the file.
3. Upload the "bordered-blocks" directory to your "wp-content/plugins" directory.
4. In your WordPress admin, go to PLUGINS and activate "Bordered Blocks".
5. When editing a Post or Page, select the "Show borders/labels" switch at the top of the page.
6. Notice the borders for every block.
7. Party!


## Frequently Asked Questions

### What does this plugin do, really?

By default, the WordPress editor is relatively clean and minimalistic. This is by design, but it can also be slightly confusing when you *only* the content itself (text & images) but not *which* Blocks are being used on the page, or how they're laid out. 
Bordered Blocks attempts to solve that by adding borders and labels to every Block in the editor, so you can get a better sense of the layout of your content.
Bonus: you can fully customize the size/color/type of the borders/labels to your needs.

### Doesn't that make the editor a lot more messy?

Although you can leave the "bordered" view on when you create/edit pages, it is not recommended, as it will indeed add a lot more information to the editor which may be distracting. It will also have some impact on the performance (although I'm working on that). The recommended use is to keep using the default editor view, and only sparingly flip the switch to show the borders and labels of the Blocks on the page.

### Can borders be turned on and off instantly?

While that used to be the case until version 1.1.3, this option has been removed for now as it did not appear to be working anymore with WordPress 6.6.2. I will look into adding this again, but for now, the borders are always showing in the editor as long as the plugin is active.

### Some of my blocks don't have a label, look weird, etc.

Bordered Blocks currently only supports the default Blocks that come with WordPress (support for WooCommerce and Jetpack is planned). If you have additional blocks added with plugins (or custom code), and they are not coded exactly following WordPress standards, they may not look as intended with borders and/or labels. If that's the case, please reach out to the plugin developer and have them check if all their Blocks have the proper naming with "data-title" attributes.
Also note that the way things look in your editor can also depend on your site's theme. If that's the case, try switching to a default theme temporarily (such as Twenty Twenty, Twenty Twenty-One or Twenty Twenty-Two).
If that resolves the issue, it's likely that your theme and Bordered Blocks are not compatible with eachother, and it's best to reach out to your theme's support team.
If you see that the issue still appears when your site is on a default theme, let me know at https://wordpress.org/support/plugin/bordered-blocks and I can look into it a bit more.

### What's next for Bordered Blocks?

The following items are currently not supported, but are on the roadmap:

* Support for Jetpack Blocks
* Performance: have the main checkBlocks() JS function run only when a Block is being added/edited (currently it runs every second)
* Full multi-language support

### What's with all the "!important" things in the code? That's bad CSS.

Nerd alert! It's not overly clean, I know. However, this is really needed to ensure that the styles you choose for the borders/labels override any inline styles coming from the editor itself and/or the theme.

### I have some ideas for this plugin. Where can I submit them?

Bordered Blocks' community support forum at https://wordpress.org/support/plugin/bordered-blocks is a good place, though if you want to add all sorts of technical details, it's best to report it on the plugin's Github page at https://github.com/senff/bordered-blocks/issues . This is also where I accept code contributions.

### My question isn't listed here.

Please go to the plugin's community support forum at https://wordpress.org/support/plugin/bordered-blocks and post a message. Note that support is provided on a voluntary basis and that it is always difficult to troubleshoot, as it will require access to your admin area (needless to say, NEVER include any passwords of your site on a public forum!


## Screenshots

1. Your Blocks now have borders!
2. For reference: the default, borderless editor view
3. Settings screen


## Changelog

### 1.1.6
* Removed old JS routine that caused error message in console.

### 1.1.5
* Adjusted some code to better adhere to plugin standards.

### 1.1.4
* Removed the ON/OFF toggle in the editor since it was not working with WordPress 6.6.2

### 1.1.3
* Fixed JS issue that appeared when saving settings
* Fixed jQuery issue to make toggle button appear again
* Fixed CSS to position H1 label properly

### 1.1.2
* Database version bug fix

### 1.1.1
* Compatibility Update

### 1.1 
* Added support for WooCommerce Blocks

### 1.0
* Public release


## Upgrade Notice 

### 1.1.6
* JS bug fix

### 1.1.5
* Code updates

### 1.1.4
* Emergency fix

### 1.1.3
* Bug fixes

### 1.1.2
* Bug fix

### 1.1.1
* Compatibility Update

### 1.1 
* Added support for WooCommerce Blocks

### 1.0
* Public release