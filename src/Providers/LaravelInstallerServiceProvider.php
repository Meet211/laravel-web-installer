<?php

namespace Meetahir\LaravelWebInstaller\Providers;

use Meetahir\LaravelWebInstaller\Views\Components\InstallerInput;
use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Meetahir\LaravelWebInstaller\Middleware\canInstall;
use Illuminate\Support\Facades\Route;

class LaravelInstallerServiceProvider extends ServiceProvider
{
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
        $this->publishFiles();
    }

    /**
     * Bootstrap the application events.
     *
     * @param \Illuminate\Routing\Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        $router->middlewareGroup('install', [canInstall::class]);

        // Ensure routes are registered during boot in Laravel 11/12
        $this->loadRoutesFrom(__DIR__ . '/../routes.php');

        // Make views and translations available without publishing
        $this->loadViewsFrom(__DIR__ . '/../Views', 'installer');
        Blade::component('installer-input', InstallerInput::class);
        $this->loadTranslationsFrom(__DIR__ . '/../Lang', 'installer');

        // Note: no diagnostic routes in production code
    }

    /**
     * Publish config file for the installer.
     *
     * @return void
     */
    protected function publishFiles()
    {
        $this->publishes([
            __DIR__.'/../Config/installer.php' => base_path('config/installer.php'),
        ]);

        $this->publishes([
            __DIR__.'/../assets' => public_path('installer'),
        ], 'public');

        $this->publishes([
            __DIR__.'/../Views' => base_path('resources/views/vendor/installer'),
        ]);

        $this->publishes([
            __DIR__.'/../Lang' => base_path('lang'),
        ]);
    }
}
