<?php
/**
 * Expiration trait
 *
 * @package micropackage/cache
 */

namespace Micropackage\Cache\Traits;

/**
 * Expiration trait
 */
trait Expiration {

	/**
	 * Cache expiration in seconds.
	 *
	 * @since 1.0.0
	 * @var   integer
	 */
	protected $expiration = 0;

	/**
	 * Gets the cache expiration
	 *
	 * @since  1.0.0
	 * @return string
	 */
	public function get_expiration() {
		return $this->expiration;
	}

	/**
	 * Sets the cache expiration
	 *
	 * @since  1.0.0
	 * @param  int $seconds Cache expiration in seconds.
	 * @return $this
	 */
	public function set_expiration( $seconds ) {
		$this->expiration = $seconds;
		return $this;
	}

}
