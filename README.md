# PHP Helper Functions

The library `satheez/php-helper-functions`  is a collection of useful php helper functions.  

[![Latest Stable Version](https://img.shields.io/packagist/v/satheez/php-helper-functions)](https://packagist.org/packages/phpunit/phpunit)
[![Minimum PHP Version](https://img.shields.io/packagist/php-v/satheez/php-helper-functions)](https://php.net/)
[![Build Status](https://travis-ci.org/satheez/php-helper-functions.svg?branch=master)](https://travis-ci.org/satheez/php-helper-functions)
[![License](https://poser.pugx.org/satheez/php-helper-functions/license)](https://packagist.org/packages/satheez/php-helper-functions)

#### Installation
```bash
composer require satheez/php-helper-functions
```

#### Example
 ```php
 <?php
 
use Sa\Helper\Validate;

if( Validate::isValidString($string) ) {
    // Do something here
}
 ```

## CREDITS

This library makes use of the following brilliant and well known libraries:

- https://github.com/laravel/helpers
- https://github.com/fzaninotto/Faker

## Tests

All functions are tested against a number of unit tests and PHP Versions. 
[![Build Status](https://travis-ci.org/satheez/php-helper-functions.svg?branch=master)](https://travis-ci.org/satheez/php-helper-functions)
# Install

Install the latest `satheez/php-helper-functions` library with composer:

```bash
composer require satheez/php-helper-functions
```

Also make sure to require your composer autoload file:

```php
require __DIR__ . '/vendor/autoload.php';
```


