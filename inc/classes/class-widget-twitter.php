<?php
/**
 * Class File: Twitter Widget.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

namespace THE_ONE\Inc\Classes;

use THE_ONE\Inc\Traits\Singleton;
use WP_Widget, DOMDocument;

/**
 * Twitter Widget Class
 */
class Widget_Twitter extends WP_Widget {
	use Singleton;

	/**
	 * Invokes the super method `__construct` of parent class `WP_Widget to register Twitter Widget.
	 */
	public function __construct() {
		parent::__construct(
			'widget_twitter',
			__( 'The One: Twitter Highlights', 'the-one' ),
		);
	}

	/**
	 * Front-end widget loader( Override )
	 *
	 * @param array $args : Display arguments including 'before_title', 'after_title', 'before_widget', and 'after_widget'.
	 * @param array $instance : The settings for the particular instance of the widget.
	 * @return void
	 */
	public function widget( $args, $instance ) {
		$before_widget = $args['before_widget'];
		$before_title  = $args['before_title'];
		$after_title   = $args['after_title'];
		$after_widget  = $args['after_widget'];

		echo wp_kses(
			$before_widget,
			[
				'div' => [
					'class' => 'col-sm-6 col-md-3 col-lg-3',
				],
			]
		);

		$title = apply_filters( 'widget_title', $instance['title'] );
		if ( ! empty( $title ) ) {
			echo wp_kses(
				$before_title . esc_html( $title ) . $after_title,
				[
					'div'  => [
						'class' => 'widget_title',
					],
					'h4'   => [],
					'span' => [],
				]
			);
		}

		get_template_part( 'template-parts/widgets/widget', 'twitter', $instance );

		echo wp_kses(
			$after_widget,
			[
				'div' => [],
			]
		);
	}

	/**
	 * Generates admin side form to set front-end variables.
	 *
	 * @param array $instance : The settings for the particular instance of the widget.
	 * @return void
	 */
	public function form( $instance ) {
		$html_metas = [
			'title'  => [
				'label'      => 'Widget Title:',
				'input:type' => 'text',
				'name'       => $this->get_field_name( 'title' ),
				'attr'       => [
					'name'  => $this->get_field_name( 'title' ),
					'id'    => $this->get_field_id( 'title' ),
					'value' => isset( $instance['title'] ) ? $instance['title'] : 'Tweets',
				],
			],
			'embed1' => [
				'label'     => 'Embed Code',
				'tag'       => 'textarea',
				'name'      => $this->get_field_name( 'embed_1' ),
				'innertext' => isset( $instance['embed_1'] ) ? $instance['embed_1'] : '',
				'attr'      => [
					'name'        => $this->get_field_name( 'embed_1' ),
					'id'          => $this->get_field_id( 'embed_1' ),
					'placeholder' => __( 'Click on right side three dot on your tweet, click on embed tweet then copy code and paste it here.We will take care the remaining', 'the-one' ),
					'rows'        => 2,
					'style'       => 'width:100%',
				],
			],
			'embed2' => [
				'label'     => 'Embed Code',
				'tag'       => 'textarea',
				'name'      => $this->get_field_name( 'embed_2' ),
				'innertext' => isset( $instance['embed_2'] ) ? $instance['embed_2'] : '',
				'attr'      => [
					'name'        => $this->get_field_name( 'embed_2' ),
					'id'          => $this->get_field_id( 'embed_2' ),
					'placeholder' => __( 'Second feed goes here.', 'the-one' ),
					'rows'        => 2,
					'style'       => 'width:100%',
				],
			],
		];

		foreach ( $html_metas as $_ => $meta ) {
			if ( isset( $meta['label'] ) && isset( $meta['name'] ) ) {
				$label = HTML::label_tag( $meta['label'], $meta['name'] );
			}
			if ( isset( $meta['input:type'] ) ) {
				$input = HTML::input_tag(
					$meta['input:type'],
					isset( $meta['attr'] ) ? ( $meta['attr'] ) : []
				);
			}
			if ( isset( $meta['tag'] ) && isset( $meta['attr'] ) ) {
				$input = HTML::custom_tag(
					$meta['tag'],
					$meta['innertext'],
					false,
					$meta['attr']
				);
			}

			$pera_safe = HTML::p_tag(
				$label . $input,
				[],
				true
			);
			// phpcs:ignore
			echo $pera_safe;
		};
	}

	/**
	 * Returns new settings of widgets.
	 *
	 * @param array $new_instance : array of new values of widget's keys.
	 * @param array $old_instance : array of old values of widget's keys.
	 * @return array of new preferences.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance            = [];
		$instance['title']   = ( ! empty( $new_instance['title'] ) ) ? esc_html( $new_instance['title'] ) : '';
		$instance['embed_1'] = ( ! empty( $new_instance['embed_1'] ) ) ? self::rectifier( $new_instance['embed_1'] ) : '';
		$instance['embed_2'] = ( ! empty( $new_instance['embed_2'] ) ) ? self::rectifier( $new_instance['embed_2'] ) : '';
		return $instance;
	}

	/**
	 * Sanitizes and formats the raw share link of twitter into the `The-One` twitter feed display format.
	 *
	 * @param string $code : share link provided by twitter.
	 * @return json formatted data.
	 */
	private static function rectifier( $code ) {
		$arr = [];
		$dom = new DOMDocument();
		$dom->loadHTML( $code );
		foreach ( $dom->getElementsByTagName( 'p' ) as $element ) {
			// phpcs:ignore
			$text        = $element->nodeValue;
			$arr['text'] = esc_html( $text );
		}

		foreach ( $dom->getElementsByTagName( 'blockquote' ) as $element ) {
			//phpcs:ignore
			$str   =  $element->nodeValue;
			$regex = '/\(@.{1,}\)/';
			$match = [];
			preg_match( $regex, $str, $match );
			if ( ! empty( $match ) ) {
				$arr['author'] = esc_html( substr( $match[0], 1, -1 ) );
			}
		}

		foreach ( $dom->getElementsByTagName( 'a' ) as $element ) {
			//phpcs:ignore
			$date  = $element->nodeValue;
			$regex = '/.{1,}\s[0-9]{1,2}, [0-9]{2,4}/';
			$match = [];
			preg_match( $regex, $date, $match );
			if ( ! empty( $match ) ) {
				$arr['date'] = esc_html( $match[0] );
			} else {
				$arr['date'] = esc_html( '' );
			}

			$link  = $element->getAttribute( 'href' );
			$regex = '/https:\/\/twitter.com\/.{1,}/';
			$match = [];
			preg_match( $regex, $link, $match );
			if ( ! empty( $match ) ) {
				$arr['link'] = esc_html( $match[0] );
			} else {
				if ( isset( $arr['author'] ) ) {
					$arr['link'] = esc_html( 'https://twitter.com/' . substr( $arr['author'], 1 ) );
				}
				$arr['link'] = esc_html( 'https://twitter.com/' );
			}
		}
		return Wp_json_encode( $arr );
	}
}
