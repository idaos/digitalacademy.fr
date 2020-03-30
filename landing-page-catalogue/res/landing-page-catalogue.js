
// add tel format checkup on phone number inputs (gravity form plugin doesn't handle patterns...)
$( document ).ready(function() { 
    addPhonePattern() 
});

function addPhonePattern(){
    $( "input[type='tel']" ).each(function(){
        $( this ).attr( "pattern", "[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" );  
    }); 
}
// prevent page scroll when modal is open
$(window).on('load hashchange', function(e){
    if(window.location.href.indexOf("popup") > -1) {
        $('html').css('overflow', 'hidden');
    }else{
        $('html').css('overflow', 'initial');
    }
});

