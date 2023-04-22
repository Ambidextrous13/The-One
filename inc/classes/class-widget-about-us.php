<?php
/**
 * Class File: About us Widget.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

namespace THE_ONE\Inc\Classes;

use THE_ONE\Inc\Traits\Singleton;
use WP_Widget;

/**
 * About us Widget class
 */
class Widget_About_Us extends WP_Widget {
	use Singleton;

	/**
	 * Invokes the super method `__construct` of parent class `WP_Widget to register Twitter Widget.
	 */
	public function __construct() {
		parent::__construct(
			'widget_about_us',
			__( 'The One: About Us', 'the-one' ),
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

		get_template_part( 'template-parts/widgets/widget', 'about-us', $instance );

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
			'title'        => [
				'label'      => 'Widget Title:',
				'input:type' => 'text',
				'name'       => $this->get_field_name( 'title' ),
				'attr'       => [
					'name'  => $this->get_field_name( 'title' ),
					'id'    => $this->get_field_id( 'title' ),
					'value' => isset( $instance['title'] ) ? $instance['title'] : 'About Us',
				],
			],
			'about'        => [
				'label'        => 'About You',
				'tag'          => 'textarea',
				'name'         => $this->get_field_name( 'about_us_text' ),
				'text_content' => isset( $instance['about_us_text'] ) ? $instance['about_us_text'] : '',
				'attr'         => [
					'name'        => $this->get_field_name( 'about_us_text' ),
					'id'          => $this->get_field_id( 'about_us_text' ),
					'placeholder' => 'Brief About Your Company/Organizations [25 Words]',
					'maxlength'   => 125,
					'rows'        => 2,
					'style'       => 'width:100%',
				],
			],
			'address'      => [
				'label'      => 'Address',
				'input:type' => 'text',
				'name'       => $this->get_field_name( 'address' ),
				'attr'       => [
					'name'        => $this->get_field_name( 'address' ),
					'id'          => $this->get_field_id( 'address' ),
					'value'       => isset( $instance['address'] ) ? $instance['address'] : '',
					'placeholder' => 'Your address goes here',
				],
			],
			'country_code' => [
				'label'      => 'Country Code',
				'input:type' => 'tel',
				'name'       => $this->get_field_name( 'country_code' ),
				'attr'       => [
					'name'        => $this->get_field_name( 'country_code' ),
					'id'          => $this->get_field_id( 'country_code' ),
					'value'       => isset( $instance['country_code'] ) ? $instance['country_code'] : get_option( 'country_code', '' ),
					'placeholder' => 'Country Code For Contact Number',
					'pattern'     => '^\d{1,3}$',
				],
			],
			'phone'        => [
				'label'      => 'Phone Number',
				'input:type' => 'tel',
				'name'       => $this->get_field_name( 'phone_number' ),
				'attr'       => [
					'name'        => $this->get_field_name( 'phone_number' ),
					'id'          => $this->get_field_id( 'phone_number' ),
					'value'       => isset( $instance['phone_number'] ) ? $instance['phone_number'] : get_option( 'contact_number', '' ),
					'placeholder' => 'Your phone/telephone number goes here',
					'pattern'     => '[6-9]{1}[0-9]{9}',
				],
			],
			'email'        => [
				'label'      => 'Email Address',
				'input:type' => 'Email',
				'name'       => $this->get_field_name( 'email' ),
				'attr'       => [
					'name'        => $this->get_field_name( 'email' ),
					'id'          => $this->get_field_id( 'email' ),
					'value'       => isset( $instance['email'] ) ? $instance['email'] : get_option( 'contact_email', '' ),
					'placeholder' => 'Your email goes here',
				],
			],

		];
		foreach ( $html_metas as $_ => $meta ) {
			$label = HTML::label_tag( $meta['label'], $meta['name'] );
			if ( isset( $meta['input:type'] ) ) {
				$input = HTML::input_tag(
					$meta['input:type'],
					isset( $meta['attr'] ) ? ( $meta['attr'] ) : []
				);
			} else {
				$input = HTML::custom_tag(
					$meta['tag'],
					$meta['text_content'],
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
		$instance                  = [];
		$instance['title']         = ( ! empty( $new_instance['title'] ) ) ? esc_html( $new_instance['title'] ) : '';
		$instance['about_us_text'] = ( ! empty( $new_instance['about_us_text'] ) ) ? esc_html( $new_instance['about_us_text'] ) : '';
		$instance['address']       = ( ! empty( $new_instance['address'] ) ) ? esc_html( $new_instance['address'] ) : '';
		$instance['country_code']  = ( ! empty( $new_instance['country_code'] ) ) ? esc_html( $new_instance['country_code'] ) : '';
		$instance['phone_number']  = ( ! empty( $new_instance['phone_number'] ) ) ? esc_html( $new_instance['phone_number'] ) : '';
		$instance['email']         = ( ! empty( $new_instance['email'] ) ) ? esc_html( $new_instance['email'] ) : '';
		return $instance;
	}
}


