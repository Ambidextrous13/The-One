<?php
/**
 * Main Template file.
 * 
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */
use THE_ONE\Inc\Classes\{ Infinite_Scroll , Settings };

$infi_scroll = get_option( 'the_one_infinite_scroll' );

get_header( );
if( is_home( ) ){
    get_template_part( 'template-parts/posts/html', 'upper', $infi_scroll ? [ 'div_1_id' => 'id ="append_here"' ] : [] );

    if( 'on' === $infi_scroll ){
        $instance = THE_ONE\Inc\Classes\Infinite_Scroll::get_instance();
        $instance->give_feeds();
    }
    else{
        get_template_part( 'template-parts/posts/html', 'upper' );
        if( have_posts( ) ){
            while( have_posts( ) ) {
                the_post( );
                get_template_part( '/template-parts/posts/article' );
            }
        wp_reset_postdata();
        }
    }

    echo '</div>';
    
    get_template_part( 'template-parts/posts/paginator',null , $infi_scroll ? [ 'retro_reflective_panels' => 'on' ] : [] );
    echo '</div>';
    get_sidebar();
    get_template_part( 'template-parts/posts/html', 'lower' );
}

                
get_footer( );
?>