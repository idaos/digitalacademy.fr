

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