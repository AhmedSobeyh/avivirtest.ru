
$(document).ready(function() {
	
	
	var mediaElements = document.querySelectorAll('video');

	for (var i = 0, total = mediaElements.length; i < total; i++) {
		new MediaElementPlayer(mediaElements[i], {
			alwaysShowControls: true,
			features: ['prevtrack', 'playpause', 'nexttrack', 'current', 'duration', 'progress'],
			setDimensions: false,
			enableAutosize: true,
			autosizeProgress: true,
            timeAndDurationSeparator: ' / ',
            //pluginPath: 'https://cdn.jsdelivr.net/npm/mediaelement@4.2.16/build/',
			success: function (mediaElement, media, node, instance) {
                
                //var renderer = document.getElementById(media.id + '-rendername');
                console.log(media);   
                /*
                media.addEventListener('loadedmetadata', function () {
					var src = media.getAttribute('src').replace('&amp;', '&');
					if (src !== null && src !== undefined) {
						renderer.querySelector('.src').innerHTML = '<a href="' + src + '" target="_blank">' + src + '</a>';
						renderer.querySelector('.renderer').innerHTML = media.rendererName;
                        renderer.querySelector('.error').innerHTML = '';
                        console.log(src);
                    }
                    
                    console.log(src); 
                });
                */
                /*
                media.addEventListener("playing", function(e) { 
					//console.log(node);
					console.log( mediaElement );
					//player.loadNextTrack; 
					//instance.players[3].play();   
					//audio.play();  
					//instance.findTracks();  
					//instance.loadNextTrack();  
                }, true);
                */
			} 
		});
	}
	
}); 

function nextPlaylistCallback ()
{
    return false;
}