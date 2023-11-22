// Переводы
var collapseTriggerArray = Array.from(document.querySelectorAll('[data-toggle="collapse"]'));
var i;

for (i = 0; i < collapseTriggerArray.length; i++) {
	collapseTriggerArray[i].onclick = function() {
		this.classList.toggle("is-active");
		var collapseElement = this.parentElement.nextElementSibling;

		if (getComputedStyle(collapseElement).height == 'auto') {
			// console.log('open');

			collapseElement.classList.add('o-collapsing');
			collapseElement.classList.remove('o-collapse');
			collapseElement.style.height = collapseElement.scrollHeight + "px";

			setTimeout(function () {
				collapseElement.classList.add('o-collapse', 'is-shown');
				collapseElement.classList.remove('o-collapsing');
			}, 300);
		} else {
			// console.log('close');

			collapseElement.classList.add('o-collapsing')
			collapseElement.classList.remove('o-collapse', 'is-shown');
			collapseElement.style.height = null;

			setTimeout(function () {
				collapseElement.classList.add('o-collapse');
				collapseElement.classList.remove('o-collapsing');
			}, 300);
		}
	}
}

$(document).ready(function() {

	// Общие настройки плеера
	let __player_settings = {
		features: ['playpause', 'current', 'duration', 'progress', 'fullscreen'],
		setDimensions: false,
		enableAutosize: true,
		autosizeProgress: true,
		timeAndDurationSeparator: ' / ',

		// Плеер загрузился без проишествий
		success: function (media, node, instance) {

			// Конец вопроизведения видео
			media.addEventListener("ended", function(e) {
				// Вернем в начало
				instance.setCurrentTime(0);
			}, true);
			
			// Если плеер проигрывается
			media.addEventListener("playing", function(e) {
				// Включим анимацию проигрывания
				$('body').find('.c-media-player-current__placeholder').addClass('is-active');
			}, true);
			
			// Если плеер остановлен
			media.addEventListener("pause", function(e) {
				// Выключим анимацию проигрывания
				$('body').find('.c-media-player-current__placeholder').removeClass('is-active');
			}, true);
		}
	};

	// Плеер доступный при загрузке страницы
	let __player = $('audio, video');
	__player.mediaelementplayer(__player_settings);
	
	// Выясним ноду текущего плеера
	function currentNodePlayer(){
		let __player_id = $('.mejs__container').attr('id');
		let __player_current = mejs.players[__player_id];
		
		return __player_current;
	}
	
	// Активируем первый медиафайл в плейлисте
	$('.c-media-player-playlist__item').first().addClass('is-active');
	
	// Запускаем аудио плеер в дизайнеском окне
	$('body').on('click', '.c-media-player-current-placeholder__play-btn', function(){
		
		if ( currentNodePlayer().paused ) {
			currentNodePlayer().play();
		}
		else if( !currentNodePlayer().paused ){
			currentNodePlayer().pause();
		}
	});
	
	// Переключаем плеер в плейлисте
	$('.c-media-player-playlist__item').on('click', function(){

		// Удалим все пометки активности и включим для нажатого
		$('.c-media-player-playlist__item').removeClass('is-active');
		$(this).addClass('is-active');

		// Если плеер запущен, то остановим его
		if ( !currentNodePlayer().paused ) {
			currentNodePlayer().pause();
		}

		// Удалим текущий плеер
		currentNodePlayer().remove();

		// Удалим все audio и video
		$('video, audio').each(function() {
			$(this).remove();
		});

		// Удалим wrapper
		$('.js-media-player-current-container').remove();

		// Включаем текущий трек

		// Сформируем HTML в зависимости от типа медиаматериала
		const __type = $(this).data('type');

		let __content_player = '';

		if( __type == 'AUDIO' )
		{
			__content_player = `
			<div class="js-media-player-current-container">
				<div class="o-embed-responsive o-embed-responsive--16by9 c-media-player-current-placeholder c-media-player-current__placeholder">
					<div class="o-embed-responsive__item">
						<img class="c-media-player-current-placeholder__bg" src="/local/templates/levitansky/assets/images/player/player-bg.jpg" alt="Фон плеера">
						<img class="c-media-player-current-placeholder__base" src="/local/templates/levitansky/assets/images/player/player-base.png" alt="Плеер">
						<img class="c-media-player-current-placeholder__bobbin c-media-player-current-placeholder__bobbin--left" src="/local/templates/levitansky/assets/images/player/player-bobbin-left.png" alt="Левая катушка">
						<img class="c-media-player-current-placeholder__bobbin c-media-player-current-placeholder__bobbin--right" src="/local/templates/levitansky/assets/images/player/player-bobbin-right.png" alt="Правая катушка">
						<div class="c-media-player-current-placeholder__led"></div>

						<button class="c-media-player-current-placeholder__play-btn"></button>
					</div>
				</div>

				<audio width="100%" controls="controls" preload="metadata" src="${$(this).data('src')}" type="audio/mp3">
					<track src="${$(this).data('src')}" label="${$(this).data('poster')}" srclang="ru" />
				</audio>
			</div>`;
		}
		else if( __type == 'VIDEO' )
		{
			__content_player = `
			<div class="js-media-player-current-container">
				<video poster="${$(this).data('poster')}" preload="metadata">
					<source src="${$(this).data('src')}" type="video/youtube" />
				</video>
			</div>`;
		}

		// Добавим HTML в зависимости от типа медиафайла
		$('.c-media-player-current').append(__content_player);

		// Создадим плеер
		let __player = $('audio, video');
		__player.mediaelementplayer(__player_settings);

		// Если плеер не запущен, то запустим его
		if ( !currentNodePlayer().playing ) {
			currentNodePlayer().play();
		}

	});

});

// Скроллбар для плеера (Perfect scrollbar)
var perfectScrollbar = new PerfectScrollbar('.js-perfect-scrollbar', {
	minScrollbarLength: 20,
	swipeEasing: true,
	wheelPropagation: false,
});
