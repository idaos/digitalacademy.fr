

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
