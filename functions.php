<?php
/**
 * Main functions file.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

// Absolute locations.
define( 'THE_BASE', get_template_directory() . '/' );
define( 'ABS_DEV_ASSETS_PATH', THE_BASE . 'assets/build/' );
define( 'ABS_THE_ONE_JS', ABS_DEV_ASSETS_PATH . 'js/the-one-' );
define( 'ABS_THE_ONE_CSS', ABS_DEV_ASSETS_PATH . 'css/the-one-' );

// URL locations.
define( 'THE_ROOT', untrailingslashit( get_template_directory_uri() ) . '/' );
define( 'DEV_ASSETS_PATH', THE_ROOT . 'assets/build/' );
define( 'THE_ONE_JS', DEV_ASSETS_PATH . 'js/the-one-' );
define( 'THE_ONE_CSS', DEV_ASSETS_PATH . 'css/the-one-' );

require_once THE_BASE . 'inc/helpers/autoloader.php';

/**
 * Initialize the theme Class i.e. 'THE_ONE`
 *
 * @return instance of class`THE_ONE`
 */
function the_one_init_() {
	return THE_ONE\inc\classes\THE_ONE::get_instance();
}

$theme_instance = the_one_init_();

/**
 * Displays styled single post pagination.incase of post have page breaks.
 *
 * @return void
 */
function the_one_post_paginator() {
	$pagination_before = '<div class="col-lg-12 col-md-12 col-sm-12"> <ul class="pagination pull-left mrgt-0">';
	$pagination_after  = '</ul> </div>';

	$pagination_html = wp_link_pages(
		[
			'before'           => '',
			'after'            => '',
			'link_before'      => '',
			'link_after'       => '',
			'next_or_number'   => 'next',
			'separator'        => wp_link_pages(
				[
					'before'      => '',
					'after'       => '',
					'link_before' => '',
					'link_after'  => '',
					'echo'        => '0',
				]
			),
			'nextpagelink'     => __( 'Next ', 'the-one' ) . '&raquo',
			'previouspagelink' => '&laquo' . __( ' Previous', 'the-one' ),
			'echo'             => '0',
		]
	);

	if ( 120 > strlen( $pagination_html ) ) {
		$numbers_html = wp_link_pages(
			[
				'before'      => '',
				'after'       => '',
				'link_before' => '',
				'link_after'  => '',
				'echo'        => '0',

			]
		);
		if ( substr_count( $pagination_html, 'Next', 0 ) ) {
			$pagination_html = $numbers_html . $pagination_html;
		} elseif ( substr_count( $pagination_html, 'Previous', 0 ) ) {
			$pagination_html .= $numbers_html;
		}
	}
	$pagination_html  = $pagination_before . $pagination_html;
	$pagination_html .= $pagination_after;

	$search_arr  = [ '<a', '</a>', '<span', '</span>' ];
	$replace_arr = [ '<li><a', '</a></li>', '<li class="active"><span', '</span></li>' ];

	// phpcs:ignore
	echo str_replace( $search_arr, $replace_arr, $pagination_html );
}

/**
 * Returns content of template part. use same as get_template_part.
 *
 * @param string $slug : address of template part from theme's root directory. i.e. with respect to the index.php of your theme.
 * @param string $name : name of specialized template.
 * @param string $args : array that will be provided to the template file.
 * @return string Content of given template.
 */
function the_one_template_part( $slug, $name = '', $args = '' ) {
	the_one_suppress_the_echo();
	if ( '' === $name && '' === $args && '' !== $slug ) {
		get_template_part( $slug );
	} elseif ( '' === $args && '' !== $slug && '' !== $name ) {
		get_template_part( $slug, $name );
	} elseif ( '' !== $slug && '' !== $name && '' !== $args ) {
		get_template_part( $slug, $name, $args );
	} else {
		return false;
	}
	return the_one_echo_to_returnable();
}

/**
 * Stops output till the function `the_one_echo_to_returnable` called
 *
 * @return void
 */
function the_one_suppress_the_echo() {
	ob_start();
}

