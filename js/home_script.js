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