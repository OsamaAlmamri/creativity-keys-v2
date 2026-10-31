<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Article::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->orderBy('id', 'desc');

        if ($request->filled('category')) {
            $query->where('category', $request->input('category'));
        }

        if ($request->filled('q')) {
            $search = '%'.$request->input('q').'%';
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', $search)
                    ->orWhere('excerpt', 'like', $search)
                    ->orWhere('content', 'like', $search);
            });
        }

        $articles = $query->paginate(9);
        $categories = Article::where('is_published', true)->distinct()->pluck('category');
        $settings = Setting::all()->pluck('value', 'key');

        return view('articles.index', compact('articles', 'categories', 'settings'));
    }

    public function show(string $slug): View
    {
        $article = Article::where('slug', $slug)
            ->where('is_published', true)
            ->firstOrFail();

        // Increment views
        $article->increment('views_count');

        // Related articles
        $relatedArticles = Article::where('is_published', true)
            ->where('id', '!=', $article->id)
            ->where('category', $article->category)
            ->take(3)
            ->get();

        if ($relatedArticles->count() < 3) {
            $extra = Article::where('is_published', true)
                ->where('id', '!=', $article->id)
                ->whereNotIn('id', $relatedArticles->pluck('id'))
                ->take(3 - $relatedArticles->count())
                ->get();
            $relatedArticles = $relatedArticles->concat($extra);
        }

        $settings = Setting::all()->pluck('value', 'key');

        return view('articles.show', compact('article', 'relatedArticles', 'settings'));
    }
}
