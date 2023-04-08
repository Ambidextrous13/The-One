(function () {
    const control_checkboxes = document.querySelectorAll( '[controls]' );

    const care_taker = ( checkbox, is_clicked = false ) => {
        const controlled_div = document.getElementById( checkbox.getAttribute( 'controls' ) );
        const input_div = controlled_div.getElementsByTagName( 'INPUT' );
        if (  checkbox.checked ) {
            controlled_div.style.display = 'flex';
            if( input_div.length > 0 && is_clicked ){
                input_div[0].focus();
            }
        }else{
            controlled_div.style.display = 'none';
            input_div[0].value = null;
        }
    }

    control_checkboxes.forEach( checkbox => {
        if( checkbox.tagName === 'INPUT' && checkbox.getAttribute( 'type' ) === 'checkbox' ){
            care_taker( checkbox );
            checkbox.addEventListener( 'click', event => {
                const checkbox = event.target; 
                care_taker( checkbox, true );
            } )
        }
    });

    const copyright_text = document.getElementById( 'the_one_copyright_text' );
    if( copyright_text ){
        copyright_text.value = copyright_text.value === '' ? '\u00A9 ' : copyright_text.value;
    }

})()