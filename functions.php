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

function admin_note( $note, $page, $highlight_query, $is_link = false, $tag_o = '<span>', $tag_c = '</span>' ){
    if( current_user_can( 'manage_options' ) ){
        $redirection_link = null;
        if ( ! $is_link ) {
            switch ( $page ) {
                case 'theme-settings':
                    $redirection_link = admin_url( 'themes.php?page=the_one_settings&' );
                    break;
                case 'general-settings':
                    $redirection_link = admin_url( 'options-general.php?' );    
                    break;
                case 'writing-settings':
                    $redirection_link = admin_url( 'options-writing.php?' );    
                    break;
                case 'reading-settings':
                    $redirection_link = admin_url( 'options-reading.php?' );    
                    break;
                case 'discussion-settings':
                    $redirection_link = admin_url( 'options-discussion.php?' );    
                    break;
                case 'media-settings':
                    $redirection_link = admin_url( 'options-media.php?' );    
                    break;
                case 'permalinks-settings':
                    $redirection_link = admin_url( 'options-permalink.php?' );    
                    break;
                case 'privacy-settings':
                    $redirection_link = admin_url( 'options-privacy.php?' );    
                    break;
                case 'nav-menu':
                    $redirection_link = admin_url( 'nav-menus.php?' );
                    break;
                default:
                    $redirection_link = admin_url( );    
            }
        }else {
            $redirection_link = admin_url( $page . '?' );
        }
        $redirection_link .= 'highlight=' . $highlight_query;
        $html =  sprintf(
                    '%1$s class="light-big">
                        %2$s <span class="light-small" >Click here to set</span>
                    %3$s',
                    substr( $tag_o, 0, -1 ),
                    $note,
                    $tag_c
        );
 
        $link_args = [
            'href'   => $redirection_link,
            'target' => '_blank'
        ];

        echo THE_ONE\Inc\Classes\HTML::custom_tag( 'a',$html, false, $link_args, true );

    }
}
/**
 * gives the link of sharing API of given Host name
 *
 * @param String $host
 * @param Array $args
 *  List of valid parameters
 * @requires `'sharable_url'` => `Link of sharable Item` 
 * @optional `'heading'` => `title or heading of the sharable`
 *      Required in-case of `Twitter`,`Google+`, `Pinterest`, `Linkedin`, `Buffer`, `Tumblr`, `Reddit`, `StumbleUpon`, `Delicious` , `Evernote`, `Email`, `Wordpress`, `Pocket`
 * @optional `'author'` => `Name of Author`
 *      Required in-case of `Twitter`, `Delicious`
 * @optional `'hashtag_string'` => `Comma separated non-hashed hashtags' string`
 *      Required in-case of `Twitter`
 * @optional `'image'` => `Url of image you are sharing`
 *      Required in-case of `Pinterest``Wordpress`
 * @optional `'is_video'` => `Boolean value if you are sharing video`
 *      Required in-case of  `Pinterest
 * @optional `'description'` => `description of the sharable item`
 *      Required in-case of `Tumblr`, `Wordpress`
 * @return string|false of Sharing API link for given arguments
 */
