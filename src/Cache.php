<?php
/**
 * Cache class
 *
 * @package micropackage/cache
 */

namespace Micropackage\Cache;

/**
 * Cache class
 *
 * @method void set( mixed $value ) Sets cache value
 * @method void add( mixed $value ) Adds cache if it's not already set
 * @method mixed|false get() Cached value or false if not set
 * @method void delete() Deletes value from cache
 */
class Cache {

	/**
	 * Driver object
	 *
	 * @since 1.0.0
	 * @var   Interfaces\Cacheable
	 */
	private $driver;

	/**
	 * Cache key
	 *
	 * @since 1.0.0
	 * @var   string
	 */
	private $key;

	/**
	 * Cache constructor
	 *
	 * @since 1.0.0
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
	 * @since  1.0.0
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
	 * @since  1.0.0
	 * @since  1.0.2 The key parameter is obsolete, it has been already set in the constructor.
	 * @param  callable      $callback            Callback which gets the value.
	 *                                            Or deprecated string as key in version 1.0.0.
	 * @param  callable|null $deprecated_callback Callback which gets the value.
	 *                                            Default: null
	 * @return mixed                              Cached value
	 */
	public function collect( $callback, $deprecated_callback = null ) {

		$cached_value = $this->get();

		if ( false !== $cached_value ) {
			return $cached_value;
		}

		// @since 1.0.2 The callback is the only param of this method.
		if ( ! is_callable( $callback ) ) {
			$callback = $deprecated_callback;
		}

		$cached_value = call_user_func( $callback );

		$this->add( $cached_value );

		return $cached_value;

	}

}
