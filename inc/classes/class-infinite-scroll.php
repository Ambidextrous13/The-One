<?php
/**
 * Class File: Infinite Scroll Manager.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

namespace THE_ONE\Inc\Classes;

use THE_ONE\Inc\Traits\Singleton;
use WP_Query;

/**
 * Infinite scroll handler.
 */
class Infinite_Scroll {
	use Singleton;

	/**
	 * Represents current pages number served to the front-end.
	 *
	 * @var integer
	 */
	private static $reading_page = 1;
	/**
	 * Represents current pages number served to the front-end.
	 *
	 * @var integer
	 */
	private static $posts_per_page = 3;
	/**
	 * Represents the maximum number of pages available to serve.
	 *
	 * @var integer
	 */
	private static $book_length = 1;
	/**
	 * Represents if last page of the total available pages has served?
	 *
	 * @var boolean
	 */
	private static $end_of_book = false;

	/**
	 * Class constructor, setups the hooks and class static variable
	 */
	private function __construct() {
		$this->setup_hooks();
		$this->book_length_setter();
	}

	/**
	 * Hook-ins the ajax handling methods.
	 *
	 * @return void
	 */
	private function setup_hooks() {
		add_action( 'wp_ajax_nopriv_infiscroll', [ $this, 'ajax_feeder' ] );
		add_action( 'wp_ajax_infiscroll', [ $this, 'ajax_feeder' ] );
	}

	/**
	 * `book_length` private varible setter method
	 *
	 * @return void
	 */
	private function book_length_setter() {
		$max_pages = wp_count_posts();
		if ( $max_pages ) {
			$ppp               = self::$posts_per_page;
			self::$book_length = intval( ceil( ( $max_pages->publish ) / $ppp ) );
		}
	}

	/**
	 * Setter function for `reading_page` (class private variable).
	 *
	 * @return void
	 */
	private function next_page() {
		// phpcs:ignore 
		self::$reading_page += 1; // because `+=1` is more readable here.
	}

	/**
	 * Resets the current served page to value 1
	 *
	 * @return void
	 */
	private function fresh_read() {
		self::$reading_page = 1;
	}

	/**
	 * Verifies and handles the incoming ajax requests. Calculates which page will be served next.
	 *
	 * @return void
	 */
	public function ajax_feeder() {
		$success = false;
		$data    = '';
		$page    = self::$reading_page;
		$is_end  = false;
		if ( ! check_ajax_referer( 'infinite_scroll_nonce', 'ajax_nonce', false ) ) {
			wp_send_json_error( __( 'Invalid security token.', 'the-one' ) );
			wp_die( '0', 400 );
		}

		$success = true;

		$page               = ! empty( $_POST['page'] ) ? filter_var( $_POST['page'], FILTER_VALIDATE_INT ) + 1 : 1;
		self::$reading_page = $page;

		if ( ! self::$end_of_book ) {

			$data = $this->give_feeds( self::$reading_page, false );

			if ( self::$reading_page === self::$book_length || false === $data ) {
				self::$end_of_book = true;
				$is_end            = true;
			}
			echo wp_json_encode(
				[
					'success' => $success,
					'data'    => $data,
					'page'    => $page,
					'isEnd'   => $is_end,
				]
			);
			wp_die();
		}
		$is_end = true;
		echo wp_json_encode(
			[
				'success' => $success,
				'data'    => $data,
				'page'    => $page,
				'isEnd'   => $is_end,
			]
		);
		wp_die();

	}

	/**
	 * Serves the post data of the given page number
	 *
	 * @param integer $page_no : page number of which posts to be served.
	 * @param boolean $echo : true, prints out the feed while false returns the string.
	 * @return void|string|boolean
	 */
	public function give_feeds( $page_no = 1, $echo = true ) {
		$index = 1;

		if ( 1 <= $page_no && self::$book_length >= $page_no ) {
			$index = $page_no;
		} else {
			if ( $echo ) {
				echo false;
			} else {
				return false;
			}
		}

		if ( self::$reading_page !== $index ) {
			self::$reading_page = $index;
		}

		$ppp = self::$posts_per_page;

		$args = [
			'post_type'      => 'post',
			'post_status'    => 'publish',
			'posts_per_page' => $ppp,
			'paged'          => $index,
		];

		$query = new WP_Query( $args );
		$data  = '';
		if ( $query->have_posts() ) {
			if ( ! $echo ) {
				suppress_the_echo();
			}
			while ( $query->have_posts() ) {
				$query->the_post();
				get_template_part( 'template-parts\posts\article' );
			}
			if ( self::$book_length > $index ) {
				echo '<div id="load-trigger"></div>';
			}
			wp_reset_postdata();
			if ( ! $echo ) {
				$data = echo_to_returnable();
				return $data;
			}
		}
	}
}