function get_share_link_for( $host, $post_data ){
    if( ! empty( $post_data ) ){

        $params = [
            'sharable_url'   => '',
            'heading'        => '',
            'author'         => '',
            'hashtag_string' => '',
            'image'          => '',
            'is_video'       => '',
            'description'    => '',
        ];
    
        $params = wp_parse_args( $post_data, $params );
    
        $sharable_url   = $params[ 'sharable_url'   ];
        $heading        = $params[ 'heading'        ];
        $author         = $params[ 'author'         ];
        $hashtag_string = $params[ 'hashtag_string' ];
        $image          = $params[ 'image'          ];
        $is_video       = $params[ 'is_video'       ];
        $description    = $params[ 'description'    ];
    
        switch ( $host ) {
            case 'facebook':
                return sprintf( 'href="https://www.facebook.com/sharer.php?u=%s"', $sharable_url );
            case 'twitter':
                return sprintf( 'href="https://twitter.com/share?url=%1$s&text=%2$s&via=%3$s&hashtags=%4$s"', $sharable_url, $heading, $author, $hashtag_string );
            case 'google_plus':
                return sprintf( 'href="https://plus.google.com/share?url=%s"', $sharable_url );
            case 'pinterest':
                return sprintf( 'href="https://pinterest.com/pin/create/bookmarklet/?media=%1$s&url=%2$s&is_video=%3$s&description=%4$s"', $image, $sharable_url, $is_video, $heading );
            case 'linkedin':
                return sprintf( 'href="https://www.linkedin.com/shareArticle?url=%1$s&title=%2$s"', $sharable_url, $heading );
            case 'buffer':
                return sprintf( 'href="https://bufferapp.com/add?text=%2$s&url=%1$s"',$sharable_url, $heading );
            case 'tumblr':
                return sprintf( 'href="https://www.tumblr.com/share/link?url=%1$s&name=%2$s&description=%3$s"',$sharable_url, $heading, $description );
            case 'reddit':
                return sprintf( 'href="https://reddit.com/submit?url=%1$s&title=%2$s"',$sharable_url, $heading );
            case 'stumble_upon':
                return sprintf( 'href="https://www.stumbleupon.com/submit?url=%1$s&title=%2$s"',$sharable_url, $heading );
            case 'delicious':
                return sprintf( 'href="https://delicious.com/save?v=5&provider=%3$s&noui&jump=close&url=%1$s&title=%2$s"',$sharable_url, $heading, $author );
            case 'evernote':
                return sprintf( 'href="https://www.evernote.com/clip.action?url=%1$s&title=%2$s"',$sharable_url, $heading );
            case 'email':
                return sprintf( 'mailto:?subject=%2$s&body=Check out this: %1$s',$sharable_url, $heading );
            case 'wordpress':
                return sprintf( 'href="https://wordpress.com/press-this.php?u=%1$s&t=%2$s&s=%3$s&i=%4$s"',$sharable_url, $heading, $description, $image );
            case 'pocket':
                return sprintf( 'href="https://getpocket.com/save?url=%1$s&title=%2$s"',$sharable_url, $heading );
            case 'copy_link':
                return sprintf( 'id="copy-it" copy="%s"', $sharable_url ); 
            default:
                return false;
        }
    }else{
    return false;
    }
}

/**
 * returns html for given share button
 *
 * @param String $button
 * @param Array $post_data
 * @return String|false containing HTML for given button
 */
function get_share_button_html( $button, $post_data ){
    $link = get_share_link_for( $button, $post_data );
    if( $link ){
        return sprintf(
            '<li>
                <a class="%1$s" %2$s data-placement="bottom" data-toggle="tooltip" title="%3$s">
                    <div class="main-div">
                        <div class="move">
                            <svg class="upper-svg share-svg">
                                <use class="filter-svg" href="#%1$s-svg" />
                            </svg>
                            <svg class="lower-svg share-svg">
                                <use class="filter-svg" href="#%1$s-svg" />
                            </svg>
                        </div>
                    </div>
                </a>
            </li>',
            $button,
            $link,
            ucfirst( $button )
        );
    }else{
        return false;
    }
}

/**
 * gives post data require for sharing the post, data such as post's URL, heading, author, tags,main image and excerpt.
 *
 * @param int $post_id
 * @param int $author_id
 * @return array|false containing above given data
 */
function get_post_data_for_share( $post_id, $author_id ){
    if( 0 !== $post_id && 0 !== $author_id ){
        global $wp;
        
        $thumbnail_src = ''; 
        if( has_post_thumbnail( ) ) {
            $thumbnail_src = get_the_post_thumbnail_url( '', 'indexing-size' );
        }
        
        $mime_of_thumbnail = wp_check_filetype( $thumbnail_src )['type'];
        
        $hashtag_string = "";
        $tags = get_the_tags( $post_id );
        foreach( $tags as $tag ){
            if( ! empty( $hashtag_string ) ){
                $hashtag_string .= ',';
            }
            $hashtag_string .= $tag->slug;
        }
        return [
            'sharable_url'   => add_query_arg( $wp->query_vars, home_url( $wp->request ) ) ,
            'heading'        => get_the_title( $post_id ),
            'author'         => get_the_author_meta( 'display_name', $author_id ),
            'hashtag_string' => $hashtag_string,
            'image'          => $thumbnail_src,
            'is_video'       => 'video' === substr( $mime_of_thumbnail, 0, strpos( '/', $mime_of_thumbnail ) ) ? 'true' : 'false',
            'description'    => get_the_excerpt( $post_id ),
        ];
    }else{
        return false;
    }
}
?>