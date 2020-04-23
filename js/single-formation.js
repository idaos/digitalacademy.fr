//// -------------------------- //
////   Show / Hide on Click
//// -------------------------- //
//
//jQuery(document).ready(function ($) {
//
//    jQuery(".toggleplus").click(function () {
//        jQuery(this).parent('.content-show').toggleClass("show");
//    });
//});
//
//
//// -------------------------- //
////   Sub nav fixed on scroll
//// -------------------------- //
//
//
//jQuery(window).scroll(function() {
//
//    var h = jQuery('#kz-menu-wrapper').height();
//    var h2= h;
//    var h3 = jQuery('#sub-nav').height();
//    h2 += jQuery('#breadcrumb').height();
//    h2 += jQuery('#heading').height();
//    h2 += jQuery('#obsolete').height();
//    h2 -= h3;
//
//    if(jQuery(window).scrollTop() > h2) {
//        jQuery('#sub-nav').css('position','fixed');
//        jQuery('#sub-nav').css('top',h);
//        jQuery('#sub-nav-placeholder').css('height',h3);
//
//    } else {
//        jQuery('#sub-nav').css('position','relative');
//        jQuery('#sub-nav').css('top','0');
//        jQuery('#sub-nav-placeholder').css('height','0');
//    }
//
//    // -------------------------- //
//    //   Btn highlights on scroll
//    // -------------------------- //
//
//    // get scroll position
//    var scrolled_id;
//    jQuery('.container-wp').each(function( index ) {
//        if( jQuery(this).position().top <= jQuery(window).scrollTop() +  h2 ) {
//            if( jQuery(this).children().attr('id') != undefined ){
//                scrolled_id = jQuery(this).children().attr('id');
//            }
//        }
//    });
//
//    // highlight nav btn
//    jQuery('#sub-nav li a').each(function( index ) {
//        if( jQuery(this).attr('href').substring(1) == scrolled_id ){
//            
//            jQuery(this).addClass('btn-red');
//            jQuery(this).removeClass('btn-gray');
//        }else{
//            jQuery(this).removeClass('btn-red');
//            jQuery(this).addClass('btn-gray');
//        }
//    });
//
//});

//---------------------------------------------------------------
//--------- Prevent scroll on click on anchor in tab form -------
//---------------------------------------------------------------
jQuery(document).ready(function() {
    var tlink = jQuery('.nav-tabs .btn');
    tlink.each(function() {
        jQuery(this).click(function(e) {
            e.preventDefault();
        });
    });
});


//-------------------------------------------
//--------- Form custom heading -------------
//-------------------------------------------

jQuery(document).bind('gform_post_render', function(){

    if (typeof form_heading == 'undefined'){ form_heading = '<span id="form-heading" class="reverse"><h2>SESSION INTER ENTREPRISES</h2><h3>Demander la création d\'une session à la carte</h3></span><hr><br><br>'; }

    if( jQuery('#form-heading').length == 0 ){
        jQuery('#gform_wrapper_12 form').prepend(form_heading);
    } 
});

//-------------------------------------------
//--------- Form auto scroll into view ------
//-------------------------------------------
jQuery( document ).ready(function() {

    var eltTop = jQuery( "#tabled-form" ).offset().top;
    var eltWidth = jQuery( "#tabled-form" ).width();
    var eltHeight = jQuery( "#tabled-form" ).height();
    var eltHeight = jQuery('#tabled-form').height();
    var navHeight = jQuery('#kz-menu-wrapper').height();
    var colTop = jQuery( "#cta-col" ).offset().top;
    var colHeight = jQuery('#cta-col').height();
    var colBottom = colTop + colHeight

    jQuery(window).on("load resize scroll",function(e){
        // Reload on screen resize
        eltHeight = jQuery('#tabled-form').height();
        navHeight = jQuery('#kz-menu-wrapper').height();
        colTop = jQuery( "#cta-col" ).offset().top;
        colHeight = jQuery('#cta-col').height();
        colBottom = colTop + colHeight;
        // If screen size > 1200
        if ((jQuery(window).width() > 1200)&&(jQuery(window).height() > (eltHeight+navHeight) )) {

            var scrollY = jQuery(window).scrollTop();
            scrollY += navHeight; 
            // Check scroll position
            if( scrollY < eltTop ){
                jQuery('#tabled-form').css('position', '')
                jQuery('#tabled-form').css('width', '100%')
                jQuery('#tabled-form').css('top', 'inherit')
                jQuery('#tabled-form').css('bottom', 'inherit') 

            }else if(( scrollY > eltTop )&&( scrollY < (colBottom-eltHeight-74) )){
                jQuery('#tabled-form').css('position', 'fixed')
                jQuery('#tabled-form').css('width', eltWidth)
                jQuery('#tabled-form').css('top', navHeight)
                jQuery('#tabled-form').css('bottom', 'inherit') 
            }else{
                jQuery('#tabled-form').css('position', 'absolute')
                jQuery('#tabled-form').css('width', eltWidth)
                jQuery('#tabled-form').css('top', 'inherit')
                jQuery('#tabled-form').css('bottom', '134px') 
            }
        }else{
            jQuery('#tabled-form').css('position', '')
            jQuery('#tabled-form').css('width', '100%')
            jQuery('#tabled-form').css('left', 'inherit')
            jQuery('#tabled-form').css('top', 'inherit')
            jQuery('#tabled-form').css('bottom', 'inherit') 
        }
    });
});



