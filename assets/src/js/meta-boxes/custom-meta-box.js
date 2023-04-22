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
const set_thickness = () => infos[ 'thickness' ] = thickness?.value ?? '' ;
const set_color = () => infos[ 'color' ] = color?.value ?? '' ;
const set_padding = () => infos[ 'padding' ] = padding?.value ?? '' ;
const set_pattern = () => infos[ 'border_pattern' ] = border_pattern?.value ?? '' ;

const apply_toggle = () => {
    if( toggle && runner && hidable ){
        if( toggle.checked ){
            hidable.classList.remove( 'cmb-hidable' );
            runner.classList.remove( 'cmb-temp-off' );
            runner.classList.add( 'cmb-temp-on' );
            runner.style.animationName = 'cmb-slider-on';
            infos[ 'bordered?' ] = true;
        }
        else{
            toggle.removeAttribute( 'checked','' )
            hidable.classList.add( 'cmb-hidable' );      
            runner.classList.remove( 'cmb-temp-on' );
            runner.classList.add( 'cmb-temp-off' );
            runner.style.animationName = 'cmb-slider-off';
            infos[ 'bordered?' ] = false;  
        }
    }
}
const apply_border = () => border_pattern ? border_pattern.style.border = '4px ' + infos['border_pattern'] + ' ' + infos['color'] : null;

set_thickness();
set_color();
set_padding();
set_pattern();
apply_toggle();
apply_border();


toggle?.addEventListener( 'click', event => {
    event.stopPropagation();
    apply_toggle();
} )

thickness?.addEventListener( 'keyup', event => {
    event.stopPropagation();
    set_thickness();
} )

color?.addEventListener( 'change', event => {
    event.stopPropagation();
    set_color();
    apply_border();
} )

padding?.addEventListener( 'keyup', event => {
    event.stopPropagation();
    set_padding();
} )

border_pattern?.addEventListener( 'change', event => {
    event.stopPropagation();
    set_pattern();
    apply_border();
} )

