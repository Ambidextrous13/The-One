<?php
/**
 * Trait file: Singleton.
 *
 * @package The-One
 * @author Janak Patel <pateljanak830@gmail.com>
 */

namespace THE_ONE\Inc\Traits;

trait Singleton {

	/**
	 * Prevents you to create multiple instances mistakenly.Use it like class::get-instance
	 *
	 * @return instance of a given class
	 */
	final public static function get_instance() {
		static $instance = [];
		$called_class    = get_called_class();
		if ( ! isset( $instance[ $called_class ] ) ) {
			$instance[ $called_class ] = new $called_class();
		}
		return $instance[ $called_class ];
	}
}


