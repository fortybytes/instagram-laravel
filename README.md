# Instagram Service Provider for Laravel

[![Build Status](https://travis-ci.org/elevencodes/instagram-laravel.png?branch=master)](https://travis-ci.org/elevencodes/instagram-laravel) [![Coverage Status](https://coveralls.io/repos/elevencodes/instagram-laravel/badge.png?branch=master)](https://coveralls.io/r/elevencodes/instagram-laravel?branch=develop) [![Latest Stable Version](https://poser.pugx.org/elevencodes/instagram-laravel/v/stable.png)](https://packagist.org/packages/elevencodes/instagram-laravel) [![Total Downloads](https://poser.pugx.org/elevencodes/instagram-laravel/downloads.png)](https://packagist.org/packages/elevencodes/instagram-laravel)

A simple [Laravel 4](http://laravel.com) service provider for including the [PHP Instagram API](https://github.com/galen/PHP-Instagram-API).

## Installation

The Instagram Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the `elevencodes/instagram-laravel` package.

```json
{
	"require": {
		"laravel/framework": "4.1.*",
		"elevencodes/instagram-laravel": "2.*"
	}
}
```
> If you are using the Laravel 4.0, use `"elevencodes/instagram-laravel": "1.*"` instead.

## Usage

To use the Instagram Service Provider, you must register the provider when bootstrapping your Laravel application.

### Use Laravel Configuration

Run `config:publish` artisan command and update the package configuration file.

```bash
php artisan config:publish elevencodes/instagram-laravel
```

Find the `providers` key in `app/config/app.php` and register the Instagram Service Provider.

```php
    'providers' => array(
        // ...
        'Elevencodes\InstagramLaravel\InstagramLaravelServiceProvider',
    )
```

Find the `aliases` key in `app/config/app.php` and add in our `Instagram` alias.

```php
    'aliases' => array(
        // ...
        'Instagram' 	  => 'Elevencodes\InstagramLaravel\Facades\InstagramLaravel',
    )
```

### Authentication

The following example uses the Instagram Service Provider to authenticate user.

Add the following methods in your Users Controller.

```php
	public function getLogin()
	{
		if (Session::has(Config::get('instagram::session_name')))
			Session::forget(Config::get('instagram::session_name'));

		Instagram::authorize();
	}

	public function getAuthorize()
	{
		Session::put(Config::get('instagram::session_name'), Instagram::getAccessToken(Input::get('code')));

		return Redirect::to('/');
	}

	public function getLogout()
	{
		Session::forget(Config::get('instagram::session_name'));

		return Redirect::to('/');
	}
```

Add the following routes in your `routes.php`.

```php
Route::get('/users/authorize', array('as' => 'authorize', 'uses' => 'UsersController@getAuthorize'));
Route::get('/login', array('as' => 'login', 'uses' => 'UsersController@getLogin'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'UsersController@getLogout'));
```

## Example

### Get current user

You can use static call to get the current authenticated user.

```php
$user = Instagram::getCurrentUser();
```

## Reference

* [PHP Instagram API](https://github.com/galen/PHP-Instagram-API)
* [Laravel website](http://laravel.com)
