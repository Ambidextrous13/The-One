const toggle = document.getElementById( 'cmb-toggle' );
const runner = document.getElementById( 'cmb-i-r' );
const hidable = document.getElementById( 'cmb-hidable' )
const thickness = document.getElementById( 'cmb-thickness' );
const color = document.getElementById( 'cmb-color' );
const padding = document.getElementById( 'cmb-padding' );
const border_pattern = document.getElementById( 'cmb-pattern' );

let infos = {
    'bordered?' : false,
    'thickness' : 5,
    'color' : '#7a7a7a',
    'padding' : 10,
    'border_pattern' : 'none'
}

toggle.addEventListener( 'click', event => {
    event.stopPropagation();
    const target = event.target;
    if( target.checked ){
        hidable.classList.remove( 'cmb-hidable' );
        runner.classList.remove( 'cmb-temp-off' );
        runner.classList.add( 'cmb-temp-on' );
        runner.style.animationName = 'cmb-slider-on';
        infos[ 'bordered?' ] = true;
    }
    else{
        hidable.classList.add( 'cmb-hidable' );      
        runner.classList.remove( 'cmb-temp-on' );
        runner.classList.add( 'cmb-temp-off' );
        runner.style.animationName = 'cmb-slider-off';
        infos[ 'bordered?' ] = false;  
    }
} )

thickness.addEventListener( 'keyup', event => {
    event.stopPropagation();
    infos[ 'thickness' ] = event.target.value;
} )

color.addEventListener( 'change', event => {
    event.stopPropagation();
    infos[ 'color' ] = event.target.value;
    console.log( infos )
} )

padding.addEventListener( 'keyup', event => {
    event.stopPropagation();
    infos[ 'padding' ] = event.target.value;
} )

border_pattern.addEventListener( 'change', event => {
    event.stopPropagation();
    const border = event.target;
    infos[ 'border_pattern' ] = border.value;
    border.style.border = infos['thickness'] + 'px ' + infos['border_pattern'] + ' ' + infos['color'];
} )

