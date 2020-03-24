// -------------------------- //
//   Slidown txt on click
// -------------------------- //

jQuery( document ).ready(function() {

    jQuery( ".toggable" ).each(function() {
        
        var toggaled = jQuery( this );
        jQuery( this ).children(".toggable-content").hide();
        jQuery( this ).children(".toggable-title").parent().click(function () {

            if ( jQuery( this ).children(".toggable-content").is( ":hidden" ) ) {
                jQuery( this ).children(".toggable-content").slideDown( 200 );
                toggaled.addClass('toggaled');
            }else{
                jQuery( this ).children(".toggable-content").slideUp( 200 );
                toggaled.removeClass('toggaled');
            }
        });
    });

});



// -------------------------- //
//   Sub nav fixed on scroll
// -------------------------- //


jQuery(window).scroll(function() {

    var h = jQuery('#kz-menu-wrapper').height();
    var h2= h;
    var h3 = jQuery('#sub-nav').height();
    h2 += jQuery('#breadcrumb').height();
    h2 += jQuery('#heading').height();
    h2 -= h3;

    if(jQuery(window).scrollTop() > h2) {
        jQuery('#sub-nav').css('position','fixed');
        jQuery('#sub-nav').css('top',h);
        jQuery('#sub-nav-placeholder').css('height',h3);

    } else {
        jQuery('#sub-nav').css('position','relative');
        jQuery('#sub-nav').css('top','0');
        jQuery('#sub-nav-placeholder').css('height','0');
    }

    // -------------------------- //
    //   Btn highlights on scoll
    // -------------------------- //

    // get scroll position
    var scrolled_id;
    jQuery('.container-wp').each(function( index ) {
        if( jQuery(this).position().top <= jQuery(window).scrollTop() +  h2 ) {
            if( jQuery(this).children().attr('id') != undefined ){
                scrolled_id = jQuery(this).children().attr('id');
            }
        }
    });

    // highlight nav btn
    jQuery('#sub-nav li a').each(function( index ) {
        if( jQuery(this).attr('href').substring(1) == scrolled_id ){

            jQuery(this).addClass('btn-red');
            jQuery(this).removeClass('btn-gray');
        }else{
            jQuery(this).removeClass('btn-red');
            jQuery(this).addClass('btn-gray');
        }
    });

});



