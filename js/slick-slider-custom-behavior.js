//------------------------------------------------------------//
// This code stop home slider on youtube video play
  // This code loads the IFrame Player API code asynchronously.
  var tag = document.createElement('script');
  tag.src = "https://www.youtube.com/iframe_api";
  var firstScriptTag = document.getElementsByTagName('script')[0];
  firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
  // This code handle the iframe by id
    var player;
	function onYouTubeIframeAPIReady() {
	  player = new YT.Player('youtube_player', {
		events: {
		  'onStateChange': onPlayerStateChange
		}
	  });
	}
  // This code is executed when video state change
	function onPlayerStateChange(event) {
		
	  switch(event.data) {
		case YT.PlayerState.PLAYING:
		  jQuery( ".slide-home" ).slick('slickPause');
		  break;
		case YT.PlayerState.PAUSED:
		  jQuery( ".slide-home" ).slick('slickPlay');
		  break;
		case YT.PlayerState.ENDED:
		  jQuery( ".slide-home" ).slick('slickPlay');
		  break;
		default:
		  return;
	  }
	}
//------------------------------------------------------------//
