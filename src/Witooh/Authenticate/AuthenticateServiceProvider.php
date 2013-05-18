<?php namespace Witooh\Authenticate;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\App;
use Witooh\Authenticate\Validators\LoginValidator;

class AuthenticateServiceProvider extends ServiceProvider {

	/**
	 * Indicates if loading of the provider is deferred.
	 *
	 * @var bool
	 */
	protected $defer = false;

	/**
	 * Bootstrap the application events.
	 *
	 * @return void
	 */
	public function boot()
	{
        $this->package('witooh/authenticate');
	}

	/**
	 * Register the service provider.
	 *
	 * @return void
	 */
	public function register()
	{
        $this->app['Authenticate'] = $this->app->share(function($app){
            $auth = new Authenticate();
            $behavior = Config::get('authenticate::default_behavior');
            $validator = new LoginValidator();
            $validator->setRule(Config::get('authenticate::rule'));
            $auth->setBehavior(new $behavior);
            $auth->setValidator($validator);
            return $auth;
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