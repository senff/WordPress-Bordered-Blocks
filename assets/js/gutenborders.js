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
    let cssVar = '.gutenborders .editor-styles-wrapper .wp-block {';
    cssVar += 'border: '+borderstyle+' '+borderwidth+'px '+bordercolor+';';
    cssVar += 'padding: '+paddingtop+'px '+paddingright+'px '+paddingbottom+'px '+paddingleft+'px !important;}';
    // Apply CSS styles for labels
    cssVar += '.gutenborders .editor-styles-wrapper .wp-block:before  {';
    cssVar += 'font-size:'+labelsize+'px;background:'+labelbackground+';color:'+labelcolor+';opacity:'+labelopacity+';';
    cssVar += '}';
    $('#gutenBorders-css-variable').html(cssVar);        


    // Whether the toggle button (and the borders) should be ON of OFF by default
    let checkedornot;
    if (bordershow == 'on') {
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
            blockType = $(this).attr('data-title');
            if (!blocksOnPage.includes(blockType) && (typeof blockType != 'undefined')) {
                blocksOnPage.push(blockType);
            }
        });

        // Standard Image Block with alignment
        $('.editor-styles-wrapper figure').each(function(figure) {
            if ($(this).parent().hasClass('wp-block')) {
                $(this).parent().addClass('has-image');
            }
        });
        
        // Gallery Block with alignment
        $('.editor-styles-wrapper figure.wp-block-gallery').each(function(galleryfigure) {
            $(this).addClass('meh');
            $(this).parent().removeClass('has-image').addClass('contains-blocks gallery-block');
        });     

        $('.editor-styles-wrapper .wp-block-media-text').each(function(mediaText) {
            $(this).parent().addClass('contains-blocks has-media-text');
        });

        // Generate CSS that applies to all blocks
        // This CSS code also includes blocks that were on the page before.
        let cssCode = '';
        blocksOnPage.forEach(function(blockType) {
            cssCode += '.gutenborders .editor-styles-wrapper .wp-block[data-title="'+blockType+'"]:before {content: "'+blockType+'";} ';
        });  

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
