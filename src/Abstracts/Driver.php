<?php
/**
 * Driver abstraction
 *
 * @package micropackage/internationalization
 */

namespace Micropackage\Cache\Abstracts;

use Micropackage\Cache\Interfaces\Cacheable;

/**
 * Driver abstraction
 */
abstract class Driver implements Cacheable {

	/**
	 * Cache key
	 *
	 * @since [Next]
	 * @var   string
	 */
	private $key;

	/**
	 * Sets cache value
	 *
	 * @since  [Next]
	 * @param  mixed $value Value to store.
	 * @return void
	 */
	abstract public function set( $value );

	/**
	 * Adds cache if it's not already set
	 *
	 * @since  [Next]
	 * @param  mixed $value Value to store.
	 * @return void
	 */
	abstract public function add( $value );

	/**
	 * Gets value from cache
	 *
	 * @since  [Next]
	 * @return mixed|false Cached value or false if not set
	 */
	abstract public function get();

	/**
	 * Deletes value from cache
	 *
	 * @since  [Next]
	 * @return void
	 */
	abstract public function delete();

	/**
	 * Gets the cache key
	 *
	 * @since  [Next]
	 * @return string
	 */
	public function get_key() {
		return $this->key;
	}

	/**
	 * Sets the cache key
	 *
	 * @since  [Next]
	 * @param  string $key Cache key.
	 * @return $this
	 */
	public function set_key( $key ) {
		$this->key = $key;
		return $this;
	}

}
