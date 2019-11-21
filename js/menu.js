//-----------------------------------------------------------//
//-------------- Burger icon animate on touch ---------------//
//-----------------------------------------------------------//
// -- vanilla js 
// (not working on IE cause classList is not supported on SVG element in IE11, not supported at all on previous v. of IE)
function animateBurger(){
    var burgerIcon = document.getElementById('toggle-menu').childNodes[1];
    burgerIcon.classList.toggle("burgerToCross");
}