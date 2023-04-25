import painter from  './meta-boxes/bordered-post-posts';
(   
    function infinite_scroll() {
		let safetyLock           = false;
        let current_reading_page = 1;
        document.addEventListener( 'scroll', event=>{
            const trigger = document.getElementById( 'load-trigger' );
            check_for_trigger_push( trigger ) && ! safetyLock ? ajax_caller( trigger ) : '';
            return '';
        } )
        
        function check_for_trigger_push( trigger ){
            if ( trigger ) {
                const location = trigger.getBoundingClientRect();
                const clientHeight = window.innerHeight || document.documentElement.clientHeight;
                return (
                    location.top >= 0 &&
                    location.left >= 0 &&
                    location.bottom <= 1.5 * parseInt( clientHeight )  &&
                    location.right <= ( window.innerWidth || document.documentElement.clientWidth )
                );
            }
            return false;
        }

        function ajax_caller( trigger ) {
            safetyLock = true;
            const url   = siteConfig?.ajax_url   ?? '';
            const nonce = siteConfig?.ajax_nonce ?? '';
    
            if( url && nonce ){
                let ajax = new XMLHttpRequest();
                ajax.onreadystatechange = function () {
                    if( this.readyState == 4 && this.status == 200 ) {
                        trigger.remove();
                        safetyLock = false;
                        let response = this.response;
						let suspect = JSON.parse(response);
						if ( ! suspect.success ) {
							location.reload()
						} else {
							if ( suspect.hasOwnProperty( 'data' ) && suspect.hasOwnProperty( 'page' ) ) {
								response = suspect.data;
								current_reading_page = suspect.page;
								let access_point = document.getElementById( 'append_here' );
								if( access_point && response ){
									response = response.replace( '<article class="post">', '' );
									response = response.replace( '</article>', '' );
									const article = document.createElement( 'article' );
									article.innerHTML = response;
									article.classList.add( 'post' )
									access_point.append( article );
									painter();
								}
								if ( suspect.hasOwnProperty( 'isEnd' ) ) {
									if ( suspect.isEnd ) {
										safetyLock = true;
									}
								}
							}
						}
                    } 
                }
                ajax.open( 'POST', url, true );
                ajax.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded' );
                ajax.send( 'action=infiscroll&ajax_nonce=' + nonce + '&page=' + current_reading_page );
			}
        }
    }
)();