

// -------------------------- //
//   Slidown div on click
// -------------------------- //

/*
<div class="toggable">
    <button class="toggable-btn">***</button>
    <div class="toggable-content">***</div>
</div>
*/

jQuery( document ).ready(function() {

    jQuery( ".toggable" ).each(function() {

        var toggaled = jQuery( this );
        toggaled.children(".toggable-content").hide();
        toggaled.children(".toggable-btn").click(function () {

            if (toggaled.children(".toggable-content").is( ":hidden" ) ) {
                toggaled.children(".toggable-content").slideDown( 300 );
                jQuery(this).addClass('toggaled');

                btnLabel = toggaled.children(".toggable-btn").html();
                if( btnLabel == "En savoir +" ){ toggaled.children(".toggable-btn").html("Réduire"); }
            }else{
                toggaled.children(".toggable-content").slideUp( 300 );
                jQuery(this).removeClass('toggaled');

                btnLabel = toggaled.children(".toggable-btn").html();
                if( btnLabel == "Réduire" ){ toggaled.children(".toggable-btn").html("En savoir +"); }
            }
        });
    });

});


jQuery( document ).ready(function() {
    
    // Enable slideUp on click
    jQuery( ".accordeon-item-title" ).each(function() {

        var item = jQuery( this ).parent( ".accordeon-item" );
        item.children( ".accordeon-item-title" ).click(function () {
            item.toggleClass( "active" );

            if (item.children(".accordeon-item-content").is( ":hidden" ) ) {
                item.children(".accordeon-item-content").slideDown( 300 );

            }else{
                item.children(".accordeon-item-content").slideUp( 300 );
            }
        });
    });

    // Auto slideUp first elt
    jQuery('.accordeon-wrapper').each(function() {
        i=0
        jQuery('.accordeon-item').each(function() {
            if(i==0){
                jQuery( this ).addClass('active')
                jQuery( this ).children('.accordeon-item-content').css('display', 'inherit')
                i+=1
            }
        })
    })
});