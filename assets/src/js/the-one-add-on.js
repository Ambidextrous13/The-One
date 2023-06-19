import painter from './meta-boxes/the-one-bordered-post-posts';
(
	function() {
		/**
		 * Set text into the clipboard.
		 *
		 * @param {String}      text    Text to be copied.
		 * @param {HTMLElement} element element which is used for representation at front end as a copy button.
		 */
		function setClipboard ( text, element ) {
			const type = 'text/plain';
			const blob = new Blob( [ text ], { type } );
			const data = [ new ClipboardItem( { [ type ]: blob } ) ];
			const originalBg = element.style.backgroundColor;

			navigator.clipboard.write( data ).then(
				() => {
					if ( null !== originalBg || '' !== originalBg ) {
						element.style.backgroundColor = '#82AF53';
						setTimeout( () => {
							element.style.backgroundColor = originalBg;
						}, 2500 );
					}
					return 'Copied';
				},
				() => {

					if ( null !== originalBg || '' !== originalBg ) {
						element.style.backgroundColor = '#fc1e1e';
						setTimeout( () => {
							element.style.backgroundColor = originalBg;
						}, 2500 );
					}
					return 'Unable to copy';
				}
			);
		}
		painter();
		const copyElement = document.getElementById( 'copy-it' );
		if ( copyElement ) {
			copyElement.addEventListener( 'click', ( event ) => {
				event.preventDefault();
				const copyString = copyElement.getAttribute( 'copy' );
				setClipboard( copyString, event.target );
			} );
		}
	}()
);
