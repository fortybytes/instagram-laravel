<?php namespace Elevencodes\InstagramLaravel;

use Instagram\Auth;
use Instagram\Instagram;
use Illuminate\Support\ServiceProvider;

class InstagramLaravelServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Boot the service provider.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->package('elevencodes/instagram-laravel', 'instagram');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app->bindShared('instagram', function($app) {
			if ($app['session']->has($app['config']['instagram::session_name'])) {
				return new Instagram($app['session']->get($app['config']['instagram::session_name']));
			} else {
				$auth_config = !empty($app['config']['instagram::config']) ? $app['config']['instagram::config'] : array();
				return new Auth($auth_config);
			}
		});
	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('instagram');
	}

}