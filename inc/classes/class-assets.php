<?php
/**
 * Class File: Assets manager.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

namespace THE_ONE\Inc\Classes;

use THE_ONE\Inc\Traits\Singleton;
/**
 * Loads the assets and localized the data
 */
class Assets {
	use Singleton;

	/**
	 * Initialize the assets class
	 */
	private function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Hooks in the asset loading functions
	 *
	 * @return void
	 */
	private function setup_hooks() {
		add_action( 'wp_enqueue_scripts', [ $this, 'load_scripts' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'scripts_for_admin' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'localize_script' ] );
	}

	/**
	 * Adds necessary JS files and Stylesheets files.
	 *
	 * @return void
	 */
	public function load_scripts() {
		// JS file enqueuing.
		wp_register_script( 'the-one-js', THE_ONE_JS . 'generic.js', [ 'jquery' ], filemtime( ABS_THE_ONE_JS . 'generic.js' ), true );
		// Enrolling.
		wp_enqueue_script( 'the-one-js' );

		// CSS file enqueuing.
		wp_register_style( 'the-one-css', THE_ONE_CSS . 'css.css', [], filemtime( ABS_THE_ONE_CSS . 'css.css' ), 'all' );
		// Enrolling.
		wp_enqueue_style( 'the-one-css' );
	}

	/**
	 * Loads scripts and CSS for admin panels.
	 *
	 * @return void
	 */
	public function scripts_for_admin() {
		// JS file enqueuing.
		wp_register_script( 'the-one-admin-js', THE_ONE_JS . 'admin.js', [], filemtime( ABS_THE_ONE_JS . 'admin.js' ), true );
		// Enrolling.
		wp_enqueue_script( 'the-one-admin-js' );

		// CSS file enqueuing.
		wp_register_style( 'the-one-css', THE_ONE_CSS . 'css.css', [], filemtime( ABS_THE_ONE_CSS . 'css.css' ), 'all' );
		// Enrolling.
		wp_enqueue_style( 'the-one-css' );
	}

	/**
	 * Transfers the data from PHP to JS.
	 *
	 * @return void
	 */
	public function localize_script() {
		wp_localize_script(
			'the-one-js',
			'siteConfig',
			[
				'ajax_url'   => admin_url( 'admin-ajax.php' ),
				'ajax_nonce' => wp_create_nonce( 'infinite_scroll_nonce' ),
			]
		);
	}
}

