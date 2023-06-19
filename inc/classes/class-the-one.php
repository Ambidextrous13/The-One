<?php
/**
 * Class File: Classes handler for the theme The-One.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

namespace THE_ONE\Inc\Classes;

use THE_ONE\Inc\Traits\Singleton;

/**
 * Class handler class.( like 'cap' in 'MCU' )
 */
class THE_ONE {

	use Singleton;

	/**
	 * Aggregates the instances of all the theme classes and initiates them simultaneously.
	 */
	private function __construct() {
		$this->setup_hooks();

		Assets::get_instance();
		Sidebars::get_instance();
		Menus::get_instance();
		Meta_Boxes::get_instance();
		Block_Pattern::get_instance();
		Infinite_Scroll::get_instance();
		Settings::get_instance();

	}

	/**
	 * Hook-ins the theme setup functionalities.
	 *
	 * @return void
	 */
	private function setup_hooks() {
		add_action( 'after_setup_theme', [ $this, 'theme_supports' ] );
		add_action( 'after_setup_theme', [ $this, 'registrar' ] );

		add_filter( 'excerpt_more', [ $this, 'no_excerpt' ] );
	}

	/**
	 * Defines the supports provided by the theme.
	 *
	 * @return void
	 */
	public function theme_supports() {
		add_theme_support( 'title-tag' );

		add_theme_support(
			'custom-logo',
			[
				'header-text' => [
					'site-title',
					'site-description',
				],
				'height'      => 100,
				'width'       => 400,
				'flex-height' => true,
				'flex-width'  => true,
			]
		);

		add_theme_support( 'post-thumbnails' );

		add_theme_support( 'customize-selective-refresh-widgets' );

		add_theme_support( 'automatic-feed-links' );

		add_theme_support(
			'html5',
			[
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			]
		);

		add_theme_support( 'wp-block-styles' );

		add_theme_support( 'align-wide' );

		add_theme_support( 'responsive-embeds' );

		add_theme_support( 'title-tag' );

		$args = array(
			'default-color' => 'rgba(255,255,255,0)',
		);
		add_theme_support( 'custom-background', $args );

		$defaults = array(
			'flex-width'  => true,
			'width'       => 1900,
			'flex-height' => true,
			'height'      => 200,
		);
		add_theme_support( 'custom-header', $defaults );

	}

	/**
	 * Main registrar of the theme variable like Image size, etc.
	 *
	 * @return void
	 */
	public function registrar() {
		add_image_size( 'the-one-indexing-size', 630, 320, true );
	}

	/**
	 * Returns the excerpt end symbol string of the post.
	 *
	 * @param string $more .
	 * @return string new excerpt read more symbol.
	 */
	public function no_excerpt( $more ) {
		return '...';
	}
}


