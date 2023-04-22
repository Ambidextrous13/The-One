<?php
/**
 * Class File: Flicker gallery Widget.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

namespace THE_ONE\Inc\Classes;

use THE_ONE\Inc\Traits\Singleton;
use WP_Widget;

/**
 *  Flicker gallery Widget class
 */
class Widget_Flickr extends WP_Widget {
	use Singleton;

	/**
	 * Invokes the super method `__construct` of parent class `WP_Widget to register Twitter Widget.
	 */
	public function __construct() {
		parent::__construct(
			'widget_flickr',
			__( 'The One: Flickr', 'the-one' )
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

		get_template_part( 'template-parts/widgets/widget', 'flickr' );

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
			'title' => [
				'label'      => 'Title:',
				'name'       => $this->get_field_name( 'title' ),
				'input:type' => 'text',
				'attr'       => [
					'name'  => $this->get_field_name( 'title' ),
					'id'    => $this->get_field_id( 'title' ),
					'value' => isset( $instance['title'] ) ? $instance['title'] : 'Gallery',
				],
			],
		];

		foreach ( $html_metas as $_ => $meta ) {
			$label = HTML::label_tag( $meta['label'], $meta['name'] );
			$input = HTML::input_tag(
				$meta['input:type'],
				isset( $meta['attr'] ) ? ( $meta['attr'] ) : []
			);

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
		$instance          = [];
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? esc_html( $new_instance['title'] ) : '';
		return $instance;
	}
}