/**
 * Returns the string of what being outputted in case of echoing allowed. Works in the pair of function `the_one_suppress_the_echo`
 *
 * @see function `the_one_suppress_the_echo`
 * @return String
 */
function the_one_echo_to_returnable() {
	$returnable = ob_get_contents();
	ob_end_clean();
	return $returnable;
}

/**
 * Checks if `array` exist, if yes then searches for `key` if exist else returns `default_return`, concatenates the prefix in front and suffix at back of the value of searched `key` after limiting the character with character limit `char_limit`.
 *
 * @param array   $array : On which searching operation performed.
 * @param string  $key : whose value will be returned.
 * @param string  $default_return : value to be returned, If failed to locate `key` in given `array`.
 * @param string  $prefix : String to be added in-front of the value to be returned.
 * @param string  $suffix : String to be added after the value to be returned.
 * @param int     $char_limit : Number of character of value to be returned. Note: `prefix` and `suffix` will be added on the substring of value of character length of `char_limit` means, total characters returns will be char_limit + prefix's character count + suffix character count.
 * @param boolean $full_last_word : If `char_limit` is provided, does this function returns value with full last word or not?.
 * @return string
 */
function the_one_get_the_value( $array, $key, $default_return = false, $prefix = '', $suffix = '', $char_limit = null, $full_last_word = false ) {
	$value = $default_return;
	$cut   = false;
	if ( is_array( $array ) && ! empty( $array ) ) {
		$value = isset( $array[ $key ] ) ? $prefix . $array[ $key ] : $default_return;
		if ( ! is_null( $char_limit ) && strlen( $value ) > $char_limit ) {
			$value = $full_last_word ? substr( $value, 0, strpos( $value . ' ', ' ', $char_limit ) ) : substr( $value, 0, $char_limit );
		}
		$value .= $cut ? $suffix : '';
	}
	return $value;
}

add_filter( 'comment_form_fields', 'the_one_reorder_comment_form' );
add_action( 'comment_form_before_fields', 'the_one_wrapper_div' );

/**
 * Hardcoded reordering of comment box to suit theme design
 *
 * @param array $comment_fields : array of comment form field.
 * @return array new reordered comment_field.
 */
function the_one_reorder_comment_form( $comment_fields ) {
	$comment_box = the_one_get_the_value( $comment_fields, 'comment', false );
	if ( $comment_box ) {
		unset( $comment_fields['comment'] );
	}

	$cookies = the_one_get_the_value( $comment_fields, 'cookies', false );
	if ( $cookies ) {
		unset( $comment_fields['cookies'] );
	}

	return $comment_fields += [
		'comment' => $comment_box,
		'cookies' => $cookies,
	];
}

/**
 * Echo out the `div` tag with class `row`
 *
 * @return void
 */
function the_one_wrapper_div() {
	echo '<div class="row">';
}

/**
 * Puts admin note to the given page. which is only visible with admin logins. Helpful for theme setup.
 *
 * @param string  $note : Note to displayed to admin.
 * @param string  $page : Select page short-name from following list or provide admin url to which admin will redirect on click.
 * @param string  $highlight_query : Id or class name of a element which gets highlighted when admin reaches the `page` by clicking on `note`. if ID is provided add`#` infront and `.`(period) incase of class for example if id is `foo` the pass it as `#foo` or for class `bar` pass it as `.bar`. Note: in the case of class only first element will be highlighted.
 * @param boolean $is_link : true if url is passed instead of short name at `page` argument. default `false`.
 * @param string  $tag_o : html opening tag name in which `note` argument  gets wrapped. Note: tag name with the angled brackets.  default `<span>`.
 * @param string  $tag_c : html closing tag with angled brackets.
 * @return void
 */
function the_one_admin_note( $note, $page, $highlight_query, $is_link = false, $tag_o = '<span>', $tag_c = '</span>' ) {
	if ( current_user_can( 'manage_options' ) ) {
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
					$redirection_link = admin_url();
			}
		} else {
			$redirection_link = admin_url( $page . '?' );
		}
		if ( '#' === substr( $highlight_query, 0, 1 ) ) {
			$highlight_query = substr( $highlight_query, 1 ) . '&type=id';
		} elseif ( '#' === substr( $highlight_query, 0, 1 ) ) {
			$highlight_query = substr( $highlight_query, 1 ) . '&type=class';
		}
		$redirection_link .= 'highlight=' . $highlight_query;

		$html = sprintf(
			'%1$s class="light-big">
						%2$s <span class="light-small" >Click here to set</span>
					%3$s',
			substr( $tag_o, 0, -1 ),
			$note,
			$tag_c
		);

		$link_args = [
			'href'   => $redirection_link,
			'target' => '_blank',
		];
		// phpcs:ignore
		echo THE_ONE\Inc\Classes\HTML::custom_tag( 'a', $html, false, $link_args, true );

	}
}

/**
 * Gives the link of sharing API of given Host name for given post and post data.
 *
 * @param String $host : host name for which link to be generated.
 * @param Array  $post_data : pass the following key value pair as per host requires.
 *  List of valid parameters.
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
function the_one_get_share_link_for( $host, $post_data ) {
	if ( ! empty( $post_data ) ) {
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

		$sharable_url   = $params['sharable_url'];
		$heading        = $params['heading'];
		$author         = $params['author'];
		$hashtag_string = $params['hashtag_string'];
		$image          = $params['image'];
		$is_video       = $params['is_video'];
		$description    = $params['description'];

		switch ( $host ) {
			case 'facebook':
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://www.facebook.com/sharer.php?u=%s"', $sharable_url ) ) );
			case 'twitter':
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://twitter.com/share?url=%1$s&text=%2$s&via=%3$s&hashtags=%4$s"', $sharable_url, $heading, $author, $hashtag_string ) ) );
			case 'google_plus':
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://plus.google.com/share?url=%s"', $sharable_url ) ) );
			case 'pinterest':
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://pinterest.com/pin/create/bookmarklet/?media=%1$s&url=%2$s&is_video=%3$s&description=%4$s"', $image, $sharable_url, $is_video, $heading ) ) );
			case 'linkedin':
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://www.linkedin.com/shareArticle?url=%1$s&title=%2$s"', $sharable_url, $heading ) ) );
			case 'buffer':
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://bufferapp.com/add?text=%2$s&url=%1$s"', $sharable_url, $heading ) ) );
			case 'tumblr':
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://www.tumblr.com/share/link?url=%1$s&name=%2$s&description=%3$s"', $sharable_url, $heading, $description ) ) );
			case 'reddit':
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://reddit.com/submit?url=%1$s&title=%2$s"', $sharable_url, $heading ) ) );
			case 'stumble_upon':
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://www.stumbleupon.com/submit?url=%1$s&title=%2$s"', $sharable_url, $heading ) ) );
			case 'delicious':
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://delicious.com/save?v=5&provider=%3$s&noui&jump=close&url=%1$s&title=%2$s"', $sharable_url, $heading, $author ) ) );
			case 'evernote':
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://www.evernote.com/clip.action?url=%1$s&title=%2$s"', $sharable_url, $heading ) ) );
			case 'wordpress':// phpcs:ignore
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://wordpress.com/press-this.php?u=%1$s&t=%2$s&s=%3$s&i=%4$s"', $sharable_url, $heading, $description, $image ) ) );
			case 'pocket':
				return sprintf( 'href="%s"', esc_url_raw( sprintf( 'https://getpocket.com/save?url=%1$s&title=%2$s"', $sharable_url, $heading ) ) );
			case 'email':
				return sprintf( 'mailto:?subject=%2$s&body=Check out this: %1$s', $sharable_url, $heading );
			case 'copy_link':
				return sprintf( 'id="copy-it" copy="%s"', $sharable_url );
			default:
				return false;
		}
	} else {
		return false;
	}
}

/**
 * Returns html for given share button
 *
 * @param string $button : Name of share button for example 'wordpress', all small case.
 * @param Array  $post_data : array containing following details require to create shareable link.
 * @return String|false containing HTML for given button
 */
