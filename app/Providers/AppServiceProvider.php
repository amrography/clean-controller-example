<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register()
    {
        config([
            'dashboard-ui.default.theme' => 'cleopatra',
            'dashboard-ui.themes.cleopatra' => [
                'views_path' => 'vendor/laravel-dashboard-kit/dashboard-cleopatra/resources/views',
                'assets_dir' => 'vendor/laravel-dashboard-kit/dashboard-cleopatra/public/assets',
                'layouts' => [
                    'full'
                ]
            ],
            'dashboard-ui.nav' => [
                [
                    'url' => '/blogs',
                    'title' => 'Blogs',
                    'active' => true,
                    'icon' => 'ri-home-smile-line'
                ],
            ]
        ]);
    }

    public function boot()
    {
        //
    }
}
