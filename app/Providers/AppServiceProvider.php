<?php

namespace App\Providers;


use App\Models\Configuracion;
use Illuminate\Support\ServiceProvider;
use App\Services\WooCommerceService;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register()
    {
        $this->app->singleton(WooCommerceService::class, function ($app) {
            return new WooCommerceService();
        });

    }


    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('*', function ($view) {
            $configuracion = Configuracion::first();

            $fechaActual = date('Y-m-d');

            $view->with(['configuracion' => $configuracion, 'fechaActual' => $fechaActual]);
        });
    }
}
