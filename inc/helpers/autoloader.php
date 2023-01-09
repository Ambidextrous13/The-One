<?php
    namespace THE_ONE\Inc\Helpers;

    function autoloader( $path = '' ){
        $ancestor = 'THE_ONE';
        if( empty( $path ) || strpos( $path, '\\' ) === false || strpos( $path, $ancestor ) !== 0 ){
            return;
        }

        $path = str_replace( '_', '-', $path  );

        $path = explode( '\\', $path );

        $loc = [];
        $loc[0] = untrailingslashit( THE_BASE );
        $loc[1] = strtolower( $path[1] );
        $loc[2] = strtolower( $path[2] );
        
        // print_r($loc);
        // wp_die();

        switch ( $loc[2] ) {
            case 'classes':
                $loc[3] = 'class-' . strtolower( $path[3] );
                break;
            case 'traits':
                $loc[3] = 'trait-' . strtolower( $path[3] );
                break;
            default:
                $loc[3] = strtolower( $path[3] );
                break;
        }

        $resource_path = implode( '\\', $loc );
        require_once $resource_path . '.php' ;

    }
    spl_autoload_register( '\THE_ONE\Inc\Helpers\autoloader' )
?>