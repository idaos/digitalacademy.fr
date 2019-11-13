// run carousel
jQuery(document).ready(function(){
    jQuery('.owl-carousel').owlCarousel({
        loop: true,
        nav: true,
        dots: false,
        navText: ["<span id='arrow-prev'><</span>","<span id='arrow-next'>></span>"],
        autoplay: true,
        items: 6,
        margin: 50,
        responsive : {
            0 : {
                items : 1
            },
            576 : {
                items : 3
            },
            768 : {
                items : 4
            },
            992 : {
                items : 6
            }
        }
    });
});
// smooth scroll
var elt_dzz45f = document.querySelectorAll('a[href^="#"]');
    elt_dzz45f = Array.from(elt_dzz45f);

elt_dzz45f.forEach(function(anchor) {

    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const elm = this.getAttribute('href');
        scrollIt(elm);
    });
});
function scrollIt(element) {
  window.scrollTo({
    'behavior': 'smooth',
    'left': 0,
    'top': element.offsetTop 
  });
}

// add tel format checkup on phone number inputs (gravity form plugin doesn't handle patterns...)
jQuery( document ).ready(function() { 
    addPhonePattern() 
});

function addPhonePattern(){
    jQuery( "input[type='tel']" ).each(function(){
        jQuery( this ).attr( "pattern", "[0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9][0-9]" );  
    }); 
}


// register form submission event to Google Analyics
 jQuery(document).ready(function() {
   jQuery(document).bind("gform_confirmation_loaded", function(event, formID) {

     if(formID == 9)     {var formName = 'page-Digital-Learning';}
     else{                var formName = 'form_Unknown';}
       
     window.dataLayer = window.dataLayer || [];
     window.dataLayer.push({
       event: "formSubmission",
       formID: formName
     });
       
        document.querySelector('#contact').scrollIntoView({
            behavior: 'smooth'
        });
       
   });
 });