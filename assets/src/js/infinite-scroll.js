(   
    function infinite_scroll() {
        let safetyLock = false;
        
        document.addEventListener( 'scroll', event=>{
            const trigger = document.getElementById( 'load-trigger' );
            check_for_trigger_push( trigger ) && ! safetyLock ? ajax_caller( trigger ) : '';
            return '';
        } )
        
        function check_for_trigger_push( trigger ){
            if ( trigger ) {
                console.log( trigger );
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
            console.log( 'calling....' );
            safetyLock = true;
            const url   = siteConfig?.ajax_url   ?? '';
            const nonce = siteConfig?.ajax_nonce ?? '';
    
            if( url && nonce ){
                console.log( 'if passed' );
                console.log( url );
                console.log( nonce );

                let ajax = new XMLHttpRequest();
                ajax.onreadystatechange = function () {
                    if( this.readyState == 4 && this.status == 200 ) {
                        trigger.remove();
                        safetyLock = false;
                        let response = this.response;
                        if( 'END_OF_BOOK' === response.slice( -11, ) ){
                            safetyLock = true; 
                            response = response.slice( 0, -11 );
                        }
                        document.getElementById( 'append_here' ).innerHTML += response;
                    } 
                }
                ajax.open( 'POST', url, true );
                ajax.setRequestHeader( 'Content-type', 'application/x-www-form-urlencoded' );
                ajax.send( 'action=infiscroll&ajax_nonce='+nonce )
            }
        }
    }
)();