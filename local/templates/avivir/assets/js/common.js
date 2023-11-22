// START: Convert to unit utility
function convertToUnit(str, unit = "rem") {
	if (str == null || str === "") {
		return undefined;
	} else if (isNaN(str)) {
		return String(str);
	} else {
		if (unit === "rem") {
			return `${Number(str) / 16}${unit}`;
		} else {
			return `${Number(str)}${unit}`;
		}
	}
}
// END: Convert to unit utility

// START: Debounce utility
function debounce(fn, delay) {
	var timer = null;
	return function () {
		var context = this,
			args = arguments;
		clearTimeout(timer);
		timer = setTimeout(function () {
			fn.apply(context, args);
		}, delay);
	};
}
// END: Debounce utility

// START: Get siblings utility
function getSiblings(elem) {
	var siblings = [];
	var sibling = elem;
	while (sibling.previousSibling) {
		sibling = sibling.previousSibling;
		sibling.nodeType == 1 && siblings.push(sibling);
	}

	sibling = elem;
	while (sibling.nextSibling) {
		sibling = sibling.nextSibling;
		sibling.nodeType == 1 && siblings.push(sibling);
	}

	return siblings;
}
// END: Get siblings utility

// START: Get scrollbar width utility
function getScrollbarWidth() {
	let documentWidth = parseInt(document.documentElement.clientWidth);
	let windowsWidth = parseInt(window.innerWidth);
	let scrollbarWidth = windowsWidth - documentWidth;
	return scrollbarWidth;
}
// END: Get scrollbar width utility

// START: Carousel
//
// Constants
const CAROUSEL_NAMESPACE = {
	containerModifierClass: "c-carousel--",
	noSwipingClass: "c-carousel--no-swiping",
	slideActiveClass: "c-carousel__item--active",
	slideBlankClass: "c-carousel__item--invisible-blank",
	slideClass: "c-carousel__item",
	slideDuplicateActiveClass: "c-carousel__item--duplicate-active",
	slideDuplicateClass: "c-carousel__item--duplicate",
	slideDuplicateNextClass: "c-carousel__item--duplicate-next",
	slideDuplicatePrevClass: "c-carousel__item--duplicate-prev",
	slideNextClass: "c-carousel__item--next",
	slidePrevClass: "c-carousel__item--prev",
	slideVisibleClass: "c-carousel__item--visible",
	wrapperClass: "c-carousel__inner",
};

const CAROUSEL_NAVIGATION_NAMESPACE = {
	disabledClass: "c-carousel__button--disabled",
	hiddenClass: "c-carousel__button--hidden",
	lockClass: "c-carousel__button--lock",
};

const CAROUSEL_PAGINATION_NAMESPACE = {
	bulletActiveClass: "c-carousel-pagination__bullet--active",
	bulletClass: "c-carousel-pagination__bullet",
	clickableClass: "c-carousel-pagination--clickable",
	currentClass: "c-carousel-pagination__current",
	hiddenClass: "c-carousel-pagination--hidden",
	lockClass: "c-carousel-pagination--lock",
	modifierClass: "c-carousel-pagination--",
	totalClass: "c-carousel-pagination__total",
	progressbarFillClass: "c-carousel-pagination__progressbar-fill",
	progressbarOppositeClass: "c-carousel-pagination--progressbar-opposite",
};

const CAROUSEL_SCROLLBAR_NAMESPACE = {
	dragClass: "c-carousel-scrollbar__drag",
	lockClass: "c-carousel-scrollbar--lock",
};

const CAROUSEL_LAZY_NAMESPACE = {
	elementClass: "c-carousel-lazy",
	loadedClass: "c-carousel-lazy--loaded",
	loadingClass: "c-carousel-lazy--loading",
	preloaderClass: "c-carousel-lazy__preloader",
};

const CAROUSEL_THUMB_NAMESPACE = {
	slideThumbActiveClass: "c-carousel__item--thumb-active",
	thumbsContainerClass: "c-carousel--thumbs",
};

