<?php
/**
 * Class TestCache
 *
 * @package micropackage/cache
 */

namespace Micropackage\Cache\Test;

use Micropackage\Cache\Cache;
use Micropackage\Cache\Driver;

/**
 * Cache test case.
 */
class TestCache extends \WP_UnitTestCase {

	public function setUp() {
		parent::setUp();
		$this->key    = 'cache_key';
		$this->driver = new Driver\ObjectCache( 'cache/tests', 0 );
		$this->cache  = new Cache( $this->driver, $this->key );
	}

	public function test_should_call_collector_when_value_not_set() {

		$val = $this->cache->collect( $this->key, function() {
			return 'from-collector';
		} );

		$this->assertSame( 'from-collector', $val );

	}

	public function test_should_not_call_collector_when_value_set() {

		$this->driver->set( 'old-value' );

		$val = $this->cache->collect( $this->key, function() {
			return 'new-value';
		} );

		$this->assertSame( 'old-value', $val );

	}

}
