<?php

namespace App\Providers;

use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Sobrescribe el servicio de base de datos
        $this->app->singleton('db', function () {
            return new class implements ConnectionResolverInterface {
                public function connection($name = null)
                {
                    throw new \RuntimeException('Database connection is disabled.');
                }

                public function getDefaultConnection()
                {
                    throw new \RuntimeException('Database connection is disabled.');
                }

                public function setDefaultConnection($name)
                {
                    throw new \RuntimeException('Database connection is disabled.');
                }
            };
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
