<?php
/**
 * ObjectCache driver
 *
 * @package micropackage/internationalization
 */

namespace Micropackage\Cache\Driver;

/**
 * ObjectCache driver
 */
class ObjectCache {

	use Traits\Expiration;

	/**
	 * Cache group
	 *
	 * @since [Next]
	 * @var   string
	 */
	protected $group = '';

	/**
	 * Constructor
	 *
	 * @since [Next]
	 * @param string $group      Cache group.
	 * @param int    $expiration Expiration in seconds, default: not expiring.
	 */
	public function __construct( $group = '', $expiration = 0 ) {
		$this->set_group( $group );
		$this->set_expiration( $expiration );
	}

	/**
	 * Gets the cache group
	 *
	 * @since  [Next]
	 * @return string
	 */
	public function get_group() {
		return $this->group;
	}

	/**
	 * Sets the cache group
	 *
	 * @since  [Next]
	 * @param  string $group Cache group.
	 * @return $this
	 */
	public function set_group( $group ) {
		$this->group = $group;
		return $this;
	}

	/**
	 * Sets cache value
	 *
	 * @since  [Next]
	 * @param  mixed $value Value to store.
	 * @return void
	 */
	public function set( $value ) {
		wp_cache_set( $this->get_key(), $value, $this->get_group() );
	}

	/**
	 * Adds cache if it's not already set
	 *
	 * @since  [Next]
	 * @param  mixed $value Value to store.
	 * @return void
	 */
	public function add( $value ) {
		wp_cache_add( $this->get_key(), $value, $this->get_group() );
	}

	/**
	 * Gets value from cache
	 *
	 * @since  [Next]
	 * @return mixed|false Cached value or false if not set
	 */
	public function get() {
		return wp_cache_get( $this->get_key(), $this->get_group() );
	}

	/**
	 * Gets value from cache and updates the local cache
	 * from persistent cache.
	 *
	 * @since  [Next]
	 * @return mixed|false Cached value or false if not set
	 */
	public function force_get() {
		return wp_cache_get( $this->get_key(), $this->get_group(), true );
	}

	/**
	 * Deletes value from cache
	 *
	 * @since  [Next]
	 * @return void
	 */
	public function delete() {
		wp_cache_delete( $this->get_key(), $this->get_group() );
	}

}
