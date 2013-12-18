# Instagram Service Provider for Laravel 4

A simple [Laravel 4](http://laravel.com) service provider for including the [PHP Instagram API](https://github.com/galen/PHP-Instagram-API).

## Installation

The Instagram Service Provider can be installed via [Composer](http://getcomposer.org) by requiring the `elevencodes/instagram-laravel` package and setting the `minimum-stability` to `dev` in your project's `composer.json`.

```json
{
	"require": {
		"laravel/framework": "4.1.*",
		"elevencodes/instagram-laravel": "2.*"
	}
}
```

## Usage

To use the Instagram Service Provider, you must register the provider when bootstrapping your Laravel application.

### Use Laravel Configuration

Create a new `app/config/instagram.php` configuration file with the following options:

```php
return array(
    'client_id'    	=> '<your-instagram-client-id>',
    'client_secret' => '<your-instagram-client-secret>',
    'redirect_uri'	=> '<your-instagram-redirect-uri>',
    'scope'			=> array('<your-instagram-scope>'),
    'session_name'	=> '<your-instagram-session-key>'
);
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
		if (Session::has(Config::get('instagram.session_name')))
			Session::forget(Config::get('instagram.session_name'));

		Instagram::authorize();
	}

	public function getAuthorize()
	{
		Session::put(Config::get('instagram.session_name'), Instagram::getAccessToken(Input::get('code')));

		return Redirect::to('/');
	}

	public function getLogout()
	{
		Session::forget(Config::get('instagram.session_name'));

		return Redirect::to('/');
	}
```

Add the following routes in your `routes.php`.

```php
Route::get('/users/authorize', array('as' => 'authorize', 'uses' => 'UsersController@getAuthorize'));
Route::get('/login', array('as' => 'login', 'uses' => 'UsersController@getLogin'));
Route::get('/logout', array('as' => 'logout', 'uses' => 'UsersController@getLogout'));
```

### Current user

You can use static call to get the current authenticated user.

```php
$user = Instagram::getCurrentUser();
```

## Reference

* [PHP Instagram API](https://github.com/galen/PHP-Instagram-API)
* [Laravel website](http://laravel.com)
