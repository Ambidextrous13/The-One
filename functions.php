<?php
    define( 'THE_BASE', get_template_directory(  ) . '/' ); // for absolute location used at filemtime
    define('ABS_DEV_ASSETS_PATH', THE_BASE . 'assets/src/' );
    define('ABS_THE_ONE_JS', ABS_DEV_ASSETS_PATH . 'js/' );
    define('ABS_THE_ONE_CSS', ABS_DEV_ASSETS_PATH . 'css/' );

    define( 'THE_ROOT', untrailingslashit( get_template_directory_uri() ) . '/' );
    define('DEV_ASSETS_PATH', THE_ROOT . 'assets/src/' );
    define('THE_ONE_JS', DEV_ASSETS_PATH . 'js/' );
    define('THE_ONE_CSS', DEV_ASSETS_PATH . 'css/' );
    
    require_once THE_BASE . 'inc/helpers/autoloader.php';
    
    function _init_(){
        return THE_ONE\inc\classes\THE_ONE::get_instance();    
    }
   
    $theme_instance = _init_();

    
    function the_one_post_paginator(){
        $pagination_before = '<div class="col-lg-12 col-md-12 col-sm-12"> <ul class="pagination pull-left mrgt-0">';
        $pagination_after = '</ul> </div>';
    
        $pagination_html = wp_link_pages( [
            'before'      		=> '',
            'after'       		=> '',
            'link_before' 		=> '',
            'link_after'  		=> '',
            'next_or_number'	=> 'next',
            'separator'	         => wp_link_pages( [
                'before'            => '',
                'after'             => '',
                'link_before' 		=> '',
                'link_after'  		=> '',
                'echo'              => '0',
            ] ),
            'nextpagelink'		=> __( 'Next &raquo', 'the-one' ),
            'previouspagelink'	=> __( '&laquo Previous', 'the-one' ),
            'echo'              => '0',
        ] );
    
    
        if ( 120 > strlen( $pagination_html ) ) {
            $numbers_html = wp_link_pages( [
                'before'        => '',
                'after'         => '',
                'link_before' 	=> '',
                'link_after'  	=> '',
                'echo'          => '0',
    
            ] );
            if ( substr_count( $pagination_html, 'Next', 0 ) ) {
                $pagination_html = $numbers_html . $pagination_html;
            }
            elseif ( substr_count( $pagination_html, 'Previous', 0) ) {
                $pagination_html .= $numbers_html;
            }
        }
        $pagination_html = $pagination_before . $pagination_html;
        $pagination_html .= $pagination_after;
    
        $search_arr = [ '<a', '</a>', '<span', '</span>' ];
        $replace_arr = [ '<li><a', '</a></li>', '<li class="active"><span', '</span></li>' ];
    
        echo str_replace( $search_arr, $replace_arr, $pagination_html );
    }