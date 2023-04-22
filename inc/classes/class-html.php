<?php
/**
 * Class File: Secure HTML Generator.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

namespace THE_ONE\Inc\Classes;

use THE_ONE\Inc\Traits\Singleton;

/**
 * HTML Generator.
 */
class HTML {
	use Singleton;

	/**
	 * Initialize the HTML class
	 */
	private function __construct() {

	}

	/**
	 * This static function returns a string having class id and other inline attributes in HTML format
	 *
	 * @param array   $args : HTML class formatted array of attributes ( use HTML class' method `info_formatted_array()` to have look on format ).
	 * @param boolean $is_end : should it returns the closing brackets.
	 * @param boolean $self_closing : defines the closing bracket's nature for example setting true appends `/>` and false adds '>' at the end of tag.
	 * @return string
	 */
	private static function set_class_id_params( $args = [], $is_end = false, $self_closing = false ) {
		$html = '';
		if ( is_array( $args ) && ! empty( $args ) ) {
			foreach ( $args as $key => $value ) {
				if ( 'attributes' === $key ) {
					if ( is_array( $value ) && ! empty( $value ) ) {
						foreach ( $value as $attribute ) {
							$html .= ' ' . esc_attr( $attribute );
						}
					}
					continue;
				}
				if ( 'href' === $key ) {
					$html .= ' ' . esc_attr( $key ) . '="' . esc_url_raw( $value ) . '"';
				}
				$html .= ' ' . esc_attr( $key ) . '="' . esc_attr( $value ) . '"';
			}
		}
		if ( $is_end ) {
			$html .= $self_closing ? '/>' : '>';
		}
		return $html;
	}

	/**
	 * Sanitize content, so that it can be appended directly
	 *
	 * @param string  $content : content to be sanitize.
	 * @param boolean $content_have_html : does content contains html entities.
	 * @return string
	 */
	private static function set_content( $content, $content_have_html ) {
		$html = '';
		if ( $content_have_html ) {
			$html .= $content;
		} else {
			$html .= esc_html( $content );
		}
		return $html;
	}

	/**
	 * Allows to create HTML tags
	 *
	 * @param string  $tag : name of tag. for example 'img' or 'a'.
	 * @param string  $content : content for given tag. Equivalent to innerHtml function of JS.
	 * @param boolean $is_self_closing : is it self closing?.
	 * @param array   $args : HTML class formatted string( use HTML class' method `info_formatted_array()` to have look on format ).
	 * @param boolean $content_have_html : does the content have any HTML entities?.
	 * @return string String of HTML Tag.
	 */
	public static function custom_tag( $tag, $content = '', $is_self_closing = false, $args = [], $content_have_html = false ) {
		$html  = '<' . $tag;
		$html .= self::set_class_id_params( $args, true, $is_self_closing );
		$html .= self::set_content( $content, $content_have_html );
		$html .= $is_self_closing ? '' : '</' . $tag . '>';
		return $html;
	}

	/**
	 * Generates HTML <p>[content]</p> entity (i.e. paragraph tag).
	 *
	 * @param string $content : Content to be put inside the p Tag.
	 * @param array  $args [optional] : HTML class formatted string( use HTML class' method `info_formatted_array()` to have look on format ).
	 * @param bool   $content_have_html : does the content have any HTML entities?.
	 * @return string
	 */
	public static function p_tag( $content, $args = [], $content_have_html = false ) {
		return self::custom_tag( 'p', $content, false, $args, $content_have_html );
	}

	/**
	 * Generates HTML <span>[content]</span> entity
	 *
	 * @param string  $content : Content to be put inside the span tag.
	 * @param array   $args : HTML class formatted string( use HTML class' method `info_formatted_array()` to have look on format ).
	 * @param boolean $content_have_html : does the content have any HTML entities?.
	 * @return string
	 */
	public static function span_tag( $content, $args = [], $content_have_html = false ) {
		return self::custom_tag( 'span', $content, false, $args, $content_have_html );
	}

	/**
	 * Generates HTML <label>...</label> entity
	 *
	 * @param string  $content : Content to be put inside the span tag.
	 * @param string  $for : String value of `for` attribute of label tag.
	 * @param array   $args : HTML class formatted string( use HTML class' method `info_formatted_array()` to have look on format ).
	 * @param boolean $content_have_html : does the content have any HTML entities?.
	 * @return string
	 */
	public static function label_tag( $content, $for, $args = [], $content_have_html = false ) {
		$tag_specific_params = [ 'for' => $for ];

		$args = wp_parse_args( $args, $tag_specific_params );
		return self::custom_tag( 'label', $content, false, $args, $content_have_html );

	}

	/**
	 * Generates HTML <input /> tag
	 *
	 * @param string $type : type attribute of `input` tag.
	 * @param array  $args : HTML class formatted string( use HTML class' method `info_formatted_array()` to have look on format ).
	 * @return string
	 */
	public static function input_tag( $type, $args = [] ) {
		$tag_specific_params = [ 'type' => $type ];

		$args = wp_parse_args( $args, $tag_specific_params );
		return self::custom_tag( 'input', '', true, $args, true );
	}

	/**
	 * Generates HTML <div>[content]</div> Entity.
	 *
	 * @param string $content : Content to be put inside the span tag.
	 * @param string $content_have_html : does the content have any HTML entities?.
	 * @param array  $args : HTML class formatted string( use HTML class' method `info_formatted_array()` to have look on format ).
	 * @return string
	 */
	public static function div_tag( $content, $content_have_html, $args = [] ) {
		return self::custom_tag( 'div', $content, false, $args, $content_have_html );
	}

	/**
	 * Generates HTML <form>[content]</form> Entity.
	 *
	 * @param string $content : Content to be put inside the span tag.
	 * @param string $method : value of `method` attribute of form HTML tag. i.e. GET, POST,... etc.
	 * @param string $action : value of `action` attribute of form HTML tag.
	 * @param array  $args : HTML class formatted string( use HTML class' method `info_formatted_array()` to have look on format ).
	 * @return string
	 */
	public static function form_tag( $content, $method, $action, $args = [] ) {
		$tag_specific_params = [
			'method' => $method,
			'action' => $action,
		];

		$args = wp_parse_args( $args, $tag_specific_params );
		return self::custom_tag( 'form', $content, false, $args, true );
	}

	/**
	 * Generates HTML <h[level]>[content]</h[level]> Tag i.e. h1, h2, h3,...,h6
	 *
	 * @param string  $level : level of heading tag. ranging from 1 to 6 represent h1 to h6 respectively.
	 * @param string  $content : Content to be put inside the heading tag.
	 * @param array   $args : HTML class formatted string( use HTML class' method `info_formatted_array()` to have look on format ).
	 * @param boolean $content_have_html : does the content have any HTML entities?.
	 * @return string
	 */
	public static function heading_tag( $level, $content, $args = [], $content_have_html = false ) {
		return self::custom_tag( 'h' . $level, $content, false, $args, $content_have_html );
	}

	/**
	 * Prints the HTML class formatted array.
	 * if you don't want to print and check refer this,
	 *
	 * @example  [
	 *  'class'       => 'quick silver',
	 *  'id'          => 'x-man',
	 *  'inline-args' =>
	 *      [
	 *          'attributes' =>
	 *              [
	 *                  'hidden',
	 *                  'disable',
	 *                  'checked',
	 *              ],
	 *          'data'       => 'smart-para',
	 *          'onclick'    => 'show_yellow_alert()',
	 *      ],
	 *  ]
	 * @return void
	 */
	public static function info_formatted_array() {
		$array = [
			'class'       => 'quick silver',
			'id'          => 'x-man',
			'inline-args' =>
				[
					'attributes' =>
						[
							'hidden',
							'disable',
							'checked',
						],
					'data'       => 'smart-para',
					'onclick'    => 'show_yellow_alert()',
				],
		];
		echo '<pre/>';
		// phpcs:ignore
		print_r( $array );
	}
}


