<?php

namespace App\Providers;

use App\Models\Review;
use Illuminate\Support\Facades\View;
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
        View::composer('partials.seo', function ($view) {
            if (! isset($view->averageRating) || ! isset($view->reviewCount)) {
                try {
                    $stats = Review::where('is_approved', true)
                        ->selectRaw('COUNT(*) as total, AVG(rating) as avg_rating')
                        ->first();

                    $count = (int) ($stats->total ?? 0);
                    $avg = (float) ($stats->avg_rating ?? 0);

                    $view->with('reviewCount', $count > 0 ? $count : 18);
                    $view->with('averageRating', $avg > 0 ? $avg : 4.9);
                } catch (\Throwable) {
                    $view->with('reviewCount', 18);
                    $view->with('averageRating', 4.9);
                }
            }
        });
    }
}
