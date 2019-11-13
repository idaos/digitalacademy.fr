//-----------------------------------------------------------//
//---------- Play YT video on click on cover image ----------//
//-----------------------------------------------------------//
// -- vanilla js
function playIframe(){
    // This code loads the IFrame Player API code asynchronously.
    var tag = document.createElement('script');
    tag.src = "https://www.youtube.com/iframe_api";
    var firstScriptTag = document.getElementsByTagName('script')[0];
    firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    document.getElementById('play-icon').setAttribute('style', 'display:none;');
    document.getElementById('iframe-wrapper').setAttribute('style', 'display:initial;');
}

// This function creates an <iframe> (and YouTube player) /    after the API code downloads.
var player;
function onYouTubeIframeAPIReady() {
    player = new YT.Player('iframe-wrapper', {
        height: '330',
        width: '640',
        videoId: 'FpPAwR5X9Yw',
        events: {
          'onReady': onPlayerReady
        }
    });
}
function onPlayerReady(){
    player.playVideo();
}
//-----------------------------------------------------------//
//-------------- Burger icon animate on touch ---------------//
//-----------------------------------------------------------//
// -- vanilla js 
// (not working on IE cause classList is not supported on SVG element in IE11, not supported at all on previous v. of IE)
function animateBurger(){
    var burgerIcon = document.getElementById('toggle-menu').childNodes[1];
    burgerIcon.classList.toggle("burgerToCross");
}
