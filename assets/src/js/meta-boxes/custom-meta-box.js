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

