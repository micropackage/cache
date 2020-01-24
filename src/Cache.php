<?php
/**
 * Cache class
 *
 * @package micropackage/internationalization
 */

namespace Micropackage\Cache;

/**
 * Cache class
 */
class Cache {

	/**
	 * Driver object
	 *
	 * @since [Next]
	 * @var   Interfaces\Cacheable
	 */
	private $driver;

	/**
	 * Cache key
	 *
	 * @since [Next]
	 * @var   string
	 */
	private $key;

	/**
	 * Cache constructor
	 *
	 * @since [Next]
	 * @param Interfaces\Cacheable $driver Driver instance.
	 * @param string               $key    Cache key.
	 */
	public function __construct( Interfaces\Cacheable $driver, $key ) {

		$this->driver = $driver;
		$this->key    = $key;

		$this->driver->set_key( $this->key );

	}

	/**
	 * Passes the method call to the driver
	 *
	 * @since  [Next]
	 * @param  string $method_name Called method name.
	 * @param  array  $arguments   List of arguments passed.
	 * @return mixed
	 */
	public function __call( $method_name, $arguments ) {
		return call_user_func_array( [ $this->driver, $method_name ], $arguments );
	}

	/**
	 * Gets the value from cache or stores it.
	 * If the value is not set, the callback is called to
	 * collect the value.
	 *
	 * @since  [Next]
	 * @param  string   $key      Cache key.
	 * @param  callable $callback Callback which gets the value.
	 * @return mixed              Cached value
	 */
	public function collect( $key, $callback ) {

		$cached_value = $this->get();

		if ( false !== $cached_value ) {
			return $cached_value;
		}

		$cached_value = call_user_func( $callback );

		$this->add( $cached_value );

		return $cached_value;

	}

}
