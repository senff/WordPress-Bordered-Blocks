jQuery(function($) {

    $('body').append('<style type="text/css" id="borderedBlocks-css-dynamic"></style><style type="text/css" id="borderedBlocks-css-variable"></style>');

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

    // Apply CSS styles for borders
    let cssVar = '.editor-styles-wrapper .wp-block, .editor-styles-wrapper *[data-title], .editor-styles-wrapper .contains-blocks[data-title] *[data-title]{';
    cssVar += 'border: '+borderstyle+' '+borderwidth+'px '+bordercolor+' !important;';
    cssVar += 'padding: '+paddingtop+'px '+paddingright+'px '+paddingbottom+'px '+paddingleft+'px !important; margin-bottom: 20px !important;}';
    // Apply CSS styles for labels
    if (labelsize < 1) {
        cssVar += '.editor-styles-wrapper .wp-block:before  {display: none;}';
    } else {
        cssVar += '.editor-styles-wrapper .wp-block::before, .editor-styles-wrapper .wp-block *[data-title]::before {';
        cssVar += 'font-size:'+labelsize+'px;height:'+(labelsize*1.5)+'px;line-height:'+(labelsize*1.5)+'px;background:'+labelbackground+';color:'+labelcolor+';opacity:'+(labelopacity/10)+';';
        cssVar += '}';
    }
        cssVar += '.editor-styles-wrapper .wp-block.contains-blocks[data-title] {position: relative; padding: 0 !important; border: none;}';
        cssVar += '.editor-styles-wrapper .wp-block.contains-blocks::before {display: none;}';    
        cssVar += '.editor-styles-wrapper hr.wp-block-separator[data-title], .editor-styles-wrapper .contains-blocks[data-title] hr[data-title] {padding: 0 !important;} .editor-styles-wrapper hr.wp-block-separator:after {display: none;}';
        cssVar += '.editor-styles-wrapper .wp-block[data-title="Social Icon"] {border: none; padding: 0 !important; margin-bottom: 0 !important;} .editor-styles-wrapper .wp-block.contains-blocks[data-title="Social Icons"] *[data-title="Social Icon"] {border: none; padding: 0 !important; margin-bottom: 0 !important;} .editor-styles-wrapper .wp-block[data-title="Social Icon"]:before {display: none;}';

        $('#borderedBlocks-css-variable').html(cssVar);        

    // Whether the toggle button (and the borders) should be ON of OFF by default
//    let checkedornot;
//    if (bordershow) {
//        $('body').addClass('borderedblocks');
//        checkedornot = 'checked';
//    }

//    function addToggle() {
        // Adding the toggle button
        // First line is updated - we can remove the second line a few versions down the road.
//        $('.editor-document-tools__left').append('<div class="borderedblocks-header"><span class="borderedblocks-toggle components-form-toggle is-'+checkedornot+'"><input class="components-form-toggle__input" id="borderedblocks-toggle" type="checkbox" aria-describedby="inspector-toggle-contr-0__help" '+checkedornot+'><span class="components-form-toggle__track"></span><span class="components-form-toggle__thumb"></span><label for="borderedblocks-toggle">Show borders/labels</label></span></div>').addClass('hasToggle');
//       $('.edit-post-header-toolbar__left').append('<div class="borderedblocks-header"><span class="borderedblocks-toggle components-form-toggle is-'+checkedornot+'"><input class="components-form-toggle__input" id="borderedblocks-toggle" type="checkbox" aria-describedby="inspector-toggle-contr-0__help" '+checkedornot+'><span class="components-form-toggle__track"></span><span class="components-form-toggle__thumb"></span><label for="borderedblocks-toggle">Show borders/labels</label></span></div>').addClass('hasToggle');
//    }

//    $('#editor').on('click','.borderedblocks-toggle',function(){
//       $(this).toggleClass('is-checked');
//       $('body').toggleClass('borderedblocks');
//    });  

    // This function SHOULD run every time a new block is added, or when an existing block is changed.
    // Right now, it will just run every second, and will output an array with all the block types on the page.
	function checkBlocks() {
        // LOOP: check all blocks types and add them to an array.
        // The array also contains blocks that are on the page before (this saves us from clearing the entire
        // array and write it from scratch again)
        $('.editor-styles-wrapper .wp-block').each(function(block) {
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
            cssCode += '.editor-styles-wrapper .wp-block[data-title="'+blockType+'"]:before {content: "'+blockType+'";} .editor-styles-wrapper .wp-block[data-title="'+blockType+'"] *[data-title="'+blockType+'"]:before {content: "'+blockType+'";} ';
        });  

        embedsOnPage.forEach(function(embedType) {
            cssCode += '.editor-styles-wrapper .wp-block[borderedblocks-label="'+embedType+'"]:before {content: "'+embedType+'";} .editor-styles-wrapper .wp-block[borderedblocks-label="'+embedType+'"] *[data-title="Embed"]:before {content: "'+embedType+'";} ';
        });  

        // There's a few exceptions (thanks to the WordPress editor inconsistencies), so we'll need to add those.
            cssCode += '.editor-styles-wrapper .wp-block.taxonomy-category:before {content: "Post Categories";}';
            cssCode += '.editor-styles-wrapper .wp-block.taxonomy-post_tag:before {content: "Post Tags";}';
            cssCode += '.editor-styles-wrapper .wp-block[borderedblocks-label="Next post"]:before {content: "Next Post";}';
            cssCode += '.editor-styles-wrapper .wp-block[borderedblocks-label="Previous post"]:before {content: "Previous Post";}';
            cssCode += '.editor-styles-wrapper .wp-block.wp-block-query-title:before {content: "Archive Title";}';

        //
        $('#borderedBlocks-css-dynamic').html(cssCode);        
    }

    var addToggleButton = setInterval(function() {
        if(   (!$('.edit-post-header-toolbar__left').hasClass('hasToggle')) && (!$('.editor-document-tools__left').hasClass('hasToggle')) ) {
            addToggle();
        } else {
        // End this silly loop
            clearInterval(addToggleButton);
        }
    }, 1000);

    var checkBlockTypes = setInterval(function() {
        checkBlocks();
    }, 1000);


});