const CAROUSEL_ZOOM_NAMESPACE = {
	containerClass: "c-carousel__zoom-container",
	zoomedSlideClass: "c-carousel__item--zoomed",
};

const CAROUSEL_ACCESSIBILITY_NAMESPACE = {
	notificationClass: "c-carousel__notification",
};
// END: Carousel

// Partner list carousel

let partnerListCarouselSelector = ".js-partner-list-carousel";

let partnerListCarouselConfig = {
	allowTouchMove: false,
	autoplay: {
		delay: 0,
		disableOnInteraction: false,
	},
	freeMode: true,
	freeModeMomentum: false,
	loop: true,
	loopedSlides: 7,
	slidesPerView: "auto",
	speed: 4000,
	...CAROUSEL_NAMESPACE,
};

document.addEventListener("DOMContentLoaded", function () {
	if (typeof partnerListCarouselSelector !== "undefined" && partnerListCarouselSelector !== null) {
		let partnerListCarousel = new Swiper(partnerListCarouselSelector, partnerListCarouselConfig);
	}
});

// START: Project list carousel carousel
document.addEventListener("DOMContentLoaded", function () {
	var projectListCarouselSelector = document.querySelector("#projectListCarousel");

	if (typeof projectListCarouselSelector != "undefined" && projectListCarouselSelector != null) {
		var projectListCarousel = new Swiper("#" + projectListCarouselSelector.id, {
			centeredSlides: true,
			effect: "fade",
			navigation: {
				nextEl: "#projectListCarousel .c-carousel-btn--next",
				prevEl: "#projectListCarousel .c-carousel-btn--prev",
				...CAROUSEL_NAVIGATION_NAMESPACE,
			},
			pagination: {
				el: "#projectListCarousel .c-carousel-pagination",
				type: "fraction",
				...CAROUSEL_PAGINATION_NAMESPACE,
			},
			...CAROUSEL_NAMESPACE,
		});
	}
});
// END: Project list carousel carousel

// START: Photo gallery carousel
document.addEventListener("DOMContentLoaded", function () {
	var photoGalleryCarouselSelector = document.querySelector("#photoGalleryCarousel");

	if (typeof photoGalleryCarouselSelector != "undefined" && photoGalleryCarouselSelector != null) {
		var photoGalleryCarousel = new Swiper("#" + photoGalleryCarouselSelector.id, {
			centeredSlides: true,
			effect: "fade",
			navigation: {
				nextEl: "#photoGalleryCarousel .c-carousel-btn--next",
				prevEl: "#photoGalleryCarousel .c-carousel-btn--prev",
				...CAROUSEL_NAVIGATION_NAMESPACE,
			},
			pagination: {
				el: "#photoGalleryCarousel .c-carousel-pagination",
				type: "fraction",
				...CAROUSEL_PAGINATION_NAMESPACE,
			},
			...CAROUSEL_NAMESPACE,
		});
	}
});
// END: Photo gallery carousel

// START: App bar collapse
document.addEventListener("DOMContentLoaded", function () {
	const MAIN_MENU_COLLAPSE = document.querySelector("#mainMenuCollapse");

	let scrollbarOffset = `${getScrollbarWidth(document.body)}px`;

	window.addEventListener(
		"resize",
		debounce(() => (scrollbarOffset = `${getScrollbarWidth(document.body)}px`), 300),
		false
	);

	MAIN_MENU_COLLAPSE.addEventListener("show.exo.collapse", function () {
		document.body.classList.add("c-overlay--scroll-blocked");

		document.body.style.setProperty("--scrollbar-offset", scrollbarOffset);
	});

	MAIN_MENU_COLLAPSE.addEventListener("hide.exo.collapse", function () {
		document.body.classList.remove("c-overlay--scroll-blocked");

		document.body.style.removeProperty("--scrollbar-offset");
	});
});
// END: App bar collapse

// START: App bar floating
document.addEventListener("DOMContentLoaded", function () {
	function appBarFloating() {
		const element = document.querySelector("[data-floating]");

		console.log(element);

		this.toggle = () => {
			if (element && window.matchMedia("(max-width: 74.9999em)").matches) {
				if (window.scrollY > element.offsetTop) {
					this.attach();
				} else {
					this.unpin();
				}
			}
		};

		this.attach = () => {
			element.classList.add("c-app-bar--fixed");
			element.classList.remove("c-app-bar--absolute");
		};

		this.unpin = () => {
			if (element.classList.contains("c-app-bar--fixed")) {
				element.classList.add("c-app-bar--absolute");
				element.classList.remove("c-app-bar--fixed");
			} else {
				return;
			}
		};
	}

	const floatingBar = new appBarFloating();
	floatingBar.toggle();

	// Переключение состояния app bar при ресайзе
	window.addEventListener("resize", function () {
		floatingBar.toggle();
	});

	window.addEventListener(
		"resize",
		debounce(() => floatingBar.toggle(), 150),
		false
	);

	// Переключение состояния app bar при скролле
	document.addEventListener("scroll", function () {
		floatingBar.toggle();
	});
});

// START: Masonry news list
document.addEventListener("DOMContentLoaded", function () {
	const masonryNewsListElement = document.querySelector(".js-masonry-news-list");

	if (masonryNewsListElement !== undefined && masonryNewsListElement !== null) {
		const masonryNewsList = new Masonry(masonryNewsListElement, {
			itemSelector: ".js-masonry-news-list-item",
		});
	}
});
// END: Masonry news list

// Переключение табов выпадающего меню
const appBarSecondaryNav = (function appBarSecondaryNav() {
	const app = {};

	// Получение соседних элементов
	function getSiblings(elem) {
		// Создаём массив соседних элементов и получаем первый соседний элемент
		const siblings = [];
		let sibling = elem.parentNode.firstChild;

		// Перебираем каждый соседний элемент и добавляем их в массив
		while (sibling) {
			if (sibling.nodeType === 1 && sibling !== elem) {
				siblings.push(sibling);
			}
			sibling = sibling.nextSibling;
		}

		return siblings;
	}

	// Переключение табов с категориями меню по hover (Классические табы, но не по click, а по hover)
	function handlerappBarSecondaryNav() {
		// Создаём массив из всех подходящих нам управляющих элементов
		const toggleList = Array.from(document.querySelectorAll('[data-exo-toggle="appBarSecondaryNav"]'));

		if (toggleList.length > 0) {
			for (let i = 0; i < toggleList.length; i += 1) {
				const element = toggleList[i]; // Элемент на который наводим курсор
				const parent = element.parentNode; // Родитель элемента
				const elementTarget = document.querySelector(element.getAttribute("data-exo-target")); // Целевой элемент (таб) на котором нужно переключить класс

				// При наведении на элемент получаем соседей родителя
				element.onmouseover = function elemOnMouseOver() {
					const parentSiblings = getSiblings(parent);

					// console.log(parentSiblings);

					for (let x = 0; x < parentSiblings.length; x += 1) {
						const sibling = parentSiblings[x];
						const siblingChild = sibling.querySelector('[data-exo-toggle="appBarSecondaryNav"]');

						if (sibling.classList.contains("is-active")) {
							sibling.classList.remove("is-active");
							const siblingChildTarget = document.querySelector(
								siblingChild.getAttribute("data-exo-target")
							);
							siblingChildTarget.classList.remove("is-active");
						}
					}

					parent.classList.add("is-active");
					elementTarget.classList.add("is-active");
				};
			}
		}
	}

	app.init = function init() {
		handlerappBarSecondaryNav();
	};

	return app;
})();

document.addEventListener("DOMContentLoaded", function () {
	appBarSecondaryNav.init();
});


// START: Sliders carousel 

let ctaListCarouselSelector = ".js-cta-list-carousel";

let ctaListCarouselConfig = {
	slidesPerView: 'auto',
	loop: true,
	autoplay: {
		delay: 2500,
		disableOnInteraction: false,
	},
	navigation: {
		nextEl: ".c-carousel__btn--next",
		prevEl: ".c-carousel__btn--prev",
		...CAROUSEL_NAVIGATION_NAMESPACE,
	},
	pagination: {
		el: ".c-carousel-pagination",
		...CAROUSEL_PAGINATION_NAMESPACE,
	},
	...CAROUSEL_NAMESPACE,
};

document.addEventListener("DOMContentLoaded", function () {
	let ctaWrap = document.querySelector('.c-cta-target');
	if (ctaWrap) {
		let attrSpeed = document.querySelector('.c-cta-list-carousel').getAttribute('data-time-slider');
		let attrLoop = document.querySelector('.c-cta-list-carousel').getAttribute('data-loop-slider');
		ctaListCarouselConfig.autoplay.delay = attrSpeed;	

		if (attrLoop) {
			if (typeof ctaListCarouselSelector !== "undefined" && ctaListCarouselSelector !== null) {
				let ctaListCarousel = new Swiper(ctaListCarouselSelector, ctaListCarouselConfig);
			}
		}
	}
	
	
});
// END: Sliders carousel

// START: Sliders carousel  Products

let catalogProductListCarouselSelector = ".js-c-catalog-product-carousel";

let catalogProductCarouselConfig = {
	slidesPerView: 'auto',
	loop: true,
	autoplay: {
		delay: 4000,
		disableOnInteraction: false,
	},
	navigation: {
		nextEl: ".c-carousel__btn--next",
		prevEl: ".c-carousel__btn--prev",
		...CAROUSEL_NAVIGATION_NAMESPACE,
	},
	pagination: {
		el: ".c-carousel-pagination",
		...CAROUSEL_PAGINATION_NAMESPACE,
	},
	...CAROUSEL_NAMESPACE,
};

document.addEventListener("DOMContentLoaded", function () {
	let catalogProductWrap = document.querySelector('.c-catalog-product-target');
	if (catalogProductWrap) {
		let attrSpeed = document.querySelector('.c-catalog-product-carousel').getAttribute('data-time-slider');
		let attrLoop = document.querySelector('.c-catalog-product-carousel').getAttribute('data-loop-slider');
		catalogProductCarouselConfig.autoplay.delay = attrSpeed;		
		if (attrLoop) {
			if (typeof catalogProductListCarouselSelector !== "undefined" && catalogProductListCarouselSelector !== null) {
				let catalogProductListCarousel = new Swiper(catalogProductListCarouselSelector, catalogProductCarouselConfig);
			}
		 }
	}
	
});
// END: Sliders carousel

// START: Video-player
document.addEventListener("DOMContentLoaded", function () {
	
	const videoPlayButton = document.querySelector("[data-play]");
	const playerDialogContent = document.querySelector('#dialog-video-player');
	const playerMainContent = document.querySelector('#main-video-player');
	
	const playerBackgorund = new MediaElementPlayer('#bg-video-player', {
		autoplay: true,
		success: function(mediaElement, originalNode) {
		},
	});
	const playerDialog = new MediaElementPlayer('#dialog-video-player', {
		success: function (mediaElement, originalNode) {
		
		}
	});
	const playerMain = new MediaElementPlayer('#main-video-player', {
		startVolume: 0.4,
		success: function (mediaElement, originalNode) {
		}
	});

	const playVideoPlayer = () => {
		playerDialogContent.play();
	}
	const stopedVideoPlayer = () => {
		playerDialogContent.remove();
	}

	if (videoPlayButton) {
		videoPlayButton.addEventListener('click', () => {
			playerMainContent.play();
		})
	}

	const notScrollbBody = () => {
		const bodyWrap = document.body;
		bodyWrap.style.overflowY == "hidden" ? bodyWrap.style.overflowY = "" : bodyWrap.style.overflowY = "hidden" ;
	}

	MicroModal.init({
		onShow: () => {
			notScrollbBody();
			playVideoPlayer();
		},
		onClose: () => {
			notScrollbBody();
			stopedVideoPlayer();
		},
		openTrigger: 'data-open', 
		closeTrigger: 'data-close', 
		openClass: 'is-open', 
		disableScroll: false, 
		disableFocus: false, 
		awaitOpenAnimation: true,
		awaitCloseAnimation: true
	  });

});
// END: Video-player

// START: Delivery banner 

document.addEventListener("DOMContentLoaded", function () {
	const banner = document.querySelector('#delivery-banner');
	const closeButton = document.querySelector("[data-close-banner]");
	const localBanner = { onShowBanner: true, timestamp: '' };
	const timeHiddenBanner = 300; // 5 минут

	let onShow;
	
	localStorage.getItem("localBanner") === null || JSON.parse(localStorage.getItem("localBanner")).onShowBanner === true 
		? onShow = true
		: onShow = false;
	
	const visibilityBanner = (item) => {
		item.classList.contains('is-open')
			? item.classList.remove('is-open')
			: item.classList.add('is-open');
	}

	const timerHiddenBanner = () => {
		const timeHidden = JSON.parse(localStorage.getItem("localBanner"));
		dateString = timeHidden.timestamp;
		nowTime = Math.floor((new Date().getTime()) / 1000);
		// Проверяем разницу
		(nowTime - dateString) >= timeHiddenBanner ? localBanner.onShowBanner = true
			: localBanner.onShowBanner = false;
		localBanner.timestamp = timeHidden.timestamp;
		localStorage.setItem("localBanner", JSON.stringify(localBanner));
	}

	onShow ? visibilityBanner(banner) : timerHiddenBanner();

	closeButton.addEventListener('click', () => {
		localBanner.onShowBanner = false;
		localBanner.timestamp = Math.floor((new Date().getTime()) / 1000);
		localStorage.setItem("localBanner", JSON.stringify(localBanner));
		visibilityBanner(banner);
	});
});
// END: Delivery banner 

// START: Information banner 
document.addEventListener("DOMContentLoaded", function () {
	const bannerBottom = document.querySelector('#information-banner');
	const closeButtonBottom = document.querySelector("[data-close-banner-bottom]");
	const localBannerBottom = { onShowBanner: true, timestamp: '' };
	const timeHiddenBanner = 300; // 5 минут

	let onShow;

	localStorage.getItem("localBannerBottom") === null || JSON.parse(localStorage.getItem("localBannerBottom")).onShowBanner === true 
		? onShow = true
		: onShow = false;
	
	const visibilityBannerB = (item) => {
		item.classList.contains('is-open')
			? item.classList.remove('is-open')
			: item.classList.add('is-open');
	}

	const timerHiddenBanner = () => {
		const timeHidden = JSON.parse(localStorage.getItem("localBannerBottom"));
		dateString = timeHidden.timestamp;
		nowTime = Math.floor((new Date().getTime()) / 1000);
		// Проверяем разницу
		(nowTime - dateString) >= timeHiddenBanner ? localBannerBottom.onShowBanner = true
			: localBannerBottom.onShowBanner = false;
			localBannerBottom.timestamp = timeHidden.timestamp;
		localStorage.setItem("localBannerBottom", JSON.stringify(localBannerBottom));
	}

	onShow ? visibilityBannerB(bannerBottom) : timerHiddenBanner();

	closeButtonBottom.addEventListener('click', () => {
		localBannerBottom.onShowBanner = false;
		localBannerBottom.timestamp = Math.floor((new Date().getTime()) / 1000);
		localStorage.setItem("localBannerBottom", JSON.stringify(localBannerBottom));
		visibilityBannerB(bannerBottom);
	});
});
// END: Information banner 


// START: Autoplay video on Safari
document.addEventListener("DOMContentLoaded", function () {
	let videoBg = document.getElementById('bg-video-player');
	videoBg != null ? videoBg.play() : videoBg = null;
});
// //END: Autoplay video on Safari

