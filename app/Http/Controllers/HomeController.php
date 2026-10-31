<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\GalleryItem;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $services = Service::with('category')
            ->where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $galleryItems = GalleryItem::where('is_active', true)
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        $galleryCategories = $galleryItems->pluck('category')->unique()->values();

        $reviews = Review::where('is_approved', true)
            ->orderBy('sort_order')
            ->orderBy('id', 'desc')
            ->get();

        $latestArticles = Article::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->take(3)
            ->get();

        $settings = Setting::all()->pluck('value', 'key');

        return view('landing', compact('services', 'galleryItems', 'galleryCategories', 'reviews', 'latestArticles', 'settings'));
    }
}
