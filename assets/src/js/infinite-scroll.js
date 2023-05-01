import painter from './meta-boxes/bordered-post-posts';
(
	function infiniteScroll() {
		let safetyLock = false;
		let currentReadingPage = 1;
		document.addEventListener( 'scroll', () => {
			const trigger = document.getElementById( 'load-trigger' );
			// eslint-disable-next-line no-unused-expressions
			checkForTriggerPush( trigger ) && ! safetyLock ? ajaxCaller( trigger ) : '';
			return '';
		} );

		/**
		 * check if user scroll reached to the point where next posts need to loaded or not.
		 *
		 * @param {HTMLElement} trigger is an HTML Element at which this function keeps eye on.
		 * @return {boolean} if given element has reached inside the viewport or not?
		 */
		function checkForTriggerPush( trigger ) {
			if ( trigger ) {
				const location = trigger.getBoundingClientRect();
				const clientHeight = window.innerHeight || document.documentElement.clientHeight;
				return (
					0 <= location.top &&
                    0 <= location.left &&
                    location.bottom <= 1.5 * parseInt( clientHeight ) &&
                    location.right <= ( window.innerWidth || document.documentElement.clientWidth )
				);
			}
			return false;
		}

		/**
		 * Make an AJAX request for next feed
		 *
		 * @param {HTMLElement} trigger is an element which need to be moved from the current end of page to new upcoming end of page.
		 */
		function ajaxCaller( trigger ) {
			safetyLock = true;
			// eslint-disable-next-line no-undef
			const url = siteConfig?.ajax_url ?? '';
			// eslint-disable-next-line no-undef
			const nonce = siteConfig?.ajax_nonce ?? '';

			if ( url && nonce ) {
				const ajax = new XMLHttpRequest();
				ajax.onreadystatechange = function () {
					if ( 4 === this.readyState && 200 === this.status ) {
						trigger.remove();
						safetyLock = false;
						let response = this.response;
						const suspect = JSON.parse( response );
						if ( ! suspect.success ) {
							location.reload();
						} else if ( suspect.hasOwnProperty( 'data' ) && suspect.hasOwnProperty( 'page' ) ) {
							response = suspect.data;
							currentReadingPage = suspect.page;
							const accessPoint = document.getElementById( 'append_here' );
							if ( accessPoint && response ) {
								response = response.split( '</article>' );
								response.forEach( ( article ) => {
									article = article.replace( '<article class="post">', '' );
									const articleDiv = document.createElement( 'article' );
									articleDiv.innerHTML = article;
									articleDiv.classList.add( 'post' );
									accessPoint.append( articleDiv );
								} );
								painter();
							}
							if ( suspect.hasOwnProperty( 'isEnd' ) ) {
								if ( suspect.isEnd ) {
									safetyLock = true;
								}
							}
						}
					}
				};
				ajax.open( 'POST', url, true );
				ajax.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded' );
				ajax.send( 'action=infiscroll&ajax_nonce=' + nonce + '&page=' + currentReadingPage );
			}
		}
	}() );
