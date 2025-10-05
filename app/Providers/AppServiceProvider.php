<?php

namespace App\Providers;

use Illuminate\View\View;
use App\View\Composers\FooterComposer;
use App\View\Composers\NavbarComposer;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
         View::composer('components.navbar', NavbarComposer::class);
         View::composer('components.footer', FooterComposer::class);
    }
}
