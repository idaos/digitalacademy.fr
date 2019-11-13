// scroll to  contact form on clic
jQuery( document ).ready(function() {
    jQuery('.contact-btn').each(function(index) {
        jQuery(this).on("click", function(){
            
            form_val = jQuery(this).attr('value');
            jQuery('select option[value="'+ form_val +'"]').prop('selected', true); // select option in the contact form
            
            event.preventDefault();
            headerHeight = jQuery('#kz-menu-wrapper').innerHeight(); // calc offset cause header is in fixed position
            contactPosition = jQuery("#contact").offset().top;
            contactOffset =  contactPosition - headerHeight;
            jQuery(window).scrollTop(contactOffset);
        });
    });
});
