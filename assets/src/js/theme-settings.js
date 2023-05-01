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
