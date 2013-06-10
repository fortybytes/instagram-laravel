<?php namespace Elevencodes\InstagramLaravel;

use Illuminate\Support\ServiceProvider;
use Instagram;

class InstagramLaravelServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
		$this->app['instagram'] = $this->app->share(function ($app) 
		{		
			if ($app['session']->has($app['config']['instagram']['session_name'])) {
				return new Instagram\Instagram($app['session']->get($app['config']['instagram']['session_name']));
			} else {
				$auth_config = !empty($app['config']['instagram']) ? $app['config']['instagram'] : array();
				return new Instagram\Auth($auth_config);
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
		return array();
	}

}