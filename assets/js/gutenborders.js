jQuery(function($) {

    $('body').append('<style type="text/css" id="gutenBorders-css-dynamic"></style><style type="text/css" id="gutenBorders-css-variable"></style>');

    let blocksOnPage = new Array();
    
    // Variables from database
    let bordershow = gutenborders_loader.bordershow;
    let bordercolor = gutenborders_loader.bordercolor;
    let borderstyle = gutenborders_loader.borderstyle;
    let borderwidth = gutenborders_loader.borderwidth;
    let paddingtop = gutenborders_loader.paddingtop;
    let paddingright = gutenborders_loader.paddingright;
    let paddingbottom = gutenborders_loader.paddingbottom;
    let paddingleft = gutenborders_loader.paddingleft;
    let labelcolor = gutenborders_loader.labelcolor;
    let labelbackground = gutenborders_loader.labelbackground;
    let labelopacity = gutenborders_loader.labelopacity;
    let labelsize = gutenborders_loader.labelsize;      

    // Apply CSS styles for borders
    let cssVar = '.gutenborders .editor-styles-wrapper .wp-block, .gutenborders .editor-styles-wrapper *[data-title], .gutenborders .editor-styles-wrapper .contains-blocks[data-title] *[data-title]{';
    cssVar += 'border: '+borderstyle+' '+borderwidth+'px '+bordercolor+';';
    cssVar += 'padding: '+paddingtop+'px '+paddingright+'px '+paddingbottom+'px '+paddingleft+'px !important; margin-bottom: 20px !important;}';
    // Apply CSS styles for labels
    if (labelsize < 1) {
        cssVar += '.gutenborders .editor-styles-wrapper .wp-block:before  {display: none;}';
    } else {
        cssVar += '.gutenborders .editor-styles-wrapper .wp-block::before, .gutenborders .editor-styles-wrapper .wp-block *[data-title]::before {';
        cssVar += 'font-size:'+labelsize+'px;height:'+(labelsize*1.5)+'px;line-height:'+(labelsize*1.5)+'px;background:'+labelbackground+';color:'+labelcolor+';opacity:'+(labelopacity/10)+';';
        cssVar += '}';
    }
    $('#gutenBorders-css-variable').html(cssVar);        


    // Whether the toggle button (and the borders) should be ON of OFF by default
    let checkedornot;
    if (bordershow) {
        $('body').addClass('gutenborders');
        checkedornot = 'checked';
    }

    function addToggle() {
        $('.edit-post-header-toolbar__left').append('<div class="gutenborders-header"><span class="gutenborders-toggle components-form-toggle is-'+checkedornot+'"><input class="components-form-toggle__input" id="gutenborders-toggle" type="checkbox" aria-describedby="inspector-toggle-contr-0__help" '+checkedornot+'><span class="components-form-toggle__track"></span><span class="components-form-toggle__thumb"></span><label for="gutenblocks-toggle">Show borders/labels</label></span></div>').addClass('hasToggle');
    }

    $('#editor').on('click','.gutenborders-toggle',function(){
       $(this).toggleClass('is-checked');
       $('body').toggleClass('gutenborders');
    });  

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
                if (!($(this).children().first().hasClass('gutenborders-label')) && (typeof blockType != 'undefined')) {
                    $(this).addClass('has-gutenborder-label').attr('gutenborders-label',blockType);
                }
                if (!blocksOnPage.includes(blockType) && (typeof blockType != 'undefined')) {
                    blocksOnPage.push(blockType);
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
            cssCode += '.gutenborders .editor-styles-wrapper .wp-block[data-title="'+blockType+'"]:before {content: "'+blockType+'";} .gutenborders .editor-styles-wrapper .wp-block[data-title="'+blockType+'"] *[data-title="'+blockType+'"]:before {content: "'+blockType+'";} ';
        });  
        // There's a few exceptions (thanks to Gutenberg's inconsistencies), so we'll need to add those.
            cssCode += '.gutenborders .editor-styles-wrapper .wp-block.taxonomy-category:before {content: "Post Categories";}';
            cssCode += '.gutenborders .editor-styles-wrapper .wp-block.taxonomy-post_tag:before {content: "Post Tags";}';
            cssCode += '.gutenborders .editor-styles-wrapper .wp-block[data-title="Social Icon"] {border: none; padding: 0; margin-bottom: 0;} .gutenborders .editor-styles-wrapper .wp-block[data-title="Social Icon"]:before {display: none;}';

        //
        $('#gutenBorders-css-dynamic').html(cssCode);        
    }

    var addToggleButton = setInterval(function() {
        if(!$('.edit-post-header-toolbar__left').hasClass('hasToggle')) {
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
