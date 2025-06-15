<?php

namespace CherryneChou\LaravelDm\Dm;

use Illuminate\Database\Connection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use CherryneChou\LaravelDm\Dm\Connectors\DmConnector as Connector;

class DmServiceProvider extends ServiceProvider
{
    /**
     * The laravel-dm version.
     *
     * @var string
     */
    const VERSION = '11.0.4';

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Boot Dm Provider.
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/dm.php' => config_path('dm.php'),
        ], 'dm');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        if (file_exists(config_path('dm.php'))) {
            $this->mergeConfigFrom(config_path('dm.php'), 'database.connections');
        } else {
            $this->mergeConfigFrom(__DIR__.'/../config/dm.php', 'database.connections');
        }

        Connection::resolverFor('dm', function ($connection, $database, $prefix, $config) {
            $connector = new Connector();
            $connection = $connector->connect($config);
            $db = new DmConnection($connection, $database, $prefix, $config);

            return $db;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return string[]
     */
    public function provides()
    {
        return [];
    }
}
