$(document).ready(function() {
	
	var __player = $('video');
	
	__player.mediaelementplayer({
		features: ['playpause', 'current', 'duration', 'progress', 'fullscreen'],
		setDimensions: false,
		enableAutosize: true,
		autosizeProgress: true,
		timeAndDurationSeparator: ' / ',
		
		success: function (media, node, instance) { 
			
			// Конец вопроизведения видео
			media.addEventListener("ended", function(e) { 
				
				// Вернем в начало
				instance.setCurrentTime(0);
				
			}, true);
		}
	});

});