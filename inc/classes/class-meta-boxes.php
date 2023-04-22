<?php
/**
 * Class File: Meta boxes handler.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

namespace THE_ONE\Inc\Classes;

use THE_ONE\Inc\Traits\Singleton;

/**
 * Meta boxes handler class.
 */
class Meta_Boxes {
	use Singleton;

	/**
	 * Redirects to the hook-in functionality.
	 */
	private function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Hooks-in the functionality of meta-boxes registration and data saving.
	 *
	 * @return void
	 */
	private function setup_hooks() {
		add_action( 'add_meta_boxes', [ $this, 'the_one_meta_boxes' ] );
		add_action( 'save_post', [ $this, 'save_meta_data' ] );
	}

	/**
	 * Meta-boxes registrar.
	 *
	 * @return void
	 */
	public function the_one_meta_boxes() {
		$screens = [ 'post' ];
		foreach ( $screens as $screen ) {
			add_meta_box( 'border_post_at_posts', 'Image Border', [ $this, 'border_it_html' ], $screen, 'side' );
			add_meta_box( 'pin_post_for_notice', 'Pin Options', [ $this, 'pin_to_notice' ], $screen, 'side' );
		}
	}

	/**
	 * Appends the HTML code to border given post if applicable.
	 *
	 * @param  object $post : post object.
	 * @return void
	 */
	public function border_it_html( $post ) {
		$keys        = [ 'checkbox', 'thickness', 'color', 'padding', 'pattern' ];
		$stored_data = [];
		foreach ( $keys as $key ) {
			$stored_data[ $key ] = get_post_meta( $post->ID, 't-o-p-b-' . $key, true );
		}
		wp_nonce_field( 'saving_values_of_post_border_form', 'nonce_for_post_border_form' );

		get_template_part( 'template-parts/meta-boxes/meta-box', 'border-it', $stored_data );
	}

	/**
	 * Checks and pins the post on notice board widget.
	 *
	 * @param object $post : post object.
	 * @return void
	 */
	public function pin_to_notice( $post ) {
		$is_pinned = get_post_meta( $post->ID, 't-o-pinned', true );
		wp_nonce_field( 'saving_values_of_pin_to_notice_form', 'nonce_for_pin_to_notice_form' );
		get_template_part( 'template-parts/meta-boxes/meta-box', 'pin-it', [ 'is_pinned' => $is_pinned ] );
	}

	/**
	 * Saves the meta boxes' data into the database.
	 *
	 * @param int $post_id : post id of which meta boxes' data get stored.
	 * @return void
	 */
	public function save_meta_data( $post_id ) {
		// phpcs:ignore
		if ( ! isset( $_POST['nonce_for_post_border_form'] ) || ! wp_verify_nonce( $_POST['nonce_for_post_border_form'], 'saving_values_of_post_border_form' ) ) {
		} else {
			$keys = [ 't-o-p-b-checkbox', 't-o-p-b-thickness', 't-o-p-b-color', 't-o-p-b-padding', 't-o-p-b-pattern' ];
			foreach ( $keys as $key ) {
				if ( isset( $_POST[ $key ] ) ) {
					update_post_meta( $post_id, $key, $_POST[ $key ] );
				} else {
					update_post_meta( $post_id, $key, 0 );
				}
			}
		}
		// phpcs:ignore
		if ( ! isset( $_POST['nonce_for_pin_to_notice_form'] ) || ! wp_verify_nonce( $_POST['nonce_for_pin_to_notice_form'], 'saving_values_of_pin_to_notice_form' ) ) {
		} else {
			if ( isset( $_POST['t-o-pinned'] ) ) {
				update_post_meta( $post_id, 't-o-pinned', $_POST['t-o-pinned'] );
			} else {
				update_post_meta( $post_id, 't-o-pinned', 0 );
			}
		}
	}
}


