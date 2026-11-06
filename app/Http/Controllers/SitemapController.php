<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Service;
use Illuminate\Http\Response;

class SitemapController extends Controller
{
    /**
     * توليد خريطة الموقع XML المتوافقة مع معايير Google ومحركات البحث
     */
    public function index(): Response
    {
        $articles = Article::where('is_published', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $services = Service::where('is_active', true)
            ->orderBy('updated_at', 'desc')
            ->get();

        $latestArticleDate = $articles->first()?->updated_at?->toAtomString();
        $latestServiceDate = $services->first()?->updated_at?->toAtomString();
        $latestDate = $latestArticleDate ?? $latestServiceDate ?? now()->toAtomString();

        $xml = view('sitemap', [
            'articles' => $articles,
            'services' => $services,
            'latestDate' => $latestDate,
        ])->render();

        return response($xml, 200, [
            'Content-Type' => 'application/xml; charset=utf-8',
            'X-Robots-Tag' => 'noindex, follow',
        ]);
    }
}