function the_one_get_share_button_html( $button, $post_data ) {
	$link = the_one_get_share_link_for( $button, $post_data );
	if ( $link ) {
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
			esc_html( $button ),
			$link,
			ucfirst( $button )
		);
	} else {
		return false;
	}
}

/**
 * Gives post data require for sharing the post, data such as post's URL, heading, author, tags,main image and excerpt.
 *
 * @param int $post_id : id of the post.
 * @param int $author_id : id of the author of the post.
 * @return array|false containing above given data
 */
function the_one_get_post_data_for_share( $post_id, $author_id ) {
	if ( 0 !== $post_id && 0 !== $author_id ) {
		global $wp;
		$thumbnail_src = '';
		if ( has_post_thumbnail() ) {
			$thumbnail_src = get_the_post_thumbnail_url( '', 'the-one-indexing-size' );
		}

		$mime_of_thumbnail = wp_check_filetype( $thumbnail_src )['type'];

		$hashtag_string = '';

		$tags = get_the_tags( $post_id );
		if ( ! empty( $tag ) ) {
			foreach ( $tags as $tag ) {
				if ( ! empty( $hashtag_string ) ) {
					$hashtag_string .= ',';
				}
				$hashtag_string .= $tag->slug;
			}
		}
		return [
			'sharable_url'   => add_query_arg( $wp->query_vars, home_url( $wp->request ) ),
			'heading'        => get_the_title( $post_id ),
			'author'         => get_the_author_meta( 'display_name', $author_id ),
			'hashtag_string' => $hashtag_string,
			'image'          => $thumbnail_src,
			'is_video'       => 'video' === substr( $mime_of_thumbnail, 0, strpos( '/', $mime_of_thumbnail ) ) ? 'true' : 'false',
			'description'    => get_the_excerpt( $post_id ),
		];
	} else {
		return false;
	}
}

/**
 * Shorten the given string upto the given character limit with complete last word.
 *
 * @param string  $text : string which need to be shortened.
 * @param integer $limit : Character counts up to that given string get short.
 * @param boolean $strict : true for strict limit follow, false for complete word end.
 * @return string shortened string with ellipses.
 */
function the_one_short_text( $text, $limit = 45, $strict = false ) {
	if ( $limit < strlen( $text ) ) {
		if ( ! $strict ) {
			return substr( $text, 0, strpos( $text, ' ', $limit - 5 ) ? strpos( $text, ' ', $limit - 5 ) : -1 ) . '[...]';
		} else {
			return substr( $text, 0, $limit ) . '[...]';
		}
	}
	return $text;
}

/**
 * Prints the styled main menu.
 *
 * @param array $element : array of cascaded menu options. can be derived from class-menus' method `get_one_step_minimized_menu`.
 * @return void
 */
function the_one_print_menu( $element ) {
	global $wp;
	foreach ( $element as $id => $meta ) {
		$title      = $meta['title'];
		$url        = $meta['url'];
		$has_child  = ! empty( $meta['children'] );
		$has_parent = $meta['has_parent'];
		$children   = $meta['children'];

		$is_root   = ! $has_parent;
		$is_active = add_query_arg( $wp->query_vars, home_url() ) === $url;

		$active_str       = $is_active ? 'active' : '';
		$has_submenu_str  = $has_child ? 'has-submenu' : '';
		$data_hover_class = $is_root ? 'data-hover' : '';

		echo '<li class="' . esc_attr( $active_str ) . '">';
		echo '<a href="' . esc_url( $url ) . '" class="' . esc_attr( $has_submenu_str ) . '" >';
		if ( $is_root ) {
			echo '<span class="' . esc_attr( $data_hover_class ) . '" data-hover="' . esc_attr( $title ) . '" >';
		}
		echo esc_html( $title );
		if ( $is_root ) {
			echo '</span>';
		}
		echo '</a>';
		if ( $has_child ) {
			echo '<ul class="dropdown-menu sm-nowrap">';
			the_one_print_menu( $children );
			echo '</ul>';
		}
		echo '</li>';
	}
}
