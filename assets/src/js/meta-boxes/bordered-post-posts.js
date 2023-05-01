/**
 * Pulls out the border data and apply it to the element.
 */
function painter () {
	const featureImgs = document.querySelectorAll( 'img.border-it' );
	featureImgs.forEach( ( img ) => {
		let data = img.getAttribute( 'data' );
		data = data.split( '?' );
		img.style.border = data[ 1 ];
		img.style.padding = data[ 2 ];
	} );
}

export default painter;
