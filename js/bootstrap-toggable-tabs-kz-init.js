jQuery( document ).ready(function() {

    jQuery('.nav-tabs > li').each(function( index ) {
        var this_tab_is_active = jQuery(this).first().hasClass( "active" );
        if(this_tab_is_active){
            const a_tab_is_active = true;
        }
    });
    
    if(typeof a_tab_is_active == 'undefined'){
        jQuery('.nav-tabs > li').first().addClass( "active" );
        jQuery('.tab-pane').first().addClass( "active" );
    }
});