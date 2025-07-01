<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

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
        // Perbaikan khusus untuk hosting seperti Vercel (read-only file system)
        if (app()->environment('production')) {
            // Atur path penyimpanan file ke folder sementara yang writable di Vercel
            Config::set('cache.stores.file.path', '/tmp/cache');
            Config::set('session.files', '/tmp/sessions');
            Config::set('view.compiled', '/tmp/views');

            // Buat folder jika belum ada
            if (!is_dir('/tmp/cache')) {
                mkdir('/tmp/cache', 0777, true);
            }
            if (!is_dir('/tmp/sessions')) {
                mkdir('/tmp/sessions', 0777, true);
            }
            if (!is_dir('/tmp/views')) {
                mkdir('/tmp/views', 0777, true);
            }
        }
    }
}
