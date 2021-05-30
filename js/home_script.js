//-----------------------------------------------------------//
//---------- Play YT video on click on cover image ----------//
//-----------------------------------------------------------//
// -- vanilla js
function playIframe(){

    // Make sur user accept social media cookies
	if( getCookie('cookielawinfo-checkbox-functional') != 'yes' ){
        if (confirm('Vous n\'avez pas accepté les cookies relatifs aux réseaux sociaux. Les accepter pour lire la vidéo ?')) {
            setCookie('cookielawinfo-checkbox-functional','yes',7);
            launchYTiframe()
        } else {
            setCookie('cookielawinfo-checkbox-functional','no',7);
            return
          }
	}else{
        launchYTiframe()
    }
    function launchYTiframe(){
        // This code loads the IFrame Player API code asynchronously.
        var tag = document.createElement('script');
        tag.src = "https://www.youtube.com/iframe_api";
        var firstScriptTag = document.getElementsByTagName('script')[0];
        firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
        document.getElementById('play-icon').setAttribute('style', 'display:none;');
        document.getElementById('iframe-wrapper').setAttribute('style', 'display:initial;');
    }
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