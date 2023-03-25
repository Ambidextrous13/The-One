(function () {
    const control_checkboxes = document.querySelectorAll( '[controls]' );

    const care_taker = checkbox => {
        const controlled_div = document.getElementById( checkbox.getAttribute( 'controls' ) );
        if ( ! checkbox.checked ) {
            controlled_div.style.display = 'none';
        }else{
            controlled_div.style.display = 'flex';
        }
    }

    control_checkboxes.forEach( checkbox => {
        if( checkbox.tagName === 'INPUT' && checkbox.getAttribute( 'type' ) === 'checkbox' ){
            care_taker( checkbox );
            checkbox.addEventListener( 'click', event => {
                const checkbox = event.target; 
                care_taker( checkbox );
            } )
        }
    });

    console.log( null? 'true' : 'false' )


})()