<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use App\Models\Page;

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
        Paginator::useBootstrapFive();

        // Share the current page's SEO data with all views via the pages table.
        // This ensures meta_title, meta_description, meta_keywords are always
        // available in the layout without manually passing $page in every controller.
        View::composer('layouts.app', function ($view) {
            // Only resolve if $page isn't already set by the controller
            if (!isset($view->getData()['page'])) {
                $slug = Request::segment(1) ?: 'home';
                // Normalise common multi-segment slugs
                if (Request::is('/') || $slug === '') {
                    $slug = 'home';
                }
                $page = Page::where('slug', $slug)->where('status', true)->first();
                $view->with('page', $page);
            }
        });

        // Share global settings across all views with static caching
        View::composer('*', function ($view) {
            static $settings = null;
            if ($settings === null) {
                if (\Schema::hasTable('settings')) {
                    $settings = \App\Models\Setting::first() ?: new \App\Models\Setting();
                } else {
                    $settings = new \App\Models\Setting();
                }
            }
            $view->with('settings', $settings);
        });
    }
}
