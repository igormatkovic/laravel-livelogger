<?php namespace Igormatkovic\Livelogger;

use Monolog\Logger;
use Illuminate\Log\LogServiceProvider;
use Illuminate\Support\ServiceProvider;
use Config;

class LiveloggerServiceProvider extends LogServiceProvider {

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('igormatkovic/laravel-livelogger');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {

        $this->registerArtisanCommand();

        $logger = new Livelogger(new Logger('log'), $this->app['events']);

        $this->app->instance('log', $logger);

        if (isset($this->app['log.setup']))
        {
            call_user_func($this->app['log.setup'], $logger);
        }
    }


    /**
     * Register the Artisan command
     *
     * @return void
     */
    public function registerArtisanCommand()
    {
        $this->app->bindShared('livelogger.command.make', function($app)
            {
                return $app->make('Igormatkovic\Livelogger\Commands\LiveloggerGenerateCommand');
            });

        $this->commands('livelogger.command.make');
    }

}
