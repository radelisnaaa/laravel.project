<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Config;

class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (app()->environment('production')) {
            Config::set('cache.default', 'file');
            Config::set('cache.stores.file.path', '/tmp/cache');
            Config::set('session.driver', 'file');
            Config::set('session.files', '/tmp/sessions');
            Config::set('view.compiled', '/tmp/views');

            foreach (['/tmp/cache', '/tmp/sessions', '/tmp/views'] as $dir) {
                if (!is_dir($dir)) {
                    mkdir($dir, 0777, true);
                }
            }
        }
    }
}
