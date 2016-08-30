<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Multa;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $numero_de_multas = Multa::count();
        \View::share('numero_de_multas', $numero_de_multas);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
