var eventCarousel = new Swiper('.js-event-carousel', {
	breakpoints: {
		// when window width is >= 992px
		992: {
			slidesPerView: 1,
		},
	},
	direction: 'horizontal',
	loop: false,
	pagination: {
		clickable: true,
		el: '.js-event-carousel .swiper-pagination',
	},
	slidesPerView: 'auto',
});
