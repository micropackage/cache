# Cache

[![BracketSpace Micropackage](https://img.shields.io/badge/BracketSpace-Micropackage-brightgreen)](https://bracketspace.com)
[![Latest Stable Version](https://poser.pugx.org/micropackage/cache/v/stable)](https://packagist.org/packages/micropackage/cache)
[![PHP from Packagist](https://img.shields.io/packagist/php-v/micropackage/cache.svg)](https://packagist.org/packages/micropackage/cache)
[![Total Downloads](https://poser.pugx.org/micropackage/cache/downloads)](https://packagist.org/packages/micropackage/cache)
[![License](https://poser.pugx.org/micropackage/cache/license)](https://packagist.org/packages/micropackage/cache)

## 🧬 About Cache

This micropackage is a wrapper for WordPress cache with two drivers implemented:

- [WP Object Cache API](https://codex.wordpress.org/Class_Reference/WP_Object_Cache)
- [Transients API](https://codex.wordpress.org/Transients_API)

It provides a unified, object-oriented way to manipulate WordPress Cache, witch the Cache manipulator object for even easier setting and getting the cache.

## 💾 Installation

``` bash
composer require micropackage/cache
```

## 🕹 Usage

### Object Cache

Constructing the Object Cache driver:

```php
use Micropackage\Cache\Driver\ObjectCache;

$object_cache = new ObjectCache( $group = 'my_group', $expiration = DAY_IN_SECONDS );
$object_cache->set_key( 'cache_key' );
```

Group parameter allows you to store the cache under the same key across multiple groups. Default is empty string.

By default the expiration is set to `0` which means the transient never expires.

#### Available methods

| Method                                    | Description                                                  | Returns                                                      |
| ----------------------------------------- | ------------------------------------------------------------ | ------------------------------------------------------------ |
| ```set_key( (string) $key )```            | Sets the cache key                                           | $this                                                        |
| ```get_key()```                           | Gets the cache key                                           | (string) Cache key                                           |
| ```set_group( (string) $group )```        | Sets the cache group                                         | $this                                                        |
| ```get_group```                           | Gets the cache group                                         | (string) Default empty string                                |
| ```set_expiration( (int) $expiration )``` | Sets the cache expiration in seconds                         | $this                                                        |
| ```get_expiration()```                    | Gets the cache expiration                                    | (int) Expiration seconds <br />Default 0 which means the cache  <br />doesn't expire |
| ```set( (mixed) $value )```               | Sets the cache                                               | void                                                         |
| ```add( (mixed) $value )```               | Sets the cache <br />only if it  wasn't set before           | void                                                         |
| ```get()```                               | Gets the cached value                                        | mixed\|false<br />False if not set                           |
| ```force_get()```                         | Gets the cached value  <br />and updates the local cache <br />from persistent cache | mixed\|false <br />False if not set                          |
| ```delete()```                            | Deletes the cache                                            | void                                                         |

### Transient Cache

Constructing the Transient Cache driver:

```php
use Micropackage\Cache\Driver\Transient;

$transient_cache = new Transient( $expiration = DAY_IN_SECONDS );
$transient_cache->set_key( 'cache_key' );
```

By default the expiration is set to `0` which means the transient never expires.

#### Available methods

| Method                                    | Description                                  | Returns                                                      |
| ----------------------------------------- | -------------------------------------------- | ------------------------------------------------------------ |
| ```set_key( (string) $key )```            | Sets the cache key                           | $this                                                        |
| ```get_key()```                           | Gets the cache key                           | (string) Cache key                                           |
| ```set_expiration( (int) $expiration )``` | Sets the cache expiration in seconds         | $this                                                        |
| ```get_expiration()```                    | Gets the cache expiration                    | (int) Expiration seconds <br />Default 0 which means the cache <br /> doesn't expire |
| ```set( (mixed) $value )```               | Sets the cache                               | void                                                         |
| ```add( (mixed) $value )```               | Sets the cache only if it  wasn't set before | void                                                         |
| ```get()```                               | Gets the cached value                        | mixed\|false <br />False if not set                          |
| ```delete()```                            | Deletes the cache                            | void                                                         |

### Cache manipulator

The Cache manipulator object allows you to use the `collect` method to easily get/store the cache value.

See the below example with Object Cache (you can pass the Transient Driver as well).

```php
use Micropackage\Cache\Cache;
use Micropackage\Cache\Driver\ObjectCache;

$driver = new ObjectCache( $group = 'my_group', $expiration = DAY_IN_SECONDS );
$cache  = new Cache( $driver, $cache_key = 'extremaly_important_thing' );

$the_thing = $cache->collect( $cache_key = 'extremaly_important_thing', function() {
	return 'The value was not set apparently';
} );
```

The `collect` method takes two arguments: the cache key and callable function. If the cache wasn't set for the provided key, the callable is called which should return the value for cache. The value is stored and returned

Using variables from outside the callable:

```php
$some_var = 'I am awesome!';

$the_thing = $cache->collect( 'extremaly_important_thing', function() use ( $some_var ) {
	return $some_var;
} );
```

## 📦 About the Micropackage project

Micropackages - as the name suggests - are micro packages with a tiny bit of reusable code, helpful particularly in WordPress development.

The aim is to have multiple packages which can be put together to create something bigger by defining only the structure.

Micropackages are maintained by [BracketSpace](https://bracketspace.com).

## 📖 Changelog

[See the changelog file](./CHANGELOG.md).

## 📃 License

GNU General Public License (GPL) v3.0. See the [LICENSE](./LICENSE) file for more information.
