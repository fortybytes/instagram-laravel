<?php namespace Elevencodes\InstagramLaravel\Tests;

use Elevencodes\InstagramLaravel\Facades\InstagramLaravel as Instagram;

class InstagramLaravelFacadeTest extends InstagramTestCase
{
	/**
	 * @expectedException Instagram\Core\ApiAuthException
	 */
	public function testFacadeCanBeResolvedToServiceInstance()
    {
        $app = $this->setupApplication();
        $instagram = $this->setupServiceProvider($app);
        $app->register($instagram);
        $instagram->boot();
        $app['session']->set('instagram_access_token', 'foo');

        // Mount facades
        Instagram::setFacadeApplication($app);
        Instagram::getCurrentUser();
    }
}