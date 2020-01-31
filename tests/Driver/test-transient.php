<?php
/**
 * Class TestTransient
 *
 * @package micropackage/cache
 */

namespace Micropackage\Cache\Test\Driver;

use Micropackage\Cache\Cache;
use Micropackage\Cache\Driver\Transient;

/**
 * Transient driver test case.
 */
class TestTransient extends \WP_UnitTestCase {

	public function test_should_get_null_if_key_not_set() {

		$driver = new Transient();

		$this->assertNull( $driver->get_key() );

	}

	public function test_should_set_key() {

		$key    = uniqid();
		$driver = new Transient();
		$driver->set_key( $key );

		$this->assertSame( $key, $driver->get_key() );

	}

	public function test_should_get_false_if_cache_not_set() {

		$driver = new Transient();

		$this->assertFalse( $driver->get() );

	}

	public function test_should_set_and_get_value_for_empty_key() {

		$value  = uniqid();
		$driver = new Transient();

		$driver->set( $value );

		$this->assertSame( $value, $driver->get() );

	}

	public function test_should_set_value() {

		$value  = uniqid();
		$driver = new Transient();

		$driver->set_key( 'test' );
		$driver->set( $value );

		$this->assertSame( $value, $driver->get() );

	}

	public function test_should_add_value_if_not_added() {

		$value  = uniqid();
		$driver = new Transient();

		$driver->set_key( 'test' );
		$driver->add( $value );

		$this->assertSame( $value, $driver->get() );

	}

	public function test_should_not_add_value_if_added() {

		$value  = uniqid();
		$driver = new Transient();

		$driver->set_key( 'test' );
		$driver->add( 'old' );
		$driver->add( $value );

		$this->assertSame( 'old', $driver->get() );

	}

	public function test_should_delete_cached_value() {

		$driver = new Transient();

		$driver->set_key( 'test' );
		$driver->set( uniqid() );
		$driver->delete();

		$this->assertFalse( $driver->get() );

	}

}
