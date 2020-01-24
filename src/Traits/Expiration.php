<?php
/**
 * Expiration trait
 *
 * @package micropackage/internationalization
 */

namespace Micropackage\Cache\Traits;

/**
 * Expiration trait
 */
trait Expiration {

	/**
	 * Cache expiration in seconds.
	 *
	 * @since [Next]
	 * @var   integer
	 */
	protected $expiration = 0;

	/**
	 * Gets the cache expiration
	 *
	 * @since  [Next]
	 * @return string
	 */
	public function get_expiration() {
		return $this->expiration;
	}

	/**
	 * Sets the cache expiration
	 *
	 * @since  [Next]
	 * @param  int $seconds Cache expiration in seconds.
	 * @return $this
	 */
	public function set_expiration( $seconds ) {
		$this->expiration = $seconds;
		return $this;
	}

}
