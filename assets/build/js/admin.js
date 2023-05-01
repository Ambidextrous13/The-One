/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ 198:
/***/ (function() {

( function() {
	/**
	 * Extracts the given parameter from the current URL. returns false if not found.
	 *
	 * @param {string} qParam query parameter or query which you are looking for.
	 * @return {string|boolean} either extracted value or false if not found.
	 */
	function getQueryVars( qParam ) {
		const url__ = window.location.href;
		const query = url__.substring( url__.lastIndexOf( '?' ) + 1 );
		let params = [ query ];
		if ( query.indexOf( '&' ) ) {
			params = query.split( '&' );
		}
		for ( let i = 0; i < params.length; i++ ) {
			const param = params[ i ];
			const localSplit = param.split( '=' );
			if ( qParam === localSplit[ 0 ] ) {

				return localSplit[ 1 ];
			}
		}
		return false;
	}

	/**
	 * Selects the element based on passed 'query selector' and give it a blinking border.
	 *
	 * @param {string} targetQuery Query Selector that will be highlighted.
	 */
	function highlighter( targetQuery ) {
		if ( targetQuery && '' !== targetQuery ) {
			let targetElement = document.querySelector( targetQuery );
			if ( targetElement ) {
				setVisibility( targetElement );
				setupOverlay( targetElement );
			} else {
				const watcher = setInterval( () => {
					targetElement = document.querySelector( targetQuery );
					if ( targetElement ) {
						setVisibility( targetElement );
						setupOverlay( targetElement );
						clearInterval( watcher );
					}
				}, 1000 );
			}
		}
	}

	setTimeout( () => {
		const targetQuery = getQueryVars( 'highlight' );
		const targetType = getQueryVars( 'type' );
		let type = '';
		if ( 'class' === targetType ) {
			type = '.';
		} else if ( 'id' === targetType ) {
			type = '#';
		}
		const query = type + targetQuery;
		// eslint-disable-next-line no-unused-expressions
		targetQuery ? highlighter( query ) : null;

	}, 200 );

	/**
	 * Make sure given HTML Element is within the viewport.
	 *
	 * @param {HTMLElement} targetElement HTML Element which get scrolled to the viewport.
	 */
	function setVisibility( targetElement ) {
		targetElement.scrollIntoView( {
			behavior: 'smooth',
			block: 'center',

		} );
	}
	/**
	 * Creates an overlay around the given HTML Element.
	 *
	 * @param {HTMLElement} targetElement HTML Element around which overlay ges created.
	 */
	function setupOverlay( targetElement ) {
		const body = document.getElementsByTagName( 'body' )[ 0 ];
		const overlay = document.createElement( 'div' );
		const geography = targetElement.getBoundingClientRect( );
		const posses = [
			window.scrollX + geography.left - 10,
			window.scrollY + geography.top - 10,
		];

		overlay.style.position = 'absolute';
		overlay.style.left = posses[ 0 ] + 'px';
		overlay.style.top = posses[ 1 ] + 'px';
		overlay.style.width = geography.width + 20 + 'px';
		overlay.style.height = geography.height + 20 + 'px';
		overlay.style.zIndex = '2147483647';

		overlay.classList.add( 'highlighter' );
		body.append( overlay );

		setTimeout( () => {
			overlay.remove();
		}, 5500 );
	}
}() );


/***/ }),

/***/ 961:
/***/ (function() {

const toggle = document.getElementById( 'cmb-toggle' );
const runner = document.getElementById( 'cmb-i-r' );
const hidable = document.getElementById( 'cmb-hidable' );
const thickness = document.getElementById( 'cmb-thickness' );
const color = document.getElementById( 'cmb-color' );
const padding = document.getElementById( 'cmb-padding' );
const borderPattern = document.getElementById( 'cmb-pattern' );

const infos = {
	'bordered?': false,
	thickness: 5,
	color: '#7a7a7a',
	padding: 10,
	borderPattern: 'none',
};

/* eslint-disable require-jsdoc */
const setThickness = () => infos.thickness = thickness?.value ?? '';
const setColor = () => infos.color = color?.value ?? '';
const setPadding = () => infos.padding = padding?.value ?? '';
const setPattern = () => infos.borderPattern = borderPattern?.value ?? '';
/* eslint-enable */

/**
 * Custom Meta Box: Border maker.
 */
const applyToggle = () => {
	if ( toggle && runner && hidable ) {
		if ( toggle.checked ) {
			hidable.classList.remove( 'cmb-hidable' );
			runner.classList.remove( 'cmb-temp-off' );
			runner.classList.add( 'cmb-temp-on' );
			runner.style.animationName = 'cmb-slider-on';
			infos[ 'bordered?' ] = true;
		} else {
			toggle.removeAttribute( 'checked', '' );
			hidable.classList.add( 'cmb-hidable' );
			runner.classList.remove( 'cmb-temp-on' );
			runner.classList.add( 'cmb-temp-off' );
			runner.style.animationName = 'cmb-slider-off';
			infos[ 'bordered?' ] = false;
		}
	}
};
// eslint-disable-next-line require-jsdoc
const applyBorder = () => borderPattern ? borderPattern.style.border = '4px ' + infos.borderPattern + ' ' + infos.color : null;

setThickness();
setColor();
setPadding();
setPattern();
applyToggle();
applyBorder();

toggle?.addEventListener( 'click', ( event ) => {
	event.stopPropagation();
	applyToggle();
} );

thickness?.addEventListener( 'keyup', ( event ) => {
	event.stopPropagation();
	setThickness();
} );

color?.addEventListener( 'change', ( event ) => {
	event.stopPropagation();
	setColor();
	applyBorder();
} );

padding?.addEventListener( 'keyup', ( event ) => {
	event.stopPropagation();
	setPadding();
} );

borderPattern?.addEventListener( 'change', ( event ) => {
	event.stopPropagation();
	setPattern();
	applyBorder();
} );



/***/ }),

/***/ 365:
/***/ (function() {

(
	function () {
		const controlCheckboxes = document.querySelectorAll( '[controls]' );

		/**
		 * Controls the visibility of input field base on checkbox's tick.
		 *
		 * @param {HTMLElement} checkbox  checkbox which controls the visibility i input fields.
		 * @param {Boolean}     isClicked is true, input fields appears else fields remain hidden.
		 */
		const careTaker = ( checkbox, isClicked = false ) => {
			const controlledDiv = document.getElementById( checkbox.getAttribute( 'controls' ) );
			const inputDiv = controlledDiv.getElementsByTagName( 'INPUT' );
			if ( checkbox.checked ) {
				controlledDiv.style.display = 'flex';
				if ( 0 < inputDiv.length && isClicked ) {
					inputDiv[ 0 ].focus();
				}
			} else {
				controlledDiv.style.display = 'none';
				inputDiv[ 0 ].value = null;
			}
		};

		controlCheckboxes.forEach( ( checkbox ) => {
			if ( 'INPUT' === checkbox.tagName && 'checkbox' === checkbox.getAttribute( 'type' ) ) {
				careTaker( checkbox );
				checkbox.addEventListener( 'click', ( event ) => {
					const checkbox_ = event.target;
					careTaker( checkbox_, true );
				} );
			}
		} );

		const copyrightText = document.getElementById( 'the_one_copyright_text' );
		if ( copyrightText ) {
			copyrightText.value = '' === copyrightText.value ? '\u00A9 ' : copyrightText.value;
		}

	}()
);


/***/ })

/******/ 	});
/************************************************************************/
/******/ 	// The module cache
/******/ 	var __webpack_module_cache__ = {};
/******/ 	
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/ 		// Check if module is in cache
/******/ 		var cachedModule = __webpack_module_cache__[moduleId];
/******/ 		if (cachedModule !== undefined) {
/******/ 			return cachedModule.exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = __webpack_module_cache__[moduleId] = {
/******/ 			// no module.id needed
/******/ 			// no module.loaded needed
/******/ 			exports: {}
/******/ 		};
/******/ 	
/******/ 		// Execute the module function
/******/ 		__webpack_modules__[moduleId](module, module.exports, __webpack_require__);
/******/ 	
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/ 	
/************************************************************************/
/******/ 	/* webpack/runtime/compat get default export */
/******/ 	!function() {
/******/ 		// getDefaultExport function for compatibility with non-harmony modules
/******/ 		__webpack_require__.n = function(module) {
/******/ 			var getter = module && module.__esModule ?
/******/ 				function() { return module['default']; } :
/******/ 				function() { return module; };
/******/ 			__webpack_require__.d(getter, { a: getter });
/******/ 			return getter;
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/define property getters */
/******/ 	!function() {
/******/ 		// define getter functions for harmony exports
/******/ 		__webpack_require__.d = function(exports, definition) {
/******/ 			for(var key in definition) {
/******/ 				if(__webpack_require__.o(definition, key) && !__webpack_require__.o(exports, key)) {
/******/ 					Object.defineProperty(exports, key, { enumerable: true, get: definition[key] });
/******/ 				}
/******/ 			}
/******/ 		};
/******/ 	}();
/******/ 	
/******/ 	/* webpack/runtime/hasOwnProperty shorthand */
/******/ 	!function() {
/******/ 		__webpack_require__.o = function(obj, prop) { return Object.prototype.hasOwnProperty.call(obj, prop); }
/******/ 	}();
/******/ 	
/************************************************************************/
var __webpack_exports__ = {};
// This entry need to be wrapped in an IIFE because it need to be in strict mode.
!function() {
"use strict";
/* harmony import */ var _admin_aid_js__WEBPACK_IMPORTED_MODULE_0__ = __webpack_require__(198);
/* harmony import */ var _admin_aid_js__WEBPACK_IMPORTED_MODULE_0___default = /*#__PURE__*/__webpack_require__.n(_admin_aid_js__WEBPACK_IMPORTED_MODULE_0__);
/* harmony import */ var _theme_settings_js__WEBPACK_IMPORTED_MODULE_1__ = __webpack_require__(365);
/* harmony import */ var _theme_settings_js__WEBPACK_IMPORTED_MODULE_1___default = /*#__PURE__*/__webpack_require__.n(_theme_settings_js__WEBPACK_IMPORTED_MODULE_1__);
/* harmony import */ var _meta_boxes_custom_meta_box_js__WEBPACK_IMPORTED_MODULE_2__ = __webpack_require__(961);
/* harmony import */ var _meta_boxes_custom_meta_box_js__WEBPACK_IMPORTED_MODULE_2___default = /*#__PURE__*/__webpack_require__.n(_meta_boxes_custom_meta_box_js__WEBPACK_IMPORTED_MODULE_2__);



}();
/******/ })()
;
//# sourceMappingURL=admin.js.map