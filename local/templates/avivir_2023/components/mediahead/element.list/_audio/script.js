$(document).ready(function() {
	
	var __player = $('audio');
	
	__player.mediaelementplayer({
		features: ['prevtrack', 'playpause', 'nexttrack', 'current', 'duration', 'progress'],
		setDimensions: false,
		enableAutosize: true,
		autosizeProgress: true,
		timeAndDurationSeparator: ' / ',
		
		success: function (media, node, instance) { 
			
			// Конец вопроизведения трека
			media.addEventListener("ended", function(e) { 
				
				// Номер следующего трека
				var nextTrack = node.dataset.next;
				
				// Вернем в начало
				instance.setCurrentTime(0);
				
				// Запустим следующий трек
				__player[ nextTrack ].play();
				
			}, true);
			
			// Следующий трек
			instance.nextButton.addEventListener('click', function(e) {
				
				// Номер следующего трека
				var nextTrack = node.dataset.next;
				
				// Остановим текущий трек
				instance.pause();
				
				// Вернем в начало
				instance.setCurrentTime(0);
				
				// Запустим следующий трек
				__player[ nextTrack ].play();
				
			});
			
			// Предыдущий трек
			instance.prevButton.addEventListener('click', function(e) {
				
				// Номер следующего трека
				var prevTrack = node.dataset.prev;
				
				// Остановим текущий трек
				instance.pause();
				
				// Вернем в начало
				instance.setCurrentTime(0);
				
				// Запустим предыдущий трек
				__player[ prevTrack ].play();
				
			});
		}
	});

});