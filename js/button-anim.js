function buttonAnim(){

    jQuery('form input[type="submit"]').each(function(index) {
        jQuery(this).on("click", function(){  
            bH = jQuery(this).height();
            jQuery(this).height(bH);
            bW = jQuery(this).width();
            jQuery(this).width(bW);
            jQuery(this).attr('value','');
            jQuery(this).parents('form').css({ opacity: 0.8 });
            if ( jQuery(this).parents('.gform_footer').children('svg').length == 0 ) {
                jQuery(this).parents('.gform_footer').append('<svg class="spinner" version="1.1" id="" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 50 50" style="enable-background:new 0 0 50 50;" xml:space="preserve"><path class="st0" d="M25,0c-1.2,0-2.3,1-2.3,2.3V5c0,1.2,1,2.3,2.3,2.3c9.8,0,17.7,8,17.7,17.7s-8,17.7-17.7,17.7S7.3,34.8,7.3,25 c0-1.2-1-2.3-2.3-2.3H2.3C1,22.7,0,23.8,0,25c0,13.8,11.2,25,25,25c13.8,0,25-11.2,25-25C50,11.2,38.8,0,25,0z"/> </svg>');
            }
        });
    });
}

buttonAnim();