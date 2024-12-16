<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Observers\ItemObserver;
use App\Models\Item;


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
        Item::observe(ItemObserver::class);
    }
}
