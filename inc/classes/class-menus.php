<?php
/**
 * Class File: Menus handler.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

namespace THE_ONE\Inc\Classes;

use THE_ONE\Inc\Traits\Singleton;

/**
 * Menus handling class
 */
class Menus {
	use Singleton;

	/**
	 * Class constructor.
	 */
	private function __construct() {
		$this->setup_hooks();
	}

	/**
	 * Hooks-in the functions for menus registration.
	 *
	 * @return void
	 */
	private function setup_hooks() {
		add_action( 'init', [ $this, 'register_menus' ] );
	}

	/**
	 * Menus registration handler.
	 *
	 * @return void
	 */
	public function register_menus() {
		register_nav_menus(
			[
				'the-one-header-menu' => __( 'Header Menu', 'the-one' ),
			]
		);
	}

	/**
	 * Returns the id of the menu which location is passed as argument.
	 *
	 * @param string $location : location of menu.
	 * @return int menu id.
	 */
	public function menu_id( $location ) {

		$menu_id = $this->have_menus() ? get_nav_menu_locations()[ $location ] : null;
		return ( ! empty( $menu_id ) ) ? $menu_id : '';
	}

		/**
		 * Checks if admin has registered any menu or not.
		 *
		 * @return boolean
		 */
	public function have_menus() {
		if ( ! empty( get_nav_menu_locations() ) ) {
			return true;
		}
		return false;
	}

	/**
	 * Gives the one step minimised menu of given meu location.
	 *
	 * @param string $menu_location .
	 * @return string|false
	 */
	public function get_one_step_minimized_menu( $menu_location ) {

		$menu_id = $this->menu_id( $menu_location );
		$menu    = wp_get_nav_menu_items( $menu_id );

		if ( ! empty( $menu ) && is_array( $menu ) ) {
			$reduced_menu = [];
			foreach ( $menu as $_ => $element ) {
				$key   = $element->ID;
				$value = [
					'has_child' => isset( $reduced_menu[ $key ]['has_child'] ) ? true : false,
					'title'     => $element->title,
					'url'       => $element->url,
				];

				$parent_key = intval( $element->menu_item_parent );

				if ( 0 !== $parent_key ) {
					$reduced_menu[ $parent_key ]['has_child']        = true;
					$reduced_menu[ $parent_key ]['children'][ $key ] = $value;

				} else {
					$reduced_menu[ $key ] = $value;
				}
			}
			return $reduced_menu;
		}
		return false;
	}
}

