jQuery(function($) {

    let blocksOnPage = new Array();
    let embedsOnPage = new Array();

    // Variables from database
    let bordershow = borderedblocks_loader.bordershow;
    let bordercolor = borderedblocks_loader.bordercolor;
    let borderstyle = borderedblocks_loader.borderstyle;
    let borderwidth = borderedblocks_loader.borderwidth;
    let paddingtop = borderedblocks_loader.paddingtop;
    let paddingright = borderedblocks_loader.paddingright;
    let paddingbottom = borderedblocks_loader.paddingbottom;
    let paddingleft = borderedblocks_loader.paddingleft;
    let labelcolor = borderedblocks_loader.labelcolor;
    let labelbackground = borderedblocks_loader.labelbackground;
    let labelopacity = borderedblocks_loader.labelopacity;
    let labelsize = borderedblocks_loader.labelsize;

    // Reference to the editor iframe's document, set once the iframe is ready
    var editorDoc = null;

    // Escapes a string for safe use inside a CSS quoted string
    function escapeCSSString(str) {
        return str ? str.replace(/\\/g, '\\\\').replace(/"/g, '\\"') : '';
    }

    // Returns the editor canvas iframe's document once it's loaded, or null if not ready yet.
    // Falls back to the parent document for older WordPress versions without the iframed canvas.
    function getEditorDocument() {
        var iframe = document.querySelector('iframe[name="editor-canvas"]');
        if (iframe && iframe.contentDocument && iframe.contentDocument.readyState === 'complete') {
            return iframe.contentDocument;
        }
        if (document.querySelector('.editor-styles-wrapper')) {
            return document;
        }
        return null;
    }

    // Builds the CSS string for user-configured border/padding/label styles
    function buildCssVar() {
        let cssVar = '.editor-styles-wrapper.borderedblocks .wp-block, .editor-styles-wrapper.borderedblocks *[data-title], .editor-styles-wrapper.borderedblocks .contains-blocks[data-title] *[data-title]{';
        cssVar += 'border: '+borderstyle+' '+borderwidth+'px '+bordercolor+' !important;';
        cssVar += 'padding: '+paddingtop+'px '+paddingright+'px '+paddingbottom+'px '+paddingleft+'px !important; margin-bottom: 20px !important;}';
        if (labelsize < 1) {
            cssVar += '.editor-styles-wrapper.borderedblocks .wp-block:before  {display: none;}';
        } else {
            cssVar += '.editor-styles-wrapper.borderedblocks .wp-block::before, .editor-styles-wrapper.borderedblocks .wp-block *[data-title]::before {';
            cssVar += 'font-size:'+labelsize+'px;height:'+(labelsize*1.5)+'px;line-height:'+(labelsize*1.5)+'px;background:'+labelbackground+';color:'+labelcolor+';opacity:'+(labelopacity/10)+';';
            cssVar += '}';
        }
        cssVar += '.editor-styles-wrapper.borderedblocks .wp-block.contains-blocks[data-title] {position: relative; padding: 0 !important; border: none;}';
        cssVar += '.editor-styles-wrapper.borderedblocks .wp-block.contains-blocks::before {display: none;}';
        cssVar += '.editor-styles-wrapper.borderedblocks hr.wp-block-separator[data-title], .editor-styles-wrapper.borderedblocks .contains-blocks[data-title] hr[data-title] {padding: 0 !important;} .editor-styles-wrapper.borderedblocks hr.wp-block-separator:after {display: none;}';
        cssVar += '.editor-styles-wrapper.borderedblocks .wp-block[data-title="Social Icon"] {border: none; padding: 0 !important; margin-bottom: 0 !important;} .editor-styles-wrapper.borderedblocks .wp-block.contains-blocks[data-title="Social Icons"] *[data-title="Social Icon"] {border: none; padding: 0 !important; margin-bottom: 0 !important;} .editor-styles-wrapper.borderedblocks .wp-block[data-title="Social Icon"]:before {display: none;}';
        return cssVar;
    }

    // Injects style containers and initial CSS into the iframe, and sets the default toggle state
    function initEditorStyles(doc) {
        $(doc.body).append('<style type="text/css" id="borderedBlocks-css-dynamic"></style><style type="text/css" id="borderedBlocks-css-variable"></style>');
        $(doc).find('#borderedBlocks-css-variable').html(buildCssVar());
        if (bordershow) {
            $(doc).find('.editor-styles-wrapper').addClass('borderedblocks');
        }
    }

    // This function SHOULD run every time a new block is added, or when an existing block is changed.
    // Right now, it will just run every second, and will output an array with all the block types on the page.
    function checkBlocks() {
        if (!editorDoc) return;

        // LOOP: check all blocks types and add them to an array.
        // The array also contains blocks that are on the page before (this saves us from clearing the entire
        // array and write it from scratch again)
        $(editorDoc).find('.editor-styles-wrapper .wp-block').each(function(block) {
            // Add a label
            if ($(this)[0].hasAttribute('data-title')) {
                blockType = $(this).attr('data-title');
                if (!($(this).children().first().hasClass('borderedblocks-label')) && (typeof blockType != 'undefined')) {
                    $(this).addClass('has-borderedblocks-label').attr('borderedblocks-label',blockType);
                }
                if (!blocksOnPage.includes(blockType) && (typeof blockType != 'undefined')) {
                    blocksOnPage.push(blockType);
                }
                if ($(this).attr('data-title') == 'Post Navigation Link') {
                    linkType = $(this).find('a').attr('aria-label');
                    $(this).attr('borderedblocks-label',linkType);
                }
                if ($(this).attr('data-title') == 'Embed') {
                    embedType = $(this).find('iframe').attr('title');
                    $(this).attr('borderedblocks-label',embedType);
                    embedsOnPage.push(embedType);
                }
            } else if ($(this).hasClass('wp-block-post-title')) {
                $(this).attr('data-title','H1 Title');
            } else if (!$(this).find('.block-editor-inserter').length) {
                // The block is not stand-alone; instead, it contains other blocks. It's either a wrapper or
                // alignment or... etc. etc. but NOT an empty block.
                $(this).addClass('contains-blocks');
                childType = $(this).find('[data-title]').first().attr('data-title');
                $(this).attr('data-title',childType);
            }
        });

        // Generate CSS that applies to all blocks
        // This CSS code also includes blocks that were on the page before.
        let cssCode = '';
        blocksOnPage.forEach(function(blockType) {
            var safe = escapeCSSString(blockType);
            cssCode += '.editor-styles-wrapper.borderedblocks .wp-block[data-title="'+blockType+'"]:before {content: "'+safe+'";} .editor-styles-wrapper.borderedblocks .wp-block[data-title="'+blockType+'"] *[data-title="'+blockType+'"]:before {content: "'+safe+'";} ';
        });

        embedsOnPage.forEach(function(embedType) {
            var safe = escapeCSSString(embedType);
            cssCode += '.editor-styles-wrapper.borderedblocks .wp-block[borderedblocks-label="'+embedType+'"]:before {content: "'+safe+'";} .editor-styles-wrapper.borderedblocks .wp-block[borderedblocks-label="'+embedType+'"] *[data-title="Embed"]:before {content: "'+safe+'";} ';
        });

        // There's a few exceptions (thanks to the WordPress editor inconsistencies), so we'll need to add those.
        cssCode += '.editor-styles-wrapper.borderedblocks .wp-block.taxonomy-category:before {content: "Post Categories";}';
        cssCode += '.editor-styles-wrapper.borderedblocks .wp-block.taxonomy-post_tag:before {content: "Post Tags";}';
        cssCode += '.editor-styles-wrapper.borderedblocks .wp-block[borderedblocks-label="Next post"]:before {content: "Next Post";}';
        cssCode += '.editor-styles-wrapper.borderedblocks .wp-block[borderedblocks-label="Previous post"]:before {content: "Previous Post";}';
        cssCode += '.editor-styles-wrapper.borderedblocks .wp-block.wp-block-query-title:before {content: "Archive Title";}';

        $(editorDoc).find('#borderedBlocks-css-dynamic').html(cssCode);
    }

    // Whether the toggle button (and the borders) should be ON or OFF by default
    let checkedornot = '';
    if (bordershow) {
        checkedornot = 'checked';
    }

    function addToggle() {
        // Adding the toggle button to the parent document toolbar
        // First line is updated - we can remove the second line a few versions down the road.
        $('.editor-document-tools__left').append('<div class="borderedblocks-header"><span class="borderedblocks-toggle components-form-toggle is-'+checkedornot+'"><input class="components-form-toggle__input" id="borderedblocks-toggle" type="checkbox" aria-describedby="inspector-toggle-contr-0__help" '+checkedornot+'><span class="components-form-toggle__track"></span><span class="components-form-toggle__thumb"></span><label for="borderedblocks-toggle">Show borders/labels</label></span></div>').addClass('hasToggle');
        $('.edit-post-header-toolbar__left').append('<div class="borderedblocks-header"><span class="borderedblocks-toggle components-form-toggle is-'+checkedornot+'"><input class="components-form-toggle__input" id="borderedblocks-toggle" type="checkbox" aria-describedby="inspector-toggle-contr-0__help" '+checkedornot+'><span class="components-form-toggle__track"></span><span class="components-form-toggle__thumb"></span><label for="borderedblocks-toggle">Show borders/labels</label></span></div>').addClass('hasToggle');
        $('.edit-widgets-header__navigable-toolbar-wrapper').append('<div class="borderedblocks-header"><span class="borderedblocks-toggle components-form-toggle is-'+checkedornot+'"><input class="components-form-toggle__input" id="borderedblocks-toggle" type="checkbox" aria-describedby="inspector-toggle-contr-0__help" '+checkedornot+'><span class="components-form-toggle__track"></span><span class="components-form-toggle__thumb"></span><label for="borderedblocks-toggle">Show borders/labels</label></span></div>').addClass('hasToggle');
    }

    // Click handler lives in the parent document; it reaches into editorDoc to toggle the class
    $(document).on('click','.borderedblocks-toggle',function(){
        $(this).toggleClass('is-checked');
        if (editorDoc) {
            $(editorDoc).find('.editor-styles-wrapper').toggleClass('borderedblocks');
        }
    });

    // Wait for the editor canvas iframe to be ready before injecting styles into it
    var initEditorInterval = setInterval(function() {
        var doc = getEditorDocument();
        if (doc) {
            editorDoc = doc;
            clearInterval(initEditorInterval);
            initEditorStyles(editorDoc);
            setInterval(checkBlocks, 1000);
        }
    }, 500);

    var addToggleButton = setInterval(function() {
        if ((!$('.edit-post-header-toolbar__left').hasClass('hasToggle')) && (!$('.editor-document-tools__left').hasClass('hasToggle')) && (!$('.edit-widgets-header__navigable-toolbar-wrapper').hasClass('hasToggle'))) {
            addToggle();
        } else {
            // End this silly loop
            clearInterval(addToggleButton);
        }
    }, 1000);

});
