(function (){
    const feature_imgs = document.querySelectorAll( 'img.border-it' );
    feature_imgs.forEach( img => {
        let data = img.getAttribute( 'data' );
        data = data.split( '?' );
        img.style.border = data[ 1 ];
        img.style.padding = data[ 2 ];
    });
})();