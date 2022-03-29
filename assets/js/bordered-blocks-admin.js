jQuery(function($) {

    // --- HANDLING THE TABS ----------------------------------- 

    var hash = window.location.hash;

	$('#borderedblocks-settings-general .tabs-content').children().addClass('hide');

    if (hash != '') {
        $('#borderedblocks-settings-general .nav-tab-wrapper a[href="' + hash + '"]').addClass('nav-tab-active');
        $('#borderedblocks-settings-general .tabs-content div' + hash.replace('#', '#borderedblocks-')).removeClass('hide');
    } else {
        $('#borderedblocks-settings-general .nav-tab-wrapper a:first-child').addClass('nav-tab-active');
        $('#borderedblocks-settings-general .tabs-content div#borderedblocks-main').removeClass('hide');

    }

    $('#borderedblocks-settings-general .nav-tab-wrapper a').on('click',function() {
        var tab_id = $(this).attr('href').replace('#', '#borderedblocks-');

        // Set the current tab active
        $(this).parent().children().removeClass('nav-tab-active');
        $(this).addClass('nav-tab-active');

        // Show the active content
        $('#borderedblocks-settings-general .tabs-content').children().addClass('hide');
        $('#borderedblocks-settings-general .tabs-content div' + tab_id).removeClass('hide');
    });

    $('#borderedblocks-settings-general a.help').on('click',function(h) {
        h.preventDefault();    
    });

    // --- SETTINGS: RESETTING DEFAULTS -----------------------------------

    $('#borderedblocks-settings-general .button-reset-border, #borderedblocks-settings-general .button-reset-all').on('click',function(b){
        $('#borderedblocks-settings-general input:radio[name="gb_borderstyle"]').trigger('click');
        $('#borderedblocks-settings-general input[name="gb_bordercolor"]').attr('value','#c0c0c0').val('#c0c0c0');
        $('#borderedblocks-settings-general .bordercolor button.wp-color-result').attr('style','background-color: #c0c0c0');
        $('#borderedblocks-settings-general input[name="gb_borderwidth"]').attr('value','1').val('1');
    });

    $('#borderedblocks-settings-general .button-reset-padding, #borderedblocks-settings-general .button-reset-all').on('click',function(p){
        $('#borderedblocks-settings-general input[name="gb_paddingtop"]').attr('value','25').val('25');
        $('#borderedblocks-settings-general input[name="gb_paddingright"]').attr('value','10').val('10');
        $('#borderedblocks-settings-general input[name="gb_paddingbottom"]').attr('value','10').val('10');
        $('#borderedblocks-settings-general input[name="gb_paddingleft"]').attr('value','10').val('10');
    });

    $('#borderedblocks-settings-general .button-reset-label, #borderedblocks-settings-general .button-reset-all').on('click',function(l){
        $('#borderedblocks-settings-general input[name="gb_labelbackground"]').attr('value','#000000').val('#000000');
        $('#borderedblocks-settings-general .labelbackground button.wp-color-result').attr('style','background-color: #000000');
        $('#borderedblocks-settings-general input[name="gb_labelcolor"]').attr('value','#ffffff').val('#ffffff');
        $('#borderedblocks-settings-general .labelcolor button.wp-color-result').attr('style','background-color: #ffffff');  
        $('#borderedblocks-settings-general input[name="gb_labelsize"]').attr('value','12').val('12');
        $('#borderedblocks-settings-general input[name="gb_labelopacity"]').attr('value','3').val('3');      
    });
   
    // --- SETTINGS: PREVIEW -----------------------------------   
    $('#borderedblocks-settings-general .button-preview, #borderedblocks-settings-general .button-reset-all, #borderedblocks-settings-general .button-reset-border, #borderedblocks-settings-general .button-reset-padding, #borderedblocks-settings-general .button-reset-label').on('click',function(bp){   
        var setBorder = $('#borderedblocks-settings-general input[name="gb_borderstyle"]:checked').val() + ' ' + $('#borderedblocks-settings-general input[name="gb_borderwidth"]').val() + 'px ' + $('#borderedblocks-settings-general input[name="gb_bordercolor"]').val();
        var setPadding = $('#borderedblocks-settings-general input[name="gb_paddingtop"]').val() + 'px ' + $('#borderedblocks-settings-general input[name="gb_paddingright"]').val() + 'px ' + $('#borderedblocks-settings-general input[name="gb_paddingbottom"]').val() + 'px ' + $('#borderedblocks-settings-general input[name="gb_paddingleft"]').val() + 'px';
        $('#borderedblocks-settings-general .padding-preview').css('border', setBorder);
        $('#borderedblocks-settings-general .preview-cell div, #borderedblocks-settings-general .preview-cell p').css('border', setBorder).css('padding', setPadding);
        $('#borderedblocks-settings-general .preview-cell .block-label').css('background',$('#borderedblocks-settings-general input[name="gb_labelbackground"]').val()).css('color',$('#borderedblocks-settings-general input[name="gb_labelcolor"]').val()).css('font-size',$('#borderedblocks-settings-general input[name="gb_labelsize"]').val() +'px ').css('opacity',($('#borderedblocks-settings-general input[name="gb_labelopacity"]').val())/10).css('height',($('#borderedblocks-settings-general input[name="gb_labelsize"]').val()*1.5) +'px ').css('line-height',($('#borderedblocks-settings-general input[name="gb_labelsize"]').val()*1.5) +'px ');
    });

});
