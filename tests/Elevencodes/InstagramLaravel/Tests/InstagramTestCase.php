<?php namespace Elevencodes\InstagramLaravel\Tests;

use Illuminate\Config\Repository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application;
use Illuminate\Session\SessionServiceProvider;
use Elevencodes\InstagramLaravel\InstagramLaravelServiceProvider;

abstract class InstagramTestCase extends \PHPUnit_Framework_TestCase
{
	/**
	 * Setup application.
	 *
     * @return Application
     */
    protected function setupApplication()
    {
        // Create the application such that the config is loaded
        $app = new Application();
        $app->instance('path', 'foobar');
        $app->instance('files', new Filesystem);
        $app->instance('config', new Repository($app->getConfigLoader(), 'foobar'));

        return $app;
    }

    /**
     * Setup service provider.
     *
     * @param 	Application 	$app
     * @return 	InstagramLaravelServiceProvider
     */
    protected function setupServiceProvider(Application $app)
    {
    	$this->setupSessionServiceProvider($app);
        $instagram = new InstagramLaravelServiceProvider($app);
        // $app->register($instagram);
        // $instagram->boot();

        return $instagram;
    }

    /**
     * Setup session service provider.
     *
     * @param 	Application  	$app
     * @return 	SessionServiceProvider
     */
    protected function setupSessionServiceProvider(Application $app)
    {
    	$session = new SessionServiceProvider($app);
        $app->register($session);

        return $session;
    }
}
