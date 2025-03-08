<?php

namespace App\Providers;

use App\Contracts\ProductHandlerInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(
            ProductHandlerInterface::class,
            \Core\Application\Product\ProductHandler::class
        );

        $this->app->bind(
            \App\Contracts\OrderSaleHandlerInterface::class,
            \Core\Application\OrderSale\OrderSaleHandler::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
