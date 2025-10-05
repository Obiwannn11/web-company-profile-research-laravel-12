<?php

namespace App\Providers;

use App\View\Composers\FooterComposer;
use App\View\Composers\NavbarComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades;
use Illuminate\Support\Facades\View;

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
         Facades\View::composer('components.navbar', NavbarComposer::class);
         View::composer('components.footer', FooterComposer::class);
    }
}
