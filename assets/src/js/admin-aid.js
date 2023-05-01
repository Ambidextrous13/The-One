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
