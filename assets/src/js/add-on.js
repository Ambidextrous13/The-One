import painter from  './meta-boxes/bordered-post-posts';
(
    function(){

        function set_clipboard( text, element ) {
            const type = "text/plain";
            const blob = new Blob([text], { type });
            const data = [new ClipboardItem({ [type]: blob })];
            const original_bg = element.style.backgroundColor; 
          
				navigator.clipboard.write(data).then(
				() => {
					if( null !== original_bg || '' !== original_bg ){
						element.style.backgroundColor = '#82AF53';
						setTimeout(() => {
							element.style.backgroundColor = original_bg;
						}, 2500);
					}
					return 'Copied';
				},
				() => {
					
					if( null !== original_bg || '' !== original_bg ){
						element.style.backgroundColor = '#fc1e1e';
						setTimeout(() => {
							element.style.backgroundColor = original_bg;
						}, 2500);
					}
					return 'Unable to copy';
				}
				);
			}
		painter();
        const copy_element = document.getElementById( 'copy-it' );
        if( copy_element ){     
            copy_element.addEventListener( 'click', event => {
                event.preventDefault();
                const copy_string = copy_element.getAttribute( 'copy' );
                set_clipboard( copy_string, event.target );
            } );
        }
    }
)();
