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
	 * Gives the one step minimized menu of given meu location.
	 *
	 * @param string $menu_location .
	 * @return string|false
	 */
	public function get_one_step_minimized_menu( $menu_location ) {

		$menu_id = $this->menu_id( $menu_location );
		$menu    = wp_get_nav_menu_items( $menu_id );
		$hashmap = [];
		if ( ! empty( $menu ) && is_array( $menu ) ) {
			$reduced_menu = [];
			foreach ( $menu as $_ => $element ) {
				$key        = $element->ID;
				$parent_key = intval( $element->menu_item_parent );
				$value      = [
					'title'      => $element->title,
					'url'        => $element->url,
					'has_parent' => $parent_key ? $parent_key : false,
					'children'   => [],
				];

				if ( 0 !== $parent_key ) {
					$parent_address = $hashmap[ $parent_key ];
					$own_address    = $hashmap[ $parent_key ];
					array_push( $own_address, $key );
					$hashmap[ $key ] = $own_address;

					$children = & $reduced_menu;
					$depth    = count( $parent_address );
					for ( $pointer = 0; $pointer < $depth; $pointer++ ) {
						$children = & $children[ $parent_address[ $pointer ] ]['children'];
					}
					$children[ $key ] = $value;
				} else {
					$hashmap              = [];
					$hashmap[ $key ]      = [ $key ];
					$reduced_menu[ $key ] = $value;
				} // if parents exist check.
			} // foreach menu end.
			return $reduced_menu;
		}
		return false;
	}
}
