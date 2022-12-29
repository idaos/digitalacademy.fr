

//---------------------------------------------------------------
//--------- Prevent scroll on click on anchor in tab form -------
//---------------------------------------------------------------
jQuery(document).ready(function () {
    var tlink = jQuery('.nav-tabs .btn');
    tlink.each(function () {
        jQuery(this).click(function (e) {
            e.preventDefault();
        });
    });
});


//-------------------------------------------
//--------- Form custom heading -------------
//-------------------------------------------

jQuery(document).bind('gform_post_render', function () {

    if (typeof form_heading == 'undefined') { form_heading = '<span id="form-heading" class="reverse"><h2>SESSION INTER ENTREPRISES</h2><h3>Demander la création d\'une session à la carte</h3></span><hr><br><br>'; }

    if (jQuery('#form-heading').length == 0) {
        jQuery('#gform_wrapper_12 form').prepend(form_heading);
    }
});




//-------------------------------------------
//--------- Accordeion -------------
//-------------------------------------------

document.addEventListener('DOMContentLoaded', function () {
    var more = document.querySelector('.accordeon-xs-toggler.more');
    var less = document.querySelector('.accordeon-xs-toggler.less');
    var content = document.querySelectorAll('.accordeon-xs');
    more.addEventListener('click', function (event) {
        if (window.innerWidth < 700) {
            more.setAttribute('style', 'display:none !important');
            less.setAttribute('style', 'display:flex !important');
            content.forEach(e => { e.setAttribute('style', 'display:flex !important'); })
        }
    })
    less.addEventListener('click', function (event) {
        if (window.innerWidth < 700) {
            more.setAttribute('style', 'display:flex !important');
            less.setAttribute('style', 'display:none !important');
            content.forEach(e => { e.setAttribute('style', 'display:none !important'); })
        }
    })
    window.addEventListener('resize', function () {
        if (window.innerWidth > 700) {
        more.setAttribute('style', '');
        less.setAttribute('style', 'display:none !important');
        content.forEach(e => { e.setAttribute('style', ''); }) 
        }
    })
})