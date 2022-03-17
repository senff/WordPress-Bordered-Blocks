jQuery(function($) {


    let blocksOnPage = new Array();
    $('body').append('<style type="text/css" id="gutenBorders-css"></style>');

    // This function SHOULD run every time a new block is added, or when an existing block is changed.
    // Right now, it will just run every second, and will output an array with all the block types on the page.
	function checkBlocks() {
        // LOOP: check all blocks types and add them to an array.
        // The array also contains blocks that are on the page before (this saves us from clearing the entire
        // array and write it from scratch again)
        $('.editor-styles-wrapper .wp-block').each(function(block) {
            blockType = $(this).attr('data-title');
            if (!blocksOnPage.includes(blockType)) {
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
            cssCode += '.editor-styles-wrapper .wp-block[data-title="'+blockType+'"]:before {content: "'+blockType+'";} ';
        });  

        $('#gutenBorders-css').html(cssCode);        
          
    }

    var checkBlockTypes = setInterval(function() {
        checkBlocks();
    }, 1000);


});
