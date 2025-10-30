<?php

namespace App\Providers;

use Illuminate\Support\Facades\File;
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
        if (config('database.default') === 'sqlite') {
            $databasePath = database_path('database.sqlite');

            if (! File::exists($databasePath)) {
                File::ensureDirectoryExists(dirname($databasePath));
                File::put($databasePath, '');
            }
        }
    }
}
