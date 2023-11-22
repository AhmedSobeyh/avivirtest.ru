$(document).ready(function() {
	
	var __player = $('audio');
	
	__player.mediaelementplayer({
		features: ['playpause', 'current', 'duration', 'progress'],
		setDimensions: false,
		enableAutosize: true,
		autosizeProgress: true,
		timeAndDurationSeparator: ' / ',
		
		success: function (media, node, instance) {
			// Конец воспроизведения трека
			media.addEventListener("ended", function(e) {
				
				// Вернем в начало
				instance.setCurrentTime(0);
				
			}, true);
		}
	});

});