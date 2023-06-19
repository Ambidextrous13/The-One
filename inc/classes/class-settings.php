<?php
/**
 * Class File: Theme Settings (Admin Preferences).
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

namespace THE_ONE\Inc\Classes;

use THE_ONE\Inc\Traits\Singleton;
use THE_ONE\Inc\Classes\HTML;

/**
 * Theme's setting handler
 */
class Settings {
	use Singleton;

	/**
	 * Keep track of number of social media actives.
	 *
	 * @var integer
	 */
	public static $footer_social_media_count = 0;

	/**
	 * Redirects to the hook-in functionality.
	 */
	private function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Hooks-in the functionalities which creates a preferences page and its setups.
	 *
	 * @return void
	 */
	private function setup_hooks() {
		add_action( 'admin_menu', [ $this, 'show_settings_page' ] );
		add_action( 'admin_init', [ $this, 'settings_builder' ] );
	}

	/**
	 * Makes settings page visible in admin panel.
	 *
	 * @return void
	 */
	public function show_settings_page() {
		add_theme_page( 'The One Settings', 'Theme Settings', 'edit_theme_options', 'the_one_settings', [ $this, 'page_loader' ], 5 );
	}

	/**
	 * Loads the content of the setting page.
	 *
	 * @return void
	 */
	public static function page_loader() {
		// front end.
		the_one_suppress_the_echo();

		settings_fields( 'settings' ) .
		do_settings_sections( 'the_one_settings' ) . // append all setting between settings_fields and submit_button.

		submit_button();

		$form_elements = the_one_echo_to_returnable();
		// phpcs:ignore
		echo HTML::div_tag(
			HTML::heading_tag( '1', 'The One Theme Settings', [], false ) .
					HTML::form_tag(
						$form_elements,
						'POST',
						'options.php'
					),
			true
		);
	}

	/**
	 * Fires the functions to do back-end registration and front-end html arrangements on settings page.
	 *
	 * @return void
	 */
	public function settings_builder() {
		// first time registration.
		self::back_end_register();
		// registers section of the page.
		self::sections_registration( $this );
		// registers fields inside the sections.
		self::fields_registration( $this );
		self::settings_registration();

	}

	/**
	 * Creates backend settings options.
	 *
	 * @return void
	 */
	public static function back_end_register() {

		add_option( 'the_one_infinite_scroll', 0 );

		add_option( 'company_address', '' );
		add_option( 'country_code', '' );
		add_option( 'contact_number', '' );
		add_option( 'contact_email', '' );

		add_option( 'social_media_facebook_check', '' );
		add_option( 'social_media_twitter_check', '' );
		add_option( 'social_media_instagram_check', '' );
		add_option( 'social_media_skype_check', '' );
		add_option( 'social_media_linkedin_check', '' );
		add_option( 'the_one_copyright_text_check', '' );

		add_option( 'share_copy_link_check', '' );
		add_option( 'share_facebook_check', '' );
		add_option( 'share_twitter_check', '' );
		add_option( 'share_google+_check', '' );
		add_option( 'share_pinterest_check', '' );
		add_option( 'share_linkedin_check', '' );
		add_option( 'share_buffer_check', '' );
		add_option( 'share_tumblr_check', '' );
		add_option( 'share_reddit_check', '' );
		add_option( 'share_stumble_upon_check', '' );
		add_option( 'share_delicious_check', '' );
		add_option( 'share_evernote_check', '' );
		add_option( 'share_email_check', '' );
		add_option( 'share_wordpress_check', '' );
		add_option( 'share_pocket_check', '' );

		add_option( 'social_media_facebook', 'https://www.facebook.com/' );
		add_option( 'social_media_twitter', 'https://www.twitter.com/' );
		add_option( 'social_media_instagram', 'https://www.instagram.com/' );
		add_option( 'social_media_skype', 'https://www.skype.com/' );
		add_option( 'social_media_linkedin', 'https://www.linkedin.com/' );
		add_option( 'the_one_copyright_text', 'Copyright 2023 The One' );

	}

	/**
	 * Registers the section at front-end.
	 *
	 * @param instance $instance : instance of class `settings`.
	 * @return void
	 */
	public static function sections_registration( $instance ) {
		add_settings_section( 'general_settings', 'General Settings', [ $instance, 'null_return_fxn' ], 'the_one_settings' );
		add_settings_section( 'social_media_handles', 'Social Media', [ $instance, 'null_return_fxn' ], 'the_one_settings' );
		add_settings_section( 'share_options', 'Share Buttons', [ $instance, 'null_return_fxn' ], 'the_one_settings' );

	}

	/**
	 * Registers the settings fields contains individual setting options.
	 *
	 * @param instance $instance : instance of class `settings`.
	 * @return void
	 */
	public static function fields_registration( $instance ) {

		add_settings_field( 'infinite_scroll', 'Infinite Scroll', [ $instance, 'infiscroll_html' ], 'the_one_settings', 'general_settings', [ 'class' => 'infinite_scroll' ] );
		add_settings_field( 'e_mail', 'Contact Email', [ $instance, 'public_email_html' ], 'the_one_settings', 'general_settings', [ 'class' => 'e_mail' ] );
		add_settings_field( 'contact_number', 'Contact Number', [ $instance, 'public_number_html' ], 'the_one_settings', 'general_settings', [ 'class' => 'contact_number' ] );
		add_settings_field( 'address_field', 'Company Address', [ $instance, 'public_address_html' ], 'the_one_settings', 'general_settings', [ 'class' => 'address_field' ] );

		add_settings_field( 'share_to_copy_link', 'Copy Link', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_copy_link_check' ] );
		add_settings_field( 'share_to_facebook', 'Facebook', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_facebook_check' ] );
		add_settings_field( 'share_to_twitter', 'Twitter', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_twitter_check' ] );
		add_settings_field( 'share_to_google+', 'Google Plus', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_google+_check' ] );
		add_settings_field( 'share_to_pinterest', 'Pinterest', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_pinterest_check' ] );
		add_settings_field( 'share_to_linkedin', 'Linkedin', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_linkedin_check' ] );
		add_settings_field( 'share_to_buffer', 'Buffer', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_buffer_check' ] );
		add_settings_field( 'share_to_tumblr', 'Tumblr', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_tumblr_check' ] );
		add_settings_field( 'share_to_reddit', 'Reddit', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_reddit_check' ] );
		add_settings_field( 'share_to_stumble_upon', 'StumbleUpon', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_stumble_upon_check' ] );
		add_settings_field( 'share_to_delicious', 'Delicious', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_delicious_check' ] );
		add_settings_field( 'share_to_evernote', 'Evernote', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_evernote_check' ] );
		add_settings_field( 'share_to_email', 'Email', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_email_check' ] );
		add_settings_field( 'share_to_wordpress', 'WordPress', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_wordpress_check' ] );
		add_settings_field( 'share_to_pocket', 'Pocket', [ $instance, 'share_button_html' ], 'the_one_settings', 'share_options', [ 'key' => 'share_pocket_check' ] );

		add_settings_field(
			'social_media_facebook',
			'Facebook Handle',
			[ $instance, 'conditional_input' ],
			'the_one_settings',
			'social_media_handles',
			[
				'class' => 'social_media_facebook',
				'key'   => 'facebook',
			]
		);
		add_settings_field(
			'social_media_twitter',
			'Twitter Handle',
			[ $instance, 'conditional_input' ],
			'the_one_settings',
			'social_media_handles',
			[
				'class' => 'social_media_twitter',
				'key'   => 'twitter',
			]
		);
		add_settings_field(
			'social_media_instagram',
			'instagram Link',
			[ $instance, 'conditional_input' ],
			'the_one_settings',
			'social_media_handles',
			[
				'class' => 'social_media_instagram',
				'key'   => 'instagram',
			]
		);
		add_settings_field(
			'social_media_skype',
			'Skype Link',
			[ $instance, 'conditional_input' ],
			'the_one_settings',
			'social_media_handles',
			[
				'class' => 'social_media_skype',
				'key'   => 'skype',
			]
		);
		add_settings_field(
			'social_media_linkedin',
			'linkedin Link',
			[ $instance, 'conditional_input' ],
			'the_one_settings',
			'social_media_handles',
			[
				'class' => 'social_media_linkedin',
				'key'   => 'linkedin',
			]
		);
		add_settings_field(
			'copyright_text',
			'Copyright Text',
			[ $instance, 'copyright_input' ],
			'the_one_settings',
			'social_media_handles',
			[
				'class' => 'copyright_text',
				'key'   => 'the_one_copyright_text',
			]
		);

	}

	/**
	 * Registers the data to its respective option group.
	 *
	 * @return void
	 */
	public static function settings_registration() {
		register_setting( 'settings', 'the_one_infinite_scroll' );
		register_setting( 'settings', 'contact_email' );
		register_setting( 'settings', 'country_code' );
		register_setting( 'settings', 'contact_number' );
		register_setting( 'settings', 'company_address' );

		register_setting( 'settings', 'social_media_facebook' );
		register_setting( 'settings', 'social_media_twitter' );
		register_setting( 'settings', 'social_media_instagram' );
		register_setting( 'settings', 'social_media_skype' );
		register_setting( 'settings', 'social_media_linkedin' );
		register_setting( 'settings', 'the_one_copyright_text' );

		register_setting( 'settings', 'social_media_facebook_check' );
		register_setting( 'settings', 'social_media_twitter_check' );
		register_setting( 'settings', 'social_media_instagram_check' );
		register_setting( 'settings', 'social_media_skype_check' );
		register_setting( 'settings', 'social_media_linkedin_check' );
		register_setting( 'settings', 'the_one_copyright_text_check' );

		register_setting( 'settings', 'share_copy_link_check' );
		register_setting( 'settings', 'share_facebook_check' );
		register_setting( 'settings', 'share_twitter_check' );
		register_setting( 'settings', 'share_google+_check' );
		register_setting( 'settings', 'share_pinterest_check' );
		register_setting( 'settings', 'share_linkedin_check' );
		register_setting( 'settings', 'share_buffer_check' );
		register_setting( 'settings', 'share_tumblr_check' );
		register_setting( 'settings', 'share_reddit_check' );
		register_setting( 'settings', 'share_stumble_upon_check' );
		register_setting( 'settings', 'share_delicious_check' );
		register_setting( 'settings', 'share_evernote_check' );
		register_setting( 'settings', 'share_email_check' );
		register_setting( 'settings', 'share_wordpress_check' );
		register_setting( 'settings', 'share_pocket_check' );

	}

	/**
	 * Returns null that's all.
	 *
	 * @return null
	 */
	public function null_return_fxn() {
		// section html.
		return null;
	}

	/**
	 * HTML for setting field (infinite scroll).
	 *
	 * @return void
	 */
	public function infiscroll_html() {
		// filed html.
		$the_key           = 'the_one_infinite_scroll';
		$option_value      = get_option( $the_key );
		$args_for_checkbox = [
			'class'      => 'fields',
			'name'       => $the_key,
			'id'         => $the_key,
			'attributes' => [
				checked( 'on', $option_value, false ),
			],
		];

		if ( false !== $option_value ) {
			// phpcs:ignore
			echo HTML::div_tag(
				HTML::label_tag( 'Infinite Scroll Mode?', $the_key ) .
						HTML::input_tag( 'checkbox', $args_for_checkbox ),
				true,
				[ 'style' => 'max-width: 700px; display: flex; justify-content: space-between' ]
			);
		} else {
			echo 'error please contact the developer';
		}
	}

	/**
	 * HTML for setting field (email).
	 *
	 * @return void
	 */
	public function public_email_html() {
		// filed html.
		$the_key        = 'contact_email';
		$option_value   = get_option( $the_key );
		$args_for_email = [
			'class' => 'fields',
			'name'  => $the_key,
			'id'    => $the_key,
			'value' => $option_value,
			'style' => 'width: 450px; max-width: 300px; display: flex; justify-content: space-between',
		];

		if ( false !== $option_value ) {
			// phpcs:ignore
			echo HTML::div_tag(
				HTML::label_tag( 'Public Email Address', $the_key ) .
						HTML::input_tag( 'email', $args_for_email ),
				true,
				[ 'style' => 'max-width: 700px; display: flex; justify-content: space-between' ]
			);
		} else {
			echo 'error please contact the developer';
		}
	}

	/**
	 * HTML for setting field ( mobile number field )
	 *
	 * @return void
	 */
	public function public_number_html() {
		// filed html.
		$the_key_0      = 'country_code';
		$the_key_1      = 'contact_number';
		$option_value_0 = get_option( $the_key_0 );
		$option_value_1 = get_option( $the_key_1 );

		$args_for_country_code = [
			'class'   => 'fields',
			'name'    => $the_key_0,
			'id'      => $the_key_0,
			'value'   => $option_value_0,
			'pattern' => '^\d{1,3}$',
			'style'   => 'width : 50px',
		];

		$args_for_number = [
			'class'   => 'fields',
			'name'    => $the_key_1,
			'id'      => $the_key_1,
			'value'   => $option_value_1,
			'pattern' => '[6-9]{1}[0-9]{9}',
			'style'   => 'width : 250px',
		];

		// phpcs:ignore
		echo HTML::div_tag(
			HTML::label_tag( 'Contact Number(Numbers Only)', $the_key_1 ) .
					html::div_tag(
						html::div_tag(
							HTML::span_tag( '+' ) .
							html::input_tag( 'tel', $args_for_country_code ),
							true
						) .
						HTML::input_tag( 'tel', $args_for_number ),
						true,
						[ 'style' => 'display: flex; justify-content: space-between' ]
					),
			true,
			[ 'style' => 'max-width: 700px; display: flex; justify-content: space-between' ]
		);
	}

	/**
	 * HTML for setting field (Address of the company)
	 *
	 * @return void
	 */
	public function public_address_html() {
		// filed html.
		$the_key        = 'company_address';
		$option_value   = get_option( $the_key );
		$args_for_email = [
			'class' => 'fields',
			'name'  => $the_key,
			'id'    => $the_key,
			'value' => $option_value,
			'style' => 'width: 450px; max-width: 300px; display: flex; justify-content: space-between',
		];

		if ( false !== $option_value ) {
			// phpcs:ignore
			echo HTML::div_tag(
				HTML::label_tag( 'Public Email Address', $the_key ) .
						HTML::input_tag( 'text', $args_for_email ),
				true,
				[ 'style' => 'max-width: 700px; display: flex; justify-content: space-between' ]
			);
		} else {
			echo 'error please contact the developer';
		}
	}

	/**
	 * Generic HTML for setting fields (textfield).
	 *
	 * @param string $the_key : key with which option is stored in option table. for example for infinite scroll it is `the_one_infinite_scroll`.
	 * @param string $label : label of the setting.
	 * @return void
	 */
	public function text_input( $the_key, $label ) {
		$option_value   = get_option( $the_key );
		$args_for_field = [
			'class' => 'fields',
			'name'  => $the_key,
			'id'    => $the_key,
			'value' => $option_value,
			'style' => 'width: 450px; max-width: 300px; display: flex; justify-content: space-between',
		];

		if ( false !== $option_value ) {
			//phpcs:ignore
			echo HTML::div_tag(
				HTML::label_tag( $label, $the_key ) .
						HTML::input_tag( 'text', $args_for_field ),
				true,
				[ 'style' => 'max-width: 700px; display: flex; justify-content: space-between' ]
			);
		} else {
			echo 'error please contact the developer';
		}
	}

	/**
	 * Generic HTML for setting fields (label, checkbox & visibility controlled textbox).
	 *
	 * @param string $the_key : key with which option is stored in option table. for example for infinite scroll it is `the_one_infinite_scroll`.
	 * @param string $checkbox_key : key with which checkbox option is stored in option table.
	 * @param string $label : label of setting.
	 * @param string $controls : id of the html tag to whose visibility is controlled by the checkbox. means ticking checkbox make that HTML entity visible else hidden.
	 * @return void
	 */
	public function text_input_with_select( $the_key, $checkbox_key, $label, $controls ) {
		$field_value    = get_option( $the_key );
		$args_for_field = [
			'class' => 'fields',
			'name'  => $the_key,
			'id'    => $the_key,
			'value' => $field_value,
			'style' => 'width: 450px; max-width: 300px; display: flex; justify-content: space-between',
		];

		$checkbox_value    = get_option( $checkbox_key );
		$args_for_checkbox = [
			'class'      => 'fields',
			'name'       => $checkbox_key,
			'id'         => $checkbox_key,
			'attributes' => [
				checked( 'on', $checkbox_value, false ),
			],
			'controls'   => $controls,
		];

		$div_args = [
			'id'    => $controls,
			'style' => 'width: 600px; display: flex; justify-content: space-between',
		];

		if ( false !== $field_value && false !== $checkbox_value ) {
			//phpcs:ignore
			echo HTML::div_tag(
				HTML::input_tag( 'checkbox', $args_for_checkbox ) .
						HTML::div_tag(
							HTML::label_tag( $label, $the_key ) .
							HTML::input_tag( 'text', $args_for_field ),
							true,
							$div_args
						),
				true,
				[ 'style' => 'max-width: 700px; display: flex; justify-content: space-between; align-items: center; height: 30px' ]
			);
		} else {
			esc_html_e( 'error please contact the developer', 'the-one' );
		}
	}

	/**
	 * Generic HTML for setting fields (social media).
	 *
	 * @param array $args : array of following key value pair.
	 *     [
				'class' => 'social_media_facebook',
				'key'   => 'facebook',
			].
	 * @return void
	 */
	public function conditional_input( $args ) {
		$field_key    = 'social_media_' . $args['key'];
		$checkbox_key = $field_key . '_check';
		$label        = 'Enter the link of your ' . $args['key'] . ' page/account here';
		$controls     = $args['key'] . '_links';
		$this->text_input_with_select( $field_key, $checkbox_key, $label, $controls );
	}

	/**
	 * Generic HTML for setting fields (copyright textfield).
	 *
	 * @return void
	 */
	public function copyright_input() {
		$this->text_input_with_select( 'the_one_copyright_text', 'the_one_copyright_text_check', 'Copyright Text(Appears at bottom of the footer)', 'copyright_text' );
	}

	/**
	 * Generic HTML for setting fields (share button).
	 *
	 * @param array $args : array of following key value pair: [ 'key' => 'share_pinterest_check' ].
	 * @return void
	 */
	public function share_button_html( $args ) {
		$the_key           = $args['key'];
		$option_value      = get_option( $the_key );
		$args_for_checkbox = [
			'class'      => 'fields',
			'name'       => $the_key,
			'id'         => $the_key,
			'attributes' => [
				checked( 'on', $option_value, false ),
			],
		];

		if ( false !== $option_value ) {
			//phpcs:ignore
			echo HTML::div_tag(
				HTML::input_tag( 'checkbox', $args_for_checkbox ),
				true,
				[ 'style' => 'max-width: 700px; display: flex; justify-content: space-between' ]
			);
		} else {
			echo 'error please contact the developer';
		}
	}

	/**
	 * Gives an array containing status social media in terms of whether the active or not.
	 *
	 * @return array
	 */
	public static function give_selected_social_media_handles() {
		$social_links = [
			'facebook'  => [
				'enable' => get_option( 'social_media_facebook_check' ),
				'value'  => get_option( 'social_media_facebook' ),
			],
			'twitter'   => [
				'enable' => get_option( 'social_media_twitter_check' ),
				'value'  => get_option( 'social_media_twitter' ),
			],
			'instagram' => [
				'enable' => get_option( 'social_media_instagram_check' ),
				'value'  => get_option( 'social_media_instagram' ),
			],
			'skype'     => [
				'enable' => get_option( 'social_media_skype_check' ),
				'value'  => get_option( 'social_media_skype' ),
			],
			'linkedin'  => [
				'enable' => get_option( 'social_media_linkedin_check' ),
				'value'  => get_option( 'social_media_linkedin' ),
			],
		];
		$returnable   = [];
		foreach ( $social_links as $meta => $data ) {
			if ( the_one_get_the_value( $data, 'enable', false ) && the_one_get_the_value( $data, 'value', false ) ) {
				$local_array = [
					'class' => $meta,
					'link'  => $data['value'],
					'title' => $meta,
					'icon'  => 'fa fa-' . $meta,
				];
				array_push( $returnable, $local_array );
			}
		}
		self::$footer_social_media_count = count( $returnable );
		return $returnable;

	}

	/**
	 * Returns the share buttons status whether as form of array status in terms of whether they are active or not.
	 *
	 * @return array
	 */
	public static function give_selected_share_options() {
		return [
			'copy_link'    => get_option( 'share_copy_link_check' ),
			'facebook'     => get_option( 'share_facebook_check' ),
			'twitter'      => get_option( 'share_twitter_check' ),
			'google_plus'  => get_option( 'share_google+_check' ),
			'pinterest'    => get_option( 'share_pinterest_check' ),
			'linkedin'     => get_option( 'share_linkedin_check' ),
			'buffer'       => get_option( 'share_buffer_check' ),
			'tumblr'       => get_option( 'share_tumblr_check' ),
			'reddit'       => get_option( 'share_reddit_check' ),
			'stumble_upon' => get_option( 'share_stumble_upon_check' ),
			'delicious'    => get_option( 'share_delicious_check' ),
			'evernote'     => get_option( 'share_evernote_check' ),
			'email'        => get_option( 'share_email_check' ),
			'wordpress'    => get_option( 'share_wordpress_check' ),
			'pocket'       => get_option( 'share_pocket_check' ),
		];
	}
}
