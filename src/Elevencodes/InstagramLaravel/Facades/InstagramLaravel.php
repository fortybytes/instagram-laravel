<?php namespace Elevencodes\InstagramLaravel\Facades;

use Illuminate\Support\Facades\Facade;

class InstagramLaravel extends Facade
{
	/**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'instagram'; }
}