/******/ (function() { // webpackBootstrap
/******/ 	var __webpack_modules__ = ({

/***/ 198:
/***/ (function() {

(function(){
    function get_query_vars( q_param ) {
        const url__ = window.location.href;
        const query  = url__.substring( url__.lastIndexOf( '?' )+1 );
        let params = [ query ];
        if( query.indexOf( '&' ) ){
            params = query.split( '&' );
        }
        for( let i = 0; i < params.length; i++ ){
            let param = params[i];
            let local_split = param.split( '=' );
            if( q_param == local_split[ 0 ] ){

                return local_split[ 1 ];
            }
        };
        return false;
    }

    function highlighter( target_query ){
        if( target_query && '' !== target_query ){
            let target_element = document.querySelector( target_query );
            if ( target_element ) {
                set_visibility( target_element );
                setup_overlay ( target_element );
            }
            else{
               const watcher = setInterval(() => {
                target_element = document.querySelector( target_query );
                if( target_element ){
                    set_visibility( target_element );
                    setup_overlay ( target_element );
                    clearInterval( watcher );
                }
               }, 1000);
            }
        }
    }
    
    setTimeout(() => {
        const target_query = get_query_vars( 'highlight' );
        target_query ? highlighter( target_query ) : null;
        
    }, 200);






    function set_visibility( target_element ){
        target_element.scrollIntoView({
            'behavior' : 'smooth',
            'block'    : 'center',

        });
    }
    function setup_overlay( target_element ) {
        const body      = document.getElementsByTagName( 'body' )[0];
        const overlay   = document.createElement ( 'div'        );
        const geography = target_element.getBoundingClientRect(        );
        let   posses    = [ 
            window.scrollX + geography.left - 10, 
            window.scrollY + geography.top  - 10, 
        ];         

        overlay.style.position = 'absolute';
        overlay.style.left     = posses[0] + 'px';
        overlay.style.top      = posses[1] + 'px';
        overlay.style.width    = geography.width  + 20 + 'px';
        overlay.style.height   = geography.height + 20 + 'px';
        overlay.style.zIndex   = '2147483647';
        
        overlay.classList.add( 'highlighter' );
        body.append( overlay );
        
        setTimeout(() => {
            overlay.remove();
        }, 5500);
    }
})()

/***/ }),

/***/ 961:
/***/ (function() {

const toggle = document.getElementById( 'cmb-toggle' );
const runner = document.getElementById( 'cmb-i-r' );
const hidable = document.getElementById( 'cmb-hidable' )
const thickness = document.getElementById( 'cmb-thickness' );
const color = document.getElementById( 'cmb-color' );
const padding = document.getElementById( 'cmb-padding' );
const border_pattern = document.getElementById( 'cmb-pattern' );

let infos = {
    'bordered?' : false,
    'thickness' : 5,
    'color' : '#7a7a7a',
    'padding' : 10,
    'border_pattern' : 'none'
}
const set_thickness = () => infos[ 'thickness' ] = thickness?.value ?? '' ;
const set_color = () => infos[ 'color' ] = color?.value ?? '' ;
const set_padding = () => infos[ 'padding' ] = padding?.value ?? '' ;
const set_pattern = () => infos[ 'border_pattern' ] = border_pattern?.value ?? '' ;

const apply_toggle = () => {
    if( toggle && runner && hidable ){
        if( toggle.checked ){
            hidable.classList.remove( 'cmb-hidable' );
            runner.classList.remove( 'cmb-temp-off' );
            runner.classList.add( 'cmb-temp-on' );
            runner.style.animationName = 'cmb-slider-on';
            infos[ 'bordered?' ] = true;
        }
        else{
            toggle.removeAttribute( 'checked','' )
            hidable.classList.add( 'cmb-hidable' );      
            runner.classList.remove( 'cmb-temp-on' );
            runner.classList.add( 'cmb-temp-off' );
            runner.style.animationName = 'cmb-slider-off';
            infos[ 'bordered?' ] = false;  
        }
    }
}
const apply_border = () => border_pattern ? border_pattern.style.border = '4px ' + infos['border_pattern'] + ' ' + infos['color'] : null;

set_thickness();
set_color();
set_padding();
set_pattern();
apply_toggle();
apply_border();


toggle?.addEventListener( 'click', event => {
    event.stopPropagation();
    apply_toggle();
} )

thickness?.addEventListener( 'keyup', event => {
    event.stopPropagation();
    set_thickness();
} )

color?.addEventListener( 'change', event => {
    event.stopPropagation();
    set_color();
    apply_border();
} )

padding?.addEventListener( 'keyup', event => {
    event.stopPropagation();
    set_padding();
} )

border_pattern?.addEventListener( 'change', event => {
    event.stopPropagation();
    set_pattern();
    apply_border();
} )



/***/ }),

/***/ 365:
/***/ (function() {

(function () {
    const control_checkboxes = document.querySelectorAll( '[controls]' );

    const care_taker = ( checkbox, is_clicked = false ) => {
        const controlled_div = document.getElementById( checkbox.getAttribute( 'controls' ) );
        const input_div = controlled_div.getElementsByTagName( 'INPUT' );
        if (  checkbox.checked ) {
            controlled_div.style.display = 'flex';
            if( input_div.length > 0 && is_clicked ){
                input_div[0].focus();
            }
        }else{
            controlled_div.style.display = 'none';
            input_div[0].value = null;
        }
    }

    control_checkboxes.forEach( checkbox => {
        if( checkbox.tagName === 'INPUT' && checkbox.getAttribute( 'type' ) === 'checkbox' ){
            care_taker( checkbox );
            checkbox.addEventListener( 'click', event => {
                const checkbox = event.target; 
                care_taker( checkbox, true );
            } )
        }
    });

    const copyright_text = document.getElementById( 'the_one_copyright_text' );
    if( copyright_text ){
        copyright_text.value = copyright_text.value === '' ? '\u00A9 ' : copyright_text.value;
    }

})()

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