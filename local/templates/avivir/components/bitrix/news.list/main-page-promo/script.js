var mediaScreen = parseInt(document.body.clientWidth);
var parallaxTableSelector = document.querySelector('.js-main-page-parallax-table');
var parallaxTableInput = document.querySelector('.js-main-page-parallax-table-input');

if (mediaScreen < 1200) {
	// Прокрутка сцены к центру на мобильных
	parallaxTableInput.scrollTo({
		// behavior: 'smooth',
		top: 736,
		left: 2359
	});
}

if (mediaScreen >= 1200) {
	// Параллакс
	var parallaxTable = new Parallax(parallaxTableSelector, {
		inputElement: parallaxTableInput,
		relativeInput: true,
		clipRelativeInput: true,
		hoverOnly: true,
		precision: true,
		frictionX: "0.005",
		frictionY: "0.005",
		limitX: "7000", // 150% видимой сцены
		limitY: "4424", // 150% видимой сцены
		originX: "0.5",
		originY: "0.4875",
		scalarX: "750",
		scalarY: "750",
	});
}

// Набор стихотворения
function typeWriter(t) {
	var HTML = t.innerHTML;

	t.innerHTML = "";

	var cursorPosition = 0,
	tag = "",
	writingTag = false,
	tagOpen = false,
	typeSpeed = 100,
	tempTypeSpeed = 0;

	var type = function() {
		if (writingTag === true) {
			tag += HTML[cursorPosition];
		}

		if (HTML[cursorPosition] === "<") {
			tempTypeSpeed = 0;
			if (tagOpen) {
				tagOpen = false;
				writingTag = true;
			} else {
				tag = "";
				tagOpen = true;
				writingTag = true;
				tag += HTML[cursorPosition];
			}
		}

		if (!writingTag && tagOpen) {
			tag.innerHTML += HTML[cursorPosition];
		}

		if (!writingTag && !tagOpen) {
			if (HTML[cursorPosition] === " ") {
				tempTypeSpeed = 0;
			}
			else {
				tempTypeSpeed = (Math.random() * typeSpeed) + 50;
			}
			t.innerHTML += HTML[cursorPosition];
		}

		if (writingTag === true && HTML[cursorPosition] === ">") {
			tempTypeSpeed = (Math.random() * typeSpeed) + 50;
			writingTag = false;
			if (tagOpen) {
				var newSpan = document.createElement("span");
				t.appendChild(newSpan);
				newSpan.innerHTML = tag;
				tag = newSpan.firstChild;
			}
		}

		cursorPosition += 1;
		if (cursorPosition < HTML.length - 1) {
			setTimeout(type, tempTypeSpeed);
		}
	};

	return {
		type: type
	};
}

var typingPoetry = document.querySelector('.js-typing-poetry');

typeWriter(typingPoetry).type();