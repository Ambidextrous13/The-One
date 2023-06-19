<?php
/**
 * Class File: Block Pattern Manager.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

namespace THE_ONE\Inc\Classes;

use THE_ONE\Inc\Traits\Singleton;
/**
 * Handles the block patterns.
 */
class Block_Pattern {
	use Singleton;

	/**
	 * Block pattern initializer.
	 */
	private function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Hooks in the block patterns.
	 *
	 * @return void
	 */
	private function setup_hooks() {
		add_action( 'init', [ $this, 'registrar' ] );
	}

	/**
	 * Registers the block pattern
	 *
	 * @return void
	 */
	public function registrar() {

		$register = [
			'about-us-pattern'      => [
				'title'       => __( 'About Us', 'the-one' ),
				'description' => __( 'Brief about your company or business. Contact information and address', 'the-one' ),
				'content'     => the_one_template_part( 'template-parts\block-patterns\about-us' ),
				'categories'  => 'footer-stuff',
			],

			'recent-posts-pattern'  => [
				'title'       => __( 'Recent Posts', 'the-one' ),
				'description' => __( 'Shows recent posts', 'the-one' ),
				'content'     => the_one_template_part( 'template-parts\block-patterns\recent-posts' ),
				'categories'  => 'footer-stuff',
			],

			'twitter-feeds-pattern' => [
				'title'       => __( 'Twitter Feeds', 'the-one' ),
				'description' => __( 'Your twitter feed', 'the-one' ),
				'content'     => the_one_template_part( 'template-parts\block-patterns\twitter-feeds' ),
				'categories'  => 'footer-stuff',
			],

			'gallery-pattern'       => [
				'title'       => __( 'Gallery', 'the-one' ),
				'description' => __( '3x3 photos gallery', 'the-one' ),
				'content'     => the_one_template_part( 'template-parts\block-patterns\gallery' ),
				'categories'  => 'footer-stuff',
			],

		];

		foreach ( $register as $index => $entry ) {
			register_block_pattern( $index, $entry );
		};
	}
}


