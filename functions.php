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

function the_template_part( $slug, $name = '', $args = ''  ){
    // ob_start();
    suppress_the_echo();
    if ('' === $name && '' === $args && '' !== $slug ) {
        get_template_part( $slug );
    }
    elseif ( ''=== $args && '' !== $slug && '' !== $name ) {
        get_template_part( $slug, $name );
    }
    elseif ( '' !== $slug && '' !== $name && '' !== $args ) {
        get_template_part( $slug, $name, $args );
    }
    else {
        echo 0;
    }
    // $returnable = ob_get_contents();
    // ob_end_clean();
    // return $returnable;
   return echo_to_returnable();
}

function suppress_the_echo(){
    ob_start();
}

function echo_to_returnable(){
    $returnable = ob_get_contents();
    ob_end_clean();
    return $returnable;
}

function get_the_value( $array, $key, $default_return = '', $prefix = '', $suffix = '', $char_limit = null, $full_last_word = false ){
    $value = $default_return;
	$cut = false;
    if ( is_array( $array ) && ! empty( $array ) ) {    
        $value = isset( $array[ $key ] ) ? $prefix . $array[ $key ] : $default_return;
        if( ! is_null( $char_limit ) && strlen( $value ) > $char_limit ){
            $value = $full_last_word ? substr( $value, 0, strpos( $value . ' ', ' ', $char_limit ) ): substr( $value, 0, $char_limit );
        } 
        $value .= $cut ? $suffix : '';
    }
    return $value;
}

add_filter( 'comment_form_fields', 'reorder_comment_form' );
add_action( 'comment_form_before_fields', 'wrapper_div' );

function reorder_comment_form( $comment_fields ){
    $comment_box = get_the_value( $comment_fields, 'comment', false );
    if( $comment_box ){
        unset( $comment_fields['comment'] );
    }

    $cookies = get_the_value( $comment_fields, 'cookies', false );
    if( $cookies ){
        unset( $comment_fields['cookies'] );
    }

    return $comment_fields += [ 'comment' => $comment_box, 'cookies' => $cookies ];
}

function wrapper_div( ){
    echo '<div class="row">';
}
?>