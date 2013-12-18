<?php namespace Elevencodes\InstagramLaravel\Tests;

class InstagramLaravelServiceProviderTest extends InstagramTestCase
{
	public function testRegisterServiceProviderWithPackageConfig()
	{
		$app = $this->setupApplication();
        $instagram = $this->setupServiceProvider($app);
        $app->register($instagram);
        $instagram->boot();

        $instance = $app['instagram'];
        $this->assertInstanceOf('Instagram\Auth', $instance);
	}

	public function testRegisterServiceProviderWithInstagramSession()
	{
		$app = $this->setupApplication();
        $instagram = $this->setupServiceProvider($app);
        $session = $app['session'];
        $session->set('instagram_access_token', 'foo');
        $app->register($instagram);
        $instagram->boot();

        $instance = $app['instagram'];
        $this->assertInstanceOf('Instagram\Instagram', $instance);
	}

	public function testServiceNameIsProvided()
	{
		$app = $this->setupApplication();
        $provider = $this->setupServiceProvider($app);
        $this->assertContains('instagram', $provider->provides());
	}
}