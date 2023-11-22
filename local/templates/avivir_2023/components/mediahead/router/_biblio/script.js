var personReviewCollapseToggler = document.querySelector('.js-biblio-about-toggler');
var personReviewCollapseTogglerText = personReviewCollapseToggler.querySelector('.c-btn__text');
var personReviewCollapseClose = document.querySelector('.js-biblio-about-close');
var personReviewCollapse = document.querySelector('.js-biblio-about-collapse');

if (
	typeof personReviewCollapseToggler !== 'undefined' &&
	personReviewCollapseToggler !== null &&
	typeof personReviewCollapse !== 'undefined' &&
	personReviewCollapse !== null
) {
	personReviewCollapseToggler.onclick = function () {
		if (personReviewCollapseTogglerText.innerText.toLowerCase() === 'подробнее') {
			personReviewCollapseTogglerText.innerText = 'Свернуть';
		}
		else {
			personReviewCollapseTogglerText.innerText = 'Подробнее';
		}

		personReviewCollapse.classList.toggle('is-shown');
		personReviewCollapseClose.classList.toggle('is-shown');

		if (personReviewCollapse.classList.contains('is-shown')) {
			document.querySelector('.c-biblio-about').scrollIntoView()
		}
	};

	personReviewCollapseClose.onclick = function () {
		if(personReviewCollapseTogglerText.innerText.toLowerCase() === 'подробнее') {
			personReviewCollapseTogglerText.innerText = 'Свернуть';
		}
		else {
			personReviewCollapseTogglerText.innerText = 'Подробнее';
		}

		personReviewCollapse.classList.remove('is-shown');
		this.classList.toggle('is-shown');
	};
};
