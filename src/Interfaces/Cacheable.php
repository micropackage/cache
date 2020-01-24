<?php
/**
 * Cacheable interface
 * Implemented by Driver classes
 *
 * @package micropackage/internationalization
 */

namespace Micropackage\Cache\Interfaces;

/**
 * Cacheable interface
 */
interface Cacheable {

	/**
	 * Sets cache value
	 *
	 * @since  [Next]
	 * @param  mixed $value Value to store.
	 * @return void
	 */
	public function set( $value );

	/**
	 * Adds cache if it's not already set
	 *
	 * @since  [Next]
	 * @param  mixed $value Value to store.
	 * @return void
	 */
	public function add( $value );

	/**
	 * Gets value from cache
	 *
	 * @since  [Next]
	 * @return mixed|false Cached value or false if not set
	 */
	public function get();

	/**
	 * Deletes value from cache
	 *
	 * @since  [Next]
	 * @return void
	 */
	public function delete();

}
