<?php
/**
 * Class TestExpiration
 *
 * @package micropackage/cache
 */

namespace Micropackage\Cache\Test\Traits;

use Micropackage\Cache\Cache;
use Micropackage\Cache\Driver;

/**
 * Expiration trait test case.
 */
class TestExpiration extends \WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->key    = 'cache_key';
		$this->driver = new Driver\ObjectCache( 'cache/tests', 0 );
	}

	public function test_should_get_expiration() {

		$expiration_time = rand( 0, 3600 );

		$driver = new Driver\ObjectCache( 'cache/tests', $expiration_time );

		$this->assertSame( $expiration_time, $driver->get_expiration() );

	}

	public function test_should_get_infinite_expiration() {

		$driver = new Driver\ObjectCache( 'cache/tests' );

		$this->assertSame( 0, $driver->get_expiration() );

	}

	public function test_should_set_expiration() {

		$expiration_time = rand( 0, 3600 );

		$driver = new Driver\ObjectCache( 'cache/tests', 10000 );
		$driver->set_expiration( $expiration_time );

		$this->assertSame( $expiration_time, $driver->get_expiration() );

	}

}
