/*!
 * Exo v0.0.1
 * Licensed under MIT
 */
(function (global, factory) {
	typeof exports === "object" && typeof module !== "undefined"
		? (module.exports = factory())
		: typeof define === "function" && define.amd
		? define(factory)
		: ((global =
				typeof globalThis !== "undefined"
					? globalThis
					: global || self),
		  (global.exo = factory()));
})(this, function () {
	"use strict";

	/**
	 * --------------------------------------------------------------------------
	 * Exo (v0.0.1): util/index.js
	 * Licensed under MIT
	 * --------------------------------------------------------------------------
	 */
	const MAX_UID = 1000000;
	const MILLISECONDS_MULTIPLIER = 1000;
	const TRANSITION_END = "transitionend"; // Shoutout AngusCroll (https://goo.gl/pxwQGp)

	const toType = (obj) => {
		if (obj === null || obj === undefined) {
			return `${obj}`;
		}

		return {}.toString
			.call(obj)
			.match(/\s([a-z]+)/i)[1]
			.toLowerCase();
	};
	/**
	 * --------------------------------------------------------------------------
	 * Public Util Api
	 * --------------------------------------------------------------------------
	 */

	const getUID = (prefix) => {
		do {
			prefix += Math.floor(Math.random() * MAX_UID);
		} while (document.getElementById(prefix));

		return prefix;
	};

	const getSelector = (element) => {
		let selector = element.getAttribute("data-exo-target");

		if (!selector || selector === "#") {
			let hrefAttr = element.getAttribute("href"); // The only valid content that could double as a selector are IDs or classes,
			// so everything starting with `#` or `.`. If a "real" URL is used as the selector,
			// `document.querySelector` will rightfully complain it is invalid.
			// See https://github.com/twbs/bootstrap/issues/32273

			if (
				!hrefAttr ||
				(!hrefAttr.includes("#") && !hrefAttr.startsWith("."))
			) {
				return null;
			} // Just in case some CMS puts out a full URL with the anchor appended

			if (hrefAttr.includes("#") && !hrefAttr.startsWith("#")) {
				hrefAttr = `#${hrefAttr.split("#")[1]}`;
			}

			selector = hrefAttr && hrefAttr !== "#" ? hrefAttr.trim() : null;
		}

		return selector;
	};

	const getSelectorFromElement = (element) => {
		const selector = getSelector(element);

		if (selector) {
			return document.querySelector(selector) ? selector : null;
		}

		return null;
	};

	const getElementFromSelector = (element) => {
		const selector = getSelector(element);
		return selector ? document.querySelector(selector) : null;
	};

	const getTransitionDurationFromElement = (element) => {
		if (!element) {
			return 0;
		} // Get transition-duration of the element

		let { transitionDuration, transitionDelay } =
			window.getComputedStyle(element);
		const floatTransitionDuration = Number.parseFloat(transitionDuration);
		const floatTransitionDelay = Number.parseFloat(transitionDelay); // Return 0 if element or transition duration is not found

		if (!floatTransitionDuration && !floatTransitionDelay) {
			return 0;
		} // If multiple durations are defined, take the first

		transitionDuration = transitionDuration.split(",")[0];
		transitionDelay = transitionDelay.split(",")[0];
		return (
			(Number.parseFloat(transitionDuration) +
				Number.parseFloat(transitionDelay)) *
			MILLISECONDS_MULTIPLIER
		);
	};

	const triggerTransitionEnd = (element) => {
		element.dispatchEvent(new Event(TRANSITION_END));
	};

	const isElement$1 = (obj) => {
		if (!obj || typeof obj !== "object") {
			return false;
		}

		if (typeof obj.jquery !== "undefined") {
			obj = obj[0];
		}

		return typeof obj.nodeType !== "undefined";
	};

	const getElement = (obj) => {
		if (isElement$1(obj)) {
			// it's a jQuery object or a node element
			return obj.jquery ? obj[0] : obj;
		}

		if (typeof obj === "string" && obj.length > 0) {
			return document.querySelector(obj);
		}

		return null;
	};

	const typeCheckConfig = (componentName, config, configTypes) => {
		Object.keys(configTypes).forEach((property) => {
			const expectedTypes = configTypes[property];
			const value = config[property];
			const valueType =
				value && isElement$1(value) ? "element" : toType(value);

			if (!new RegExp(expectedTypes).test(valueType)) {
				throw new TypeError(
					`${componentName.toUpperCase()}: Option "${property}" provided type "${valueType}" but expected type "${expectedTypes}".`
				);
			}
		});
	};

	const isVisible = (element) => {
		if (!isElement$1(element) || element.getClientRects().length === 0) {
			return false;
		}

		return (
			getComputedStyle(element).getPropertyValue("visibility") ===
			"visible"
		);
	};

	const isDisabled = (element) => {
		if (!element || element.nodeType !== Node.ELEMENT_NODE) {
			return true;
		}

		if (element.classList.contains("disabled")) {
			return true;
		}

		if (typeof element.disabled !== "undefined") {
			return element.disabled;
		}

		return (
			element.hasAttribute("disabled") &&
			element.getAttribute("disabled") !== "false"
		);
	};

	const findShadowRoot = (element) => {
		if (!document.documentElement.attachShadow) {
			return null;
		} // Can find the shadow root otherwise it'll return the document

		if (typeof element.getRootNode === "function") {
			const root = element.getRootNode();
			return root instanceof ShadowRoot ? root : null;
		}

		if (element instanceof ShadowRoot) {
			return element;
		} // when we don't find a shadow root

		if (!element.parentNode) {
			return null;
		}

		return findShadowRoot(element.parentNode);
	};

	const noop = () => {};
	/**
	 * Trick to restart an element's animation
	 *
	 * @param {HTMLElement} element
	 * @return void
	 *
	 * @see https://www.charistheo.io/blog/2021/02/restart-a-css-animation-with-javascript/#restarting-a-css-animation
	 */

	const reflow = (element) => {
		// eslint-disable-next-line no-unused-expressions
		element.offsetHeight;
	};

	const getjQuery = () => {
		const { jQuery } = window;

		if (jQuery && !document.body.hasAttribute("data-exo-no-jquery")) {
			return jQuery;
		}

		return null;
	};

	const DOMContentLoadedCallbacks = [];

	const onDOMContentLoaded = (callback) => {
		if (document.readyState === "loading") {
			// add listener on the first call when the document is in loading state
			if (!DOMContentLoadedCallbacks.length) {
				document.addEventListener("DOMContentLoaded", () => {
					DOMContentLoadedCallbacks.forEach((callback) => callback());
				});
			}

			DOMContentLoadedCallbacks.push(callback);
		} else {
			callback();
		}
	};

	const isRTL = () => document.documentElement.dir === "rtl";

	const defineJQueryPlugin = (plugin) => {
		onDOMContentLoaded(() => {
			const $ = getjQuery();
			/* istanbul ignore if */

			if ($) {
				const name = plugin.NAME;
				const JQUERY_NO_CONFLICT = $.fn[name];
				$.fn[name] = plugin.jQueryInterface;
				$.fn[name].Constructor = plugin;

				$.fn[name].noConflict = () => {
					$.fn[name] = JQUERY_NO_CONFLICT;
					return plugin.jQueryInterface;
				};
			}
		});
	};

	const execute = (callback) => {
		if (typeof callback === "function") {
			callback();
		}
	};

	const executeAfterTransition = (
		callback,
		transitionElement,
		waitForTransition = true
	) => {
		if (!waitForTransition) {
			execute(callback);
			return;
		}

		const durationPadding = 5;
		const emulatedDuration =
			getTransitionDurationFromElement(transitionElement) +
			durationPadding;
		let called = false;

		const handler = ({ target }) => {
			if (target !== transitionElement) {
				return;
			}

			called = true;
			transitionElement.removeEventListener(TRANSITION_END, handler);
			execute(callback);
		};

		transitionElement.addEventListener(TRANSITION_END, handler);
		setTimeout(() => {
			if (!called) {
				triggerTransitionEnd(transitionElement);
			}
		}, emulatedDuration);
	};
	/**
	 * Return the previous/next element of a list.
	 *
	 * @param {array} list    The list of elements
	 * @param activeElement   The active element
	 * @param shouldGetNext   Choose to get next or previous element
	 * @param isCycleAllowed
	 * @return {Element|elem} The proper element
	 */

	const getNextActiveElement = (
		list,
		activeElement,
		shouldGetNext,
		isCycleAllowed
	) => {
		let index = list.indexOf(activeElement); // if the element does not exist in the list return an element depending on the direction and if cycle is allowed

		if (index === -1) {
			return list[!shouldGetNext && isCycleAllowed ? list.length - 1 : 0];
		}

		const listLength = list.length;
		index += shouldGetNext ? 1 : -1;

		if (isCycleAllowed) {
			index = (index + listLength) % listLength;
		}

		return list[Math.max(0, Math.min(index, listLength - 1))];
	};

	/**
	 * --------------------------------------------------------------------------
	 * Exo (v0.0.1): dom/event-handler.js
	 * Licensed under MIT
	 * --------------------------------------------------------------------------
	 */
	/**
	 * ------------------------------------------------------------------------
	 * Constants
	 * ------------------------------------------------------------------------
	 */

	const namespaceRegex = /[^.]*(?=\..*)\.|.*/;
	const stripNameRegex = /\..*/;
	const stripUidRegex = /::\d+$/;
	const eventRegistry = {}; // Events storage

	let uidEvent = 1;
	const customEvents = {
		mouseenter: "mouseover",
		mouseleave: "mouseout",
	};
	const customEventsRegex = /^(mouseenter|mouseleave)/i;
	const nativeEvents = new Set([
		"click",
		"dblclick",
		"mouseup",
		"mousedown",
		"contextmenu",
		"mousewheel",
		"DOMMouseScroll",
		"mouseover",
		"mouseout",
		"mousemove",
		"selectstart",
		"selectend",
		"keydown",
		"keypress",
		"keyup",
		"orientationchange",
		"touchstart",
		"touchmove",
		"touchend",
		"touchcancel",
		"pointerdown",
		"pointermove",
		"pointerup",
		"pointerleave",
		"pointercancel",
		"gesturestart",
		"gesturechange",
		"gestureend",
		"focus",
		"blur",
		"change",
		"reset",
		"select",
		"submit",
		"focusin",
		"focusout",
		"load",
		"unload",
		"beforeunload",
		"resize",
		"move",
		"DOMContentLoaded",
		"readystatechange",
		"error",
		"abort",
		"scroll",
	]);
	/**
	 * ------------------------------------------------------------------------
	 * Private methods
	 * ------------------------------------------------------------------------
	 */

	function getUidEvent(element, uid) {
		return (
			(uid && `${uid}::${uidEvent++}`) || element.uidEvent || uidEvent++
		);
	}

	function getEvent(element) {
		const uid = getUidEvent(element);
		element.uidEvent = uid;
		eventRegistry[uid] = eventRegistry[uid] || {};
		return eventRegistry[uid];
	}

	function exoHandler(element, fn) {
		return function handler(event) {
			event.delegateTarget = element;

			if (handler.oneOff) {
				EventHandler.off(element, event.type, fn);
			}

			return fn.apply(element, [event]);
		};
	}

	function exoDelegationHandler(element, selector, fn) {
		return function handler(event) {
			const domElements = element.querySelectorAll(selector);

			for (
				let { target } = event;
				target && target !== this;
				target = target.parentNode
			) {
				for (let i = domElements.length; i--; ) {
					if (domElements[i] === target) {
						event.delegateTarget = target;

						if (handler.oneOff) {
							EventHandler.off(element, event.type, selector, fn);
						}

						return fn.apply(target, [event]);
					}
				}
			} // To please ESLint

			return null;
		};
	}

	function findHandler(events, handler, delegationSelector = null) {
		const uidEventList = Object.keys(events);

		for (let i = 0, len = uidEventList.length; i < len; i++) {
			const event = events[uidEventList[i]];

			if (
				event.originalHandler === handler &&
				event.delegationSelector === delegationSelector
			) {
				return event;
			}
		}

		return null;
	}

	function normalizeParams(originalTypeEvent, handler, delegationFn) {
		const delegation = typeof handler === "string";
		const originalHandler = delegation ? delegationFn : handler;
		let typeEvent = getTypeEvent(originalTypeEvent);
		const isNative = nativeEvents.has(typeEvent);

		if (!isNative) {
			typeEvent = originalTypeEvent;
		}

		return [delegation, originalHandler, typeEvent];
	}

	function addHandler(
		element,
		originalTypeEvent,
		handler,
		delegationFn,
		oneOff
	) {
		if (typeof originalTypeEvent !== "string" || !element) {
			return;
		}

		if (!handler) {
			handler = delegationFn;
			delegationFn = null;
		} // in case of mouseenter or mouseleave wrap the handler within a function that checks for its DOM position
		// this prevents the handler from being dispatched the same way as mouseover or mouseout does

		if (customEventsRegex.test(originalTypeEvent)) {
			const wrapFn = (fn) => {
				return function (event) {
					if (
						!event.relatedTarget ||
						(event.relatedTarget !== event.delegateTarget &&
							!event.delegateTarget.contains(event.relatedTarget))
					) {
						return fn.call(this, event);
					}
				};
			};

			if (delegationFn) {
				delegationFn = wrapFn(delegationFn);
			} else {
				handler = wrapFn(handler);
			}
		}

		const [delegation, originalHandler, typeEvent] = normalizeParams(
			originalTypeEvent,
			handler,
			delegationFn
		);
		const events = getEvent(element);
		const handlers = events[typeEvent] || (events[typeEvent] = {});
		const previousFn = findHandler(
			handlers,
			originalHandler,
			delegation ? handler : null
		);

		if (previousFn) {
			previousFn.oneOff = previousFn.oneOff && oneOff;
			return;
		}

		const uid = getUidEvent(
			originalHandler,
			originalTypeEvent.replace(namespaceRegex, "")
		);
		const fn = delegation
			? exoDelegationHandler(element, handler, delegationFn)
			: exoHandler(element, handler);
		fn.delegationSelector = delegation ? handler : null;
		fn.originalHandler = originalHandler;
		fn.oneOff = oneOff;
		fn.uidEvent = uid;
		handlers[uid] = fn;
		element.addEventListener(typeEvent, fn, delegation);
	}

	function removeHandler(
		element,
		events,
		typeEvent,
		handler,
		delegationSelector
	) {
		const fn = findHandler(events[typeEvent], handler, delegationSelector);

		if (!fn) {
			return;
		}

		element.removeEventListener(typeEvent, fn, Boolean(delegationSelector));
		delete events[typeEvent][fn.uidEvent];
	}

	function removeNamespacedHandlers(element, events, typeEvent, namespace) {
		const storeElementEvent = events[typeEvent] || {};
		Object.keys(storeElementEvent).forEach((handlerKey) => {
			if (handlerKey.includes(namespace)) {
				const event = storeElementEvent[handlerKey];
				removeHandler(
					element,
					events,
					typeEvent,
					event.originalHandler,
					event.delegationSelector
				);
			}
		});
	}

	function getTypeEvent(event) {
		// allow to get the native events from namespaced events ('click.exo.button' --> 'click')
		event = event.replace(stripNameRegex, "");
		return customEvents[event] || event;
	}

	const EventHandler = {
		on(element, event, handler, delegationFn) {
			addHandler(element, event, handler, delegationFn, false);
		},

		one(element, event, handler, delegationFn) {
			addHandler(element, event, handler, delegationFn, true);
		},

		off(element, originalTypeEvent, handler, delegationFn) {
			if (typeof originalTypeEvent !== "string" || !element) {
				return;
			}

			const [delegation, originalHandler, typeEvent] = normalizeParams(
				originalTypeEvent,
				handler,
				delegationFn
			);
			const inNamespace = typeEvent !== originalTypeEvent;
			const events = getEvent(element);
			const isNamespace = originalTypeEvent.startsWith(".");

			if (typeof originalHandler !== "undefined") {
				// Simplest case: handler is passed, remove that listener ONLY.
				if (!events || !events[typeEvent]) {
					return;
				}

				removeHandler(
					element,
					events,
					typeEvent,
					originalHandler,
					delegation ? handler : null
				);
				return;
			}

			if (isNamespace) {
				Object.keys(events).forEach((elementEvent) => {
					removeNamespacedHandlers(
						element,
						events,
						elementEvent,
						originalTypeEvent.slice(1)
					);
				});
			}

			const storeElementEvent = events[typeEvent] || {};
			Object.keys(storeElementEvent).forEach((keyHandlers) => {
				const handlerKey = keyHandlers.replace(stripUidRegex, "");

				if (!inNamespace || originalTypeEvent.includes(handlerKey)) {
					const event = storeElementEvent[keyHandlers];
					removeHandler(
						element,
						events,
						typeEvent,
						event.originalHandler,
						event.delegationSelector
					);
				}
			});
		},

		trigger(element, event, args) {
			if (typeof event !== "string" || !element) {
				return null;
			}

			const $ = getjQuery();
			const typeEvent = getTypeEvent(event);
			const inNamespace = event !== typeEvent;
			const isNative = nativeEvents.has(typeEvent);
			let jQueryEvent;
			let bubbles = true;
			let nativeDispatch = true;
			let defaultPrevented = false;
			let evt = null;

			if (inNamespace && $) {
				jQueryEvent = $.Event(event, args);
				$(element).trigger(jQueryEvent);
				bubbles = !jQueryEvent.isPropagationStopped();
				nativeDispatch = !jQueryEvent.isImmediatePropagationStopped();
				defaultPrevented = jQueryEvent.isDefaultPrevented();
			}

			if (isNative) {
				evt = document.createEvent("HTMLEvents");
				evt.initEvent(typeEvent, bubbles, true);
			} else {
				evt = new CustomEvent(event, {
					bubbles,
					cancelable: true,
				});
			} // merge custom information in our event

			if (typeof args !== "undefined") {
				Object.keys(args).forEach((key) => {
					Object.defineProperty(evt, key, {
						get() {
							return args[key];
						},
					});
				});
			}

			if (defaultPrevented) {
				evt.preventDefault();
			}

			if (nativeDispatch) {
				element.dispatchEvent(evt);
			}

			if (evt.defaultPrevented && typeof jQueryEvent !== "undefined") {
				jQueryEvent.preventDefault();
			}

			return evt;
		},
	};

	/**
	 * --------------------------------------------------------------------------
	 * Exo (v0.0.1): dom/data.js
	 * Licensed under MIT
	 * --------------------------------------------------------------------------
	 */

	/**
	 * ------------------------------------------------------------------------
	 * Constants
	 * ------------------------------------------------------------------------
	 */
	const elementMap = new Map();
	var Data = {
		set(element, key, instance) {
			if (!elementMap.has(element)) {
				elementMap.set(element, new Map());
			}

			const instanceMap = elementMap.get(element); // make it clear we only want one instance per element
			// can be removed later when multiple key/instances are fine to be used

			if (!instanceMap.has(key) && instanceMap.size !== 0) {
				// eslint-disable-next-line no-console
				console.error(
					`Exo doesn't allow more than one instance per element. Bound instance: ${
						Array.from(instanceMap.keys())[0]
					}.`
				);
				return;
			}

			instanceMap.set(key, instance);
		},

		get(element, key) {
			if (elementMap.has(element)) {
				return elementMap.get(element).get(key) || null;
			}

			return null;
		},

		remove(element, key) {
			if (!elementMap.has(element)) {
				return;
			}

			const instanceMap = elementMap.get(element);
			instanceMap.delete(key); // free up element references if there are no instances left for an element

			if (instanceMap.size === 0) {
				elementMap.delete(element);
			}
		},
	};

	/**
	 * --------------------------------------------------------------------------
	 * Exo (v0.0.1): base-component.js
	 * Licensed under MIT
	 * --------------------------------------------------------------------------
	 */
	/**
	 * ------------------------------------------------------------------------
	 * Constants
	 * ------------------------------------------------------------------------
	 */

	const VERSION = "5.1.1";

	class BaseComponent {
		constructor(element) {
			element = getElement(element);

			if (!element) {
				return;
			}

			this._element = element;
			Data.set(this._element, this.constructor.DATA_KEY, this);
		}

		dispose() {
			Data.remove(this._element, this.constructor.DATA_KEY);
			EventHandler.off(this._element, this.constructor.EVENT_KEY);
			Object.getOwnPropertyNames(this).forEach((propertyName) => {
				this[propertyName] = null;
			});
		}

		_queueCallback(callback, element, isAnimated = true) {
			executeAfterTransition(callback, element, isAnimated);
		}
		/** Static */

		static getInstance(element) {
			return Data.get(getElement(element), this.DATA_KEY);
		}

		static getOrCreateInstance(element, config = {}) {
			return (
				this.getInstance(element) ||
				new this(element, typeof config === "object" ? config : null)
			);
		}

		static get VERSION() {
			return VERSION;
		}

		static get NAME() {
			throw new Error(
				'You have to implement the static method "NAME", for each component!'
			);
		}

		static get DATA_KEY() {
			return `exo.${this.NAME}`;
		}

		static get EVENT_KEY() {
			return `.${this.DATA_KEY}`;
		}
	}

	/**
	 * --------------------------------------------------------------------------
	 * Exo (v0.0.1): util/component-functions.js
	 * Licensed under MIT
	 * --------------------------------------------------------------------------
	 */

	const enableDismissTrigger = (component, method = "hide") => {
		const clickEvent = `click.dismiss${component.EVENT_KEY}`;
		const name = component.NAME;
		EventHandler.on(
			document,
			clickEvent,
			`[data-exo-dismiss="${name}"]`,
			function (event) {
				if (["A", "AREA"].includes(this.tagName)) {
					event.preventDefault();
				}

				if (isDisabled(this)) {
					return;
				}

				const target =
					getElementFromSelector(this) || this.closest(`.${name}`);
				const instance = component.getOrCreateInstance(target); // Method argument is left, for Alert and only, as it doesn't implement the 'hide' method

				instance[method]();
			}
		);
	};

	/**
	 * --------------------------------------------------------------------------
	 * Exo (v0.0.1): dom/manipulator.js
	 * Licensed under MIT
	 * --------------------------------------------------------------------------
	 */
	function normalizeData(val) {
		if (val === "true") {
			return true;
		}

		if (val === "false") {
			return false;
		}

		if (val === Number(val).toString()) {
			return Number(val);
		}

		if (val === "" || val === "null") {
			return null;
		}

		return val;
	}

	function normalizeDataKey(key) {
		return key.replace(/[A-Z]/g, (chr) => `-${chr.toLowerCase()}`);
	}

	const Manipulator = {
		setDataAttribute(element, key, value) {
			element.setAttribute(`data-exo-${normalizeDataKey(key)}`, value);
		},

		removeDataAttribute(element, key) {
			element.removeAttribute(`data-exo-${normalizeDataKey(key)}`);
		},

		getDataAttributes(element) {
			if (!element) {
				return {};
			}

			const attributes = {};
			Object.keys(element.dataset)
				.filter((key) => key.startsWith("exo"))
				.forEach((key) => {
					let pureKey = key.replace(/^exo/, "");
					pureKey =
						pureKey.charAt(0).toLowerCase() +
						pureKey.slice(1, pureKey.length);
					attributes[pureKey] = normalizeData(element.dataset[key]);
				});
			return attributes;
		},

		getDataAttribute(element, key) {
			return normalizeData(
				element.getAttribute(`data-exo-${normalizeDataKey(key)}`)
			);
		},

		offset(element) {
			const rect = element.getBoundingClientRect();
			return {
				top: rect.top + window.pageYOffset,
				left: rect.left + window.pageXOffset,
			};
		},

		position(element) {
			return {
				top: element.offsetTop,
				left: element.offsetLeft,
			};
		},
	};

	/**
	 * --------------------------------------------------------------------------
	 * Exo (v0.0.1): dom/selector-engine.js
	 * Licensed under MIT
	 * --------------------------------------------------------------------------
	 */
	const NODE_TEXT = 3;
	const SelectorEngine = {
		find(selector, element = document.documentElement) {
			return [].concat(
				...Element.prototype.querySelectorAll.call(element, selector)
			);
		},

		findOne(selector, element = document.documentElement) {
			return Element.prototype.querySelector.call(element, selector);
		},

		children(element, selector) {
			return []
				.concat(...element.children)
				.filter((child) => child.matches(selector));
		},

		parents(element, selector) {
			const parents = [];
			let ancestor = element.parentNode;

			while (
				ancestor &&
				ancestor.nodeType === Node.ELEMENT_NODE &&
				ancestor.nodeType !== NODE_TEXT
			) {
				if (ancestor.matches(selector)) {
					parents.push(ancestor);
				}

				ancestor = ancestor.parentNode;
			}

			return parents;
		},

		prev(element, selector) {
			let previous = element.previousElementSibling;

			while (previous) {
				if (previous.matches(selector)) {
					return [previous];
				}

				previous = previous.previousElementSibling;
			}

			return [];
		},

		next(element, selector) {
			let next = element.nextElementSibling;

			while (next) {
				if (next.matches(selector)) {
					return [next];
				}

				next = next.nextElementSibling;
			}

			return [];
		},

		focusableChildren(element) {
			const focusables = [
				"a",
				"button",
				"input",
				"textarea",
				"select",
				"details",
				"[tabindex]",
				'[contenteditable="true"]',
			]
				.map((selector) => `${selector}:not([tabindex^="-"])`)
				.join(", ");
			return this.find(focusables, element).filter(
				(el) => !isDisabled(el) && isVisible(el)
			);
		},
	};

	/**
	 * --------------------------------------------------------------------------
	 * Exo (v0.0.1): collapse.js
	 * Licensed under MIT
	 * --------------------------------------------------------------------------
	 */
	/**
	 * ------------------------------------------------------------------------
	 * Constants
	 * ------------------------------------------------------------------------
	 */

	const NAME$a = "collapse";
	const DATA_KEY$9 = "exo.collapse";
	const EVENT_KEY$9 = `.${DATA_KEY$9}`;
	const DATA_API_KEY$5 = ".data-api";
	const Default$9 = {
		toggle: true,
		parent: null,
	};
	const DefaultType$9 = {
		toggle: "boolean",
		parent: "(null|element)",
	};
	const EVENT_SHOW$5 = `show${EVENT_KEY$9}`;
	const EVENT_SHOWN$5 = `shown${EVENT_KEY$9}`;
	const EVENT_HIDE$5 = `hide${EVENT_KEY$9}`;
	const EVENT_HIDDEN$5 = `hidden${EVENT_KEY$9}`;
	const EVENT_CLICK_DATA_API$4 = `click${EVENT_KEY$9}${DATA_API_KEY$5}`;
	const CLASS_NAME_SHOW$7 = "is-shown";
	const CLASS_NAME_COLLAPSE = "c-collapse";
	const CLASS_NAME_COLLAPSING = "c-collapse--transition";
	const CLASS_NAME_COLLAPSED = "is-collapsed";
	const CLASS_NAME_HORIZONTAL = "c-collapse--horizontal";
	const WIDTH = "width";
	const HEIGHT = "height";
	const SELECTOR_ACTIVES =
		".c-collapse.is-shown, .c-collapse.c-collapse--transition";
	const SELECTOR_DATA_TOGGLE$4 = '[data-exo-toggle="collapse"]';
	/**
	 * ------------------------------------------------------------------------
	 * Class Definition
	 * ------------------------------------------------------------------------
	 */

	class Collapse extends BaseComponent {
		constructor(element, config) {
			super(element);
			this._isTransitioning = false;
			this._config = this._getConfig(config);
			this._triggerArray = [];
			const toggleList = SelectorEngine.find(SELECTOR_DATA_TOGGLE$4);

			for (let i = 0, len = toggleList.length; i < len; i++) {
				const elem = toggleList[i];
				const selector = getSelectorFromElement(elem);
				const filterElement = SelectorEngine.find(selector).filter(
					(foundElem) => foundElem === this._element
				);

				if (selector !== null && filterElement.length) {
					this._selector = selector;

					this._triggerArray.push(elem);
				}
			}

			this._initializeChildren();

			if (!this._config.parent) {
				this._addAriaAndCollapsedClass(
					this._triggerArray,
					this._isShown()
				);
			}

			if (this._config.toggle) {
				this.toggle();
			}
		} // Getters

		static get Default() {
			return Default$9;
		}

		static get NAME() {
			return NAME$a;
		} // Public

		toggle() {
			if (this._isShown()) {
				this.hide();
			} else {
				this.show();
			}
		}

		show() {
			if (this._isTransitioning || this._isShown()) {
				return;
			}

			let actives = [];
			let activesData;

			if (this._config.parent) {
				const children = SelectorEngine.find(
					`.${CLASS_NAME_COLLAPSE} .${CLASS_NAME_COLLAPSE}`,
					this._config.parent
				);
				actives = SelectorEngine.find(
					SELECTOR_ACTIVES,
					this._config.parent
				).filter((elem) => !children.includes(elem)); // remove children if greater depth
			}

			const container = SelectorEngine.findOne(this._selector);

			if (actives.length) {
				const tempActiveData = actives.find(
					(elem) => container !== elem
				);
				activesData = tempActiveData
					? Collapse.getInstance(tempActiveData)
					: null;

				if (activesData && activesData._isTransitioning) {
					return;
				}
			}

			const startEvent = EventHandler.trigger(
				this._element,
				EVENT_SHOW$5
			);

			if (startEvent.defaultPrevented) {
				return;
			}

			actives.forEach((elemActive) => {
				if (container !== elemActive) {
					Collapse.getOrCreateInstance(elemActive, {
						toggle: false,
					}).hide();
				}

				if (!activesData) {
					Data.set(elemActive, DATA_KEY$9, null);
				}
			});

			const dimension = this._getDimension();

			this._element.classList.remove(CLASS_NAME_COLLAPSE);

			this._element.classList.add(CLASS_NAME_COLLAPSING);

			this._element.style[dimension] = 0;

			this._addAriaAndCollapsedClass(this._triggerArray, true);

			this._isTransitioning = true;

			const complete = () => {
				this._isTransitioning = false;

				this._element.classList.remove(CLASS_NAME_COLLAPSING);

				this._element.classList.add(
					CLASS_NAME_COLLAPSE,
					CLASS_NAME_SHOW$7
				);

				if (
					this._element.dataset.exoForcedDimension !== null &&
					this._element.dataset.exoForcedDimension !== undefined &&
					this._element.dataset.exoForcedDimension !== ""
				) {
					this._element.style[dimension] =
						this._element.dataset.exoForcedDimension;
				} else {
					this._element.style[dimension] = "";
				}

				EventHandler.trigger(this._element, EVENT_SHOWN$5);
			};

			if (
				this._element.dataset.exoForcedDimension !== null &&
				this._element.dataset.exoForcedDimension !== undefined &&
				this._element.dataset.exoForcedDimension !== ""
			) {
				this._queueCallback(complete, this._element, true);

				this._element.style[dimension] =
					this._element.dataset.exoForcedDimension;
			} else {
				const capitalizedDimension =
					dimension[0].toUpperCase() + dimension.slice(1);
				const scrollSize = `scroll${capitalizedDimension}`;

				this._queueCallback(complete, this._element, true);

				this._element.style[
					dimension
				] = `${this._element[scrollSize]}px`;
			}
		}

		hide() {
			if (this._isTransitioning || !this._isShown()) {
				return;
			}

			const startEvent = EventHandler.trigger(
				this._element,
				EVENT_HIDE$5
			);

			if (startEvent.defaultPrevented) {
				return;
			}

			const dimension = this._getDimension();

			if (
				this._element.dataset.exoForcedDimension !== null &&
				this._element.dataset.exoForcedDimension !== undefined &&
				this._element.dataset.exoForcedDimension !== ""
			) {
				console.log(this._element.dataset.exoForcedDimension);

				this._element.style[dimension] =
					this._element.dataset.exoForcedDimension;
			} else {
				this._element.style[dimension] = `${
					this._element.getBoundingClientRect()[dimension]
				}px`;
			}

			reflow(this._element);

			this._element.classList.add(CLASS_NAME_COLLAPSING);

			this._element.classList.remove(
				CLASS_NAME_COLLAPSE,
				CLASS_NAME_SHOW$7
			);

			const triggerArrayLength = this._triggerArray.length;

			for (let i = 0; i < triggerArrayLength; i++) {
				const trigger = this._triggerArray[i];
				const elem = getElementFromSelector(trigger);

				if (elem && !this._isShown(elem)) {
					this._addAriaAndCollapsedClass([trigger], false);
				}
			}

			this._isTransitioning = true;

			const complete = () => {
				this._isTransitioning = false;

				this._element.classList.remove(CLASS_NAME_COLLAPSING);

				this._element.classList.add(CLASS_NAME_COLLAPSE);

				EventHandler.trigger(this._element, EVENT_HIDDEN$5);
			};

			this._element.style[dimension] = "";

			this._queueCallback(complete, this._element, true);
		}

		_isShown(element = this._element) {
			return element.classList.contains(CLASS_NAME_SHOW$7);
		} // Private

		_getConfig(config) {
			config = {
				...Default$9,
				...Manipulator.getDataAttributes(this._element),
				...config,
			};
			config.toggle = Boolean(config.toggle); // Coerce string values

			config.parent = getElement(config.parent);
			typeCheckConfig(NAME$a, config, DefaultType$9);
			return config;
		}

		_getDimension() {
			return this._element.classList.contains(CLASS_NAME_HORIZONTAL)
				? WIDTH
				: HEIGHT;
		}

		_initializeChildren() {
			if (!this._config.parent) {
				return;
			}

			const children = SelectorEngine.find(
				`.${CLASS_NAME_COLLAPSE} .${CLASS_NAME_COLLAPSE}`,
				this._config.parent
			);
			SelectorEngine.find(SELECTOR_DATA_TOGGLE$4, this._config.parent)
				.filter((elem) => !children.includes(elem))
				.forEach((element) => {
					const selected = getElementFromSelector(element);

					if (selected) {
						this._addAriaAndCollapsedClass(
							[element],
							this._isShown(selected)
						);
					}
				});
		}

		_addAriaAndCollapsedClass(triggerArray, isOpen) {
			if (!triggerArray.length) {
				return;
			}

			triggerArray.forEach((elem) => {
				if (isOpen) {
					elem.classList.remove(CLASS_NAME_COLLAPSED);
				} else {
					elem.classList.add(CLASS_NAME_COLLAPSED);
				}

				elem.setAttribute("aria-expanded", isOpen);
			});
		} // Static

		static jQueryInterface(config) {
			return this.each(function () {
				const _config = {};

				if (typeof config === "string" && /show|hide/.test(config)) {
					_config.toggle = false;
				}

				const data = Collapse.getOrCreateInstance(this, _config);

				if (typeof config === "string") {
					if (typeof data[config] === "undefined") {
						throw new TypeError(`No method named "${config}"`);
					}

					data[config]();
				}
			});
		}
	}
	/**
	 * ------------------------------------------------------------------------
	 * Data Api implementation
	 * ------------------------------------------------------------------------
	 */

	EventHandler.on(
		document,
		EVENT_CLICK_DATA_API$4,
		SELECTOR_DATA_TOGGLE$4,
		function (event) {
			// preventDefault only for <a> elements (which change the URL) not inside the collapsible element
			if (
				event.target.tagName === "A" ||
				(event.delegateTarget && event.delegateTarget.tagName === "A")
			) {
				event.preventDefault();
			}

			const selector = getSelectorFromElement(this);
			const selectorElements = SelectorEngine.find(selector);
			selectorElements.forEach((element) => {
				Collapse.getOrCreateInstance(element, {
					toggle: false,
				}).toggle();
			});
		}
	);
	/**
	 * ------------------------------------------------------------------------
	 * jQuery
	 * ------------------------------------------------------------------------
	 * add .Collapse to jQuery only if jQuery is present
	 */

	defineJQueryPlugin(Collapse);

	/**
	 * --------------------------------------------------------------------------
	 * Exo (v0.0.1): util/scrollBar.js
	 * Licensed under MIT
	 * --------------------------------------------------------------------------
	 */
	const SELECTOR_FIXED_CONTENT =
		".fixed-top, .fixed-bottom, .is-fixed, .sticky-top";
	const SELECTOR_STICKY_CONTENT = ".sticky-top";

	class ScrollBarHelper {
		constructor() {
			this._element = document.body;
		}

		getWidth() {
			// https://developer.mozilla.org/en-US/docs/Web/API/Window/innerWidth#usage_notes
			const documentWidth = document.documentElement.clientWidth;
			return Math.abs(window.innerWidth - documentWidth);
		}

		hide() {
			const width = this.getWidth();

			this._disableOverFlow(); // give padding to element to balance the hidden scrollbar width

			this._setElementAttributes(
				this._element,
				"paddingRight",
				(calculatedValue) => calculatedValue + width
			); // trick: We adjust positive paddingRight and negative marginRight to sticky-top elements to keep showing fullwidth

			this._setElementAttributes(
				SELECTOR_FIXED_CONTENT,
				"paddingRight",
				(calculatedValue) => calculatedValue + width
			);

			this._setElementAttributes(
				SELECTOR_STICKY_CONTENT,
				"marginRight",
				(calculatedValue) => calculatedValue - width
			);
		}

		_disableOverFlow() {
			this._saveInitialAttribute(this._element, "overflow");

			this._element.style.overflow = "hidden";
		}

		_setElementAttributes(selector, styleProp, callback) {
			const scrollbarWidth = this.getWidth();

			const manipulationCallBack = (element) => {
				if (
					element !== this._element &&
					window.innerWidth > element.clientWidth + scrollbarWidth
				) {
					return;
				}

				this._saveInitialAttribute(element, styleProp);

				const calculatedValue =
					window.getComputedStyle(element)[styleProp];
				element.style[styleProp] = `${callback(
					Number.parseFloat(calculatedValue)
				)}px`;
			};

			this._applyManipulationCallback(selector, manipulationCallBack);
		}

		reset() {
			this._resetElementAttributes(this._element, "overflow");

			this._resetElementAttributes(this._element, "paddingRight");

			this._resetElementAttributes(
				SELECTOR_FIXED_CONTENT,
				"paddingRight"
			);

			this._resetElementAttributes(
				SELECTOR_STICKY_CONTENT,
				"marginRight"
			);
		}

		_saveInitialAttribute(element, styleProp) {
			const actualValue = element.style[styleProp];

			if (actualValue) {
				Manipulator.setDataAttribute(element, styleProp, actualValue);
			}
		}

		_resetElementAttributes(selector, styleProp) {
			const manipulationCallBack = (element) => {
				const value = Manipulator.getDataAttribute(element, styleProp);

				if (typeof value === "undefined") {
					element.style.removeProperty(styleProp);
				} else {
					Manipulator.removeDataAttribute(element, styleProp);
					element.style[styleProp] = value;
				}
			};

			this._applyManipulationCallback(selector, manipulationCallBack);
		}

		_applyManipulationCallback(selector, callBack) {
			if (isElement$1(selector)) {
				callBack(selector);
			} else {
				SelectorEngine.find(selector, this._element).forEach(callBack);
			}
		}

		isOverflowing() {
			return this.getWidth() > 0;
		}
	}

	/**
	 * --------------------------------------------------------------------------
	 * Exo (v0.0.1): util/sanitizer.js
	 * Licensed under MIT
	 * --------------------------------------------------------------------------
	 */
	const uriAttrs = new Set([
		"background",
		"cite",
		"href",
		"itemtype",
		"longdesc",
		"poster",
		"src",
		"xlink:href",
	]);
	const ARIA_ATTRIBUTE_PATTERN = /^aria-[\w-]*$/i;
	/**
	 * A pattern that recognizes a commonly useful subset of URLs that are safe.
	 *
	 * Shoutout to Angular 7 https://github.com/angular/angular/blob/7.2.4/packages/core/src/sanitization/url_sanitizer.ts
	 */

	const SAFE_URL_PATTERN =
		/^(?:(?:https?|mailto|ftp|tel|file):|[^#&/:?]*(?:[#/?]|$))/i;
	/**
	 * A pattern that matches safe data URLs. Only matches image, video and audio types.
	 *
	 * Shoutout to Angular 7 https://github.com/angular/angular/blob/7.2.4/packages/core/src/sanitization/url_sanitizer.ts
	 */

	const DATA_URL_PATTERN =
		/^data:(?:image\/(?:bmp|gif|jpeg|jpg|png|tiff|webp)|video\/(?:mpeg|mp4|ogg|webm)|audio\/(?:mp3|oga|ogg|opus));base64,[\d+/a-z]+=*$/i;

	const allowedAttribute = (attr, allowedAttributeList) => {
		const attrName = attr.nodeName.toLowerCase();

		if (allowedAttributeList.includes(attrName)) {
			if (uriAttrs.has(attrName)) {
				return Boolean(
					SAFE_URL_PATTERN.test(attr.nodeValue) ||
						DATA_URL_PATTERN.test(attr.nodeValue)
				);
			}

			return true;
		}

		const regExp = allowedAttributeList.filter(
			(attrRegex) => attrRegex instanceof RegExp
		); // Check if a regular expression validates the attribute.

		for (let i = 0, len = regExp.length; i < len; i++) {
			if (regExp[i].test(attrName)) {
				return true;
			}
		}

		return false;
	};

	const DefaultAllowlist = {
		// Global attributes allowed on any supplied element below.
		"*": ["class", "dir", "id", "lang", "role", ARIA_ATTRIBUTE_PATTERN],
		a: ["target", "href", "title", "rel"],
		area: [],
		b: [],
		br: [],
		col: [],
		code: [],
		div: [],
		em: [],
		hr: [],
		h1: [],
		h2: [],
		h3: [],
		h4: [],
		h5: [],
		h6: [],
		i: [],
		img: ["src", "srcset", "alt", "title", "width", "height"],
		li: [],
		ol: [],
		p: [],
		pre: [],
		s: [],
		small: [],
		span: [],
		sub: [],
		sup: [],
		strong: [],
		u: [],
		ul: [],
	};
	function sanitizeHtml(unsafeHtml, allowList, sanitizeFn) {
		if (!unsafeHtml.length) {
			return unsafeHtml;
		}

		if (sanitizeFn && typeof sanitizeFn === "function") {
			return sanitizeFn(unsafeHtml);
		}

		const domParser = new window.DOMParser();
		const createdDocument = domParser.parseFromString(
			unsafeHtml,
			"text/html"
		);
		const allowlistKeys = Object.keys(allowList);
		const elements = [].concat(
			...createdDocument.body.querySelectorAll("*")
		);

		for (let i = 0, len = elements.length; i < len; i++) {
			const el = elements[i];
			const elName = el.nodeName.toLowerCase();

			if (!allowlistKeys.includes(elName)) {
				el.remove();
				continue;
			}

			const attributeList = [].concat(...el.attributes);
			const allowedAttributes = [].concat(
				allowList["*"] || [],
				allowList[elName] || []
			);
			attributeList.forEach((attr) => {
				if (!allowedAttribute(attr, allowedAttributes)) {
					el.removeAttribute(attr.nodeName);
				}
			});
		}

		return createdDocument.body.innerHTML;
	}

	/**
	 * --------------------------------------------------------------------------
	 * Exo (v0.0.1): tab.js
	 * Licensed under MIT
	 * --------------------------------------------------------------------------
	 */
	/**
	 * ------------------------------------------------------------------------
	 * Constants
	 * ------------------------------------------------------------------------
	 */

	const NAME$1 = "tab";
	const DATA_KEY$1 = "exo.tab";
	const EVENT_KEY$1 = `.${DATA_KEY$1}`;
	const DATA_API_KEY = ".data-api";
	const EVENT_HIDE$1 = `hide${EVENT_KEY$1}`;
	const EVENT_HIDDEN$1 = `hidden${EVENT_KEY$1}`;
	const EVENT_SHOW$1 = `show${EVENT_KEY$1}`;
	const EVENT_SHOWN$1 = `shown${EVENT_KEY$1}`;
	const EVENT_CLICK_DATA_API = `click${EVENT_KEY$1}${DATA_API_KEY}`;
	const CLASS_NAME_DROPDOWN_MENU = "dropdown-menu";
	const CLASS_NAME_ACTIVE = "is-active";
	const CLASS_NAME_FADE$1 = "c-tab-pane--transition";
	const CLASS_NAME_SHOW$1 = "is-shown";
	const SELECTOR_DROPDOWN = ".c-dropdown";
	const SELECTOR_NAV_LIST_GROUP = "[data-exo-tab-list]";
	const SELECTOR_ACTIVE = ".is-active";
	const SELECTOR_ACTIVE_UL = ":scope > li > .is-active";
	const SELECTOR_DATA_TOGGLE =
		'[data-exo-toggle="tab"], [data-exo-toggle="pill"], [data-exo-toggle="list"]';
	const SELECTOR_DROPDOWN_TOGGLE = ".c-dropdown__toggle";
	const SELECTOR_DROPDOWN_ACTIVE_CHILD =
		":scope > .c-dropdown__menu .is-active";
	/**
	 * ------------------------------------------------------------------------
	 * Class Definition
	 * ------------------------------------------------------------------------
	 */

	class Tab extends BaseComponent {
		// Getters
		static get NAME() {
			return NAME$1;
		} // Public

		show() {
			if (
				this._element.parentNode &&
				this._element.parentNode.nodeType === Node.ELEMENT_NODE &&
				this._element.classList.contains(CLASS_NAME_ACTIVE)
			) {
				return;
			}

			let previous;
			const target = getElementFromSelector(this._element);

			const listElement = this._element.closest(SELECTOR_NAV_LIST_GROUP);

			if (listElement) {
				const itemSelector =
					listElement.nodeName === "UL" ||
					listElement.nodeName === "OL"
						? SELECTOR_ACTIVE_UL
						: SELECTOR_ACTIVE;
				previous = SelectorEngine.find(itemSelector, listElement);
				previous = previous[previous.length - 1];
			}

			const hideEvent = previous
				? EventHandler.trigger(previous, EVENT_HIDE$1, {
						relatedTarget: this._element,
				  })
				: null;
			const showEvent = EventHandler.trigger(
				this._element,
				EVENT_SHOW$1,
				{
					relatedTarget: previous,
				}
			);

			if (
				showEvent.defaultPrevented ||
				(hideEvent !== null && hideEvent.defaultPrevented)
			) {
				return;
			}

			this._activate(this._element, listElement);

			const complete = () => {
				EventHandler.trigger(previous, EVENT_HIDDEN$1, {
					relatedTarget: this._element,
				});
				EventHandler.trigger(this._element, EVENT_SHOWN$1, {
					relatedTarget: previous,
				});
			};

			if (target) {
				this._activate(target, target.parentNode, complete);
			} else {
				complete();
			}
		} // Private

		_activate(element, container, callback) {
			const activeElements =
				container &&
				(container.nodeName === "UL" || container.nodeName === "OL")
					? SelectorEngine.find(SELECTOR_ACTIVE_UL, container)
					: SelectorEngine.children(container, SELECTOR_ACTIVE);
			const active = activeElements[0];
			const isTransitioning =
				callback &&
				active &&
				active.classList.contains(CLASS_NAME_FADE$1);

			const complete = () =>
				this._transitionComplete(element, active, callback);

			if (active && isTransitioning) {
				active.classList.remove(CLASS_NAME_SHOW$1);

				this._queueCallback(complete, element, true);
			} else {
				complete();
			}
		}

		_transitionComplete(element, active, callback) {
			if (active) {
				active.classList.remove(CLASS_NAME_ACTIVE);
				const dropdownChild = SelectorEngine.findOne(
					SELECTOR_DROPDOWN_ACTIVE_CHILD,
					active.parentNode
				);

				if (dropdownChild) {
					dropdownChild.classList.remove(CLASS_NAME_ACTIVE);
				}

				if (active.getAttribute("role") === "tab") {
					active.setAttribute("aria-selected", false);
				}
			}

			element.classList.add(CLASS_NAME_ACTIVE);

			if (element.getAttribute("role") === "tab") {
				element.setAttribute("aria-selected", true);
			}

			reflow(element);

			if (element.classList.contains(CLASS_NAME_FADE$1)) {
				element.classList.add(CLASS_NAME_SHOW$1);
			}

			let parent = element.parentNode;

			if (parent && parent.nodeName === "LI") {
				parent = parent.parentNode;
			}

			if (parent && parent.classList.contains(CLASS_NAME_DROPDOWN_MENU)) {
				const dropdownElement = element.closest(SELECTOR_DROPDOWN);

				if (dropdownElement) {
					SelectorEngine.find(
						SELECTOR_DROPDOWN_TOGGLE,
						dropdownElement
					).forEach((dropdown) =>
						dropdown.classList.add(CLASS_NAME_ACTIVE)
					);
				}

				element.setAttribute("aria-expanded", true);
			}

			if (callback) {
				callback();
			}
		} // Static

		static jQueryInterface(config) {
			return this.each(function () {
				const data = Tab.getOrCreateInstance(this);

				if (typeof config === "string") {
					if (typeof data[config] === "undefined") {
						throw new TypeError(`No method named "${config}"`);
					}

					data[config]();
				}
			});
		}
	}
	/**
	 * ------------------------------------------------------------------------
	 * Data Api implementation
	 * ------------------------------------------------------------------------
	 */

	EventHandler.on(
		document,
		EVENT_CLICK_DATA_API,
		SELECTOR_DATA_TOGGLE,
		function (event) {
			if (["A", "AREA"].includes(this.tagName)) {
				event.preventDefault();
			}

			if (isDisabled(this)) {
				return;
			}

			const data = Tab.getOrCreateInstance(this);
			data.show();
		}
	);
	/**
	 * ------------------------------------------------------------------------
	 * jQuery
	 * ------------------------------------------------------------------------
	 * add .Tab to jQuery only if jQuery is present
	 */

	defineJQueryPlugin(Tab);

	/**
	 * --------------------------------------------------------------------------
	 * Exo (v0.0.1): index.umd.js
	 * Licensed under MIT
	 * --------------------------------------------------------------------------
	 */
	var index_umd = {
		// Collapse,
		Tab,
	};

	return index_umd;
});
