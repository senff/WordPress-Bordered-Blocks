jQuery(function($) {

	// --- HANDLING THE TABS ----------------------------------- 

    var hash = window.location.hash;

	$('.tabs-content').children().addClass('hide');

    if (hash != '') {
        $('.nav-tab-wrapper a[href="' + hash + '"]').addClass('nav-tab-active');
        $('.tabs-content div' + hash.replace('#', '#gutenborders-')).removeClass('hide');
    } else {
        $('.nav-tab-wrapper a:first-child').addClass('nav-tab-active');
        $('.tabs-content div#gutenborders-main').removeClass('hide');

    }

    $('.nav-tab-wrapper a').on('click',function() {
        var tab_id = $(this).attr('href').replace('#', '#gutenborders-');

        // Set the current tab active
        $(this).parent().children().removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');

        // Show the active content
        $('.tabs-content').children().addClass('hide');
        $('.tabs-content div' + tab_id).removeClass('hide');
    });

    // --- SETTINGS: RESETTING DEFAULTS -----------------------------------

    $('.button-reset-border').on('click',function(b){
        $('input:radio[name="gb_borderstyle"]').trigger('click');
        $('input[name="gb_bordercolor"]').attr('value','#c0c0c0').val('#c0c0c0');
        $('.bordercolor button.wp-color-result').attr('style','background-color: #c0c0c0');
        $('input[name="gb_borderwidth"]').attr('value','1').val('1');
    });

    $('.button-reset-padding').on('click',function(p){
        $('input[name="gb_paddingtop"]').attr('value','25').val('25');
        $('input[name="gb_paddingright"]').attr('value','10').val('10');
        $('input[name="gb_paddingbottom"]').attr('value','10').val('10');
        $('input[name="gb_paddingleft"]').attr('value','10').val('10');
    });

    $('.button-reset-label').on('click',function(l){
        $('input[name="gb_labelbackground"]').attr('value','#000000').val('#000000');
        $('.labelbackground button.wp-color-result').attr('style','background-color: #000000');
        $('input[name="gb_labelcolor"]').attr('value','#ffffff').val('#ffffff');
        $('.labelcolor button.wp-color-result').attr('style','background-color: #ffffff');  
        $('input[name="gb_labelsize"]').attr('value','11').val('11');
        $('input[name="gb_labelopacity"]').attr('value','3').val('3');      
    });

});