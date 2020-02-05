<?php
/**
 * Transient driver
 *
 * @package micropackage/cache
 */

namespace Micropackage\Cache\Driver;

use Micropackage\Cache\Traits;
use Micropackage\Cache\Abstracts\Driver;

/**
 * Transient driver
 */
class Transient extends Driver {

	use Traits\Expiration;

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 * @param int $expiration Expiration in seconds, default: not expiring.
	 */
	public function __construct( $expiration = 0 ) {
		$this->set_expiration( (int) $expiration );
	}

	/**
	 * Sets cache value
	 *
	 * @since  1.0.0
	 * @param  mixed $value Value to store.
	 * @return void
	 */
	public function set( $value ) {
		set_transient( $this->get_key(), $value, $this->get_expiration() );
	}

	/**
	 * Adds cache if it's not already set
	 *
	 * @since  1.0.0
	 * @param  mixed $value Value to store.
	 * @return void
	 */
	public function add( $value ) {
		if ( false === $this->get() ) {
			$this->set( $value );
		}
	}

	/**
	 * Gets value from cache
	 *
	 * @since  1.0.0
	 * @return mixed|false Cached value or false if not set
	 */
	public function get() {
		return get_transient( $this->get_key() );
	}

	/**
	 * Deletes value from cache
	 *
	 * @since  1.0.0
	 * @return void
	 */
	public function delete() {
		delete_transient( $this->get_key() );
	}

}
