document.addEventListener("DOMContentLoaded", function () {
	// Функция ymaps.ready() будет вызвана, когда
	// загрузятся все компоненты API, а также когда будет готово DOM-дерево.
	ymaps.ready(initContactPageDataMap);

	function initContactPageDataMap() {
		// Создание карты.
		let contactPageDataMap = new ymaps.Map("contactPageDataMap", {
			// Координаты центра карты.
			// Порядок по умолчанию: «широта, долгота».
			// Чтобы не определять координаты центра карты вручную,
			// воспользуйтесь инструментом Определение координат.
			center: [55.68427, 37.341547],
			// Уровень масштабирования. Допустимые значения:
			// от 0 (весь мир) до 19.
			zoom: 15,
		});

		contactPageDataMapPlacemark = new ymaps.Placemark(
			contactPageDataMap.getCenter(),
			{
				hintContent:
					"«Авивир» — Инновационные решения для комплексных проектов в здравоохранении",
				// balloonContent: 'Это красивая метка'
			},
			{
				// Опции.
				// Необходимо указать данный тип макета.
				iconLayout: "default#image",
				// Своё изображение иконки метки.
				iconImageHref:
					"/upload/images/icons/duotone/icon-brand-map-marker.svg",
				// Размеры метки.
				iconImageSize: [40, 40],
				// Смещение левого верхнего угла иконки относительно
				// её "ножки" (точки привязки).
				iconImageOffset: [-20, -40],
			}
		);

		contactPageDataMap.geoObjects.add(contactPageDataMapPlacemark);
	}
});
