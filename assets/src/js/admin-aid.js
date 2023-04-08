(function(){
    function get_query_vars( q_param ) {
        const url__ = window.location.href;
        const query  = url__.substring( url__.lastIndexOf( '?' )+1 );
        let params = [ query ];
        if( query.indexOf( '&' ) ){
            params = query.split( '&' );
        }
        console.log( params );
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
            console.log( target_element );
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