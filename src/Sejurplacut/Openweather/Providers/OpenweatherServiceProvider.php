<?php namespace Sejurplacut\Openweather\Providers;

use Illuminate\Support\ServiceProvider;
use Sejurplacut\Openweather\Openweather;

class OpenweatherServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = true;

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('sejurplacut/openweather', 'openweather', __DIR__ . '/../../..');
    }


    /**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app->bind('openweather', function($app){
            $config = $app->make('config');

            /** @var array $defaults */
           return Openweather::getInstance()->init(array(
               'endpoint' => $config->get('openweather::endpoint')
           ));
        });

	}

	/**
	 * Get the services provided by the provider.
	 *
	 * @return array
	 */
	public function provides()
	{
		return array('openweather');
	}
}
