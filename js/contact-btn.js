jQuery( document ).ready(function() {
    // scroll to anchor offseting the header height (fix header..)
    jQuery('.site-container a').each(function(index) {
        jQuery(this).on("click", function(){  
            href = jQuery(this).attr('href');
            if (href.startsWith("#") ){
                // anchor link
                event.preventDefault();
                headerHeight = jQuery('#kz-menu-wrapper').innerHeight(); // calc offset cause header is in fixed position
                anchorPosition = jQuery( '#' + href.substring(1) ).offset().top;
                anchorOffset =  anchorPosition - headerHeight;
                jQuery(window).scrollTop(anchorOffset);
            }
        });
    });
    // scroll to  contact form on clic on contact btn and select option in the contact form based on btn value
    jQuery('.contact-btn').each(function(index) {
        jQuery(this).on("click", function(){  
            if (jQuery(this).parent('a').length) { // has parent (is nested)
                href = jQuery(this).parent().attr('href');
            }else{ 
                href = jQuery(this).attr('href');
            }
            if (href.startsWith("#") ){ // is an anchor (and not a link)
                // anchor link
                form_val = jQuery(this).attr('value');
                jQuery('select option').each(function(index) {
                    jQuery(this).removeAttr("selected");
                });
                jQuery('select option[value="'+ form_val +'"]').attr('selected','selected'); // select option in the contact form
                
                jQuery('.select-selected').html(form_val);
                jQuery('.select-items .same-as-selected').removeClass('.same-as-selected');
                jQuery('.select-items > div').each(function(index) {
                    if ( jQuery(this).html() == form_val ){
                        jQuery(this).addClass('.same-as-selected');
                    }
                });
            }
        });
    });
});
