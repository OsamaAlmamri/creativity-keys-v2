<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeoOptimizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_contains_comprehensive_seo_meta_tags_and_schema(): void
    {
        Setting::set('site_name', 'مفتاح باب البستان');
        Setting::set('site_tagline', 'قص وبرمجة المفاتيح الذكية');
        Setting::set('city_name', 'جدة');
        Setting::set('meta_description', 'أفضل خدمات قص وبرمجة المفاتيح والأقفال في جدة على مدار 24 ساعة');
        Setting::set('emergency_phone', '0559998877');

        Service::factory()->create([
            'title' => 'فتح أبواب الفلل والمنازل المغلقة',
            'short_description' => 'فتح احترافي للأبواب بدون أي كسر أو خدش',
            'is_active' => true,
        ]);

        Review::factory()->create([
            'rating' => 5,
            'is_approved' => true,
        ]);

        $response = $this->get(route('home'));

        $response->assertStatus(200);

        // Basic SEO & Meta
        $response->assertSee('<meta name="robots" content="index, follow', false);
        $response->assertSee('<link rel="canonical" href="'.route('home').'">', false);
        $response->assertSee('مفتاح باب البستان');
        $response->assertSee('أفضل خدمات قص وبرمجة المفاتيح والأقفال في جدة', false);

        // Geo & Local SEO Tags
        $response->assertSee('<meta name="geo.region" content="SA-02">', false);
        $response->assertSee('<meta name="geo.placename" content="جدة، المملكة العربية السعودية">', false);
        $response->assertSee('name="geo.position"', false);
        $response->assertSee('name="ICBM"', false);

        // Open Graph & Twitter Cards
        $response->assertSee('<meta property="og:site_name" content="مفتاح باب البستان">', false);
        $response->assertSee('<meta property="og:locale" content="ar_SA">', false);
        $response->assertSee('<meta property="og:type" content="website">', false);
        $response->assertSee('<meta name="twitter:card" content="summary_large_image">', false);

        // JSON-LD Schema.org LocalBusiness / Locksmith
        $response->assertSee('"@type": "Locksmith"', false);
        $response->assertSee('"name": "مفتاح باب البستان"', false);
        $response->assertSee('"telephone": "0559998877"', false);
        $response->assertSee('"@type": "PostalAddress"', false);
        $response->assertSee('"addressLocality": "جدة"', false);
        $response->assertSee('"addressCountry": "SA"', false);
        $response->assertSee('"@type": "OpeningHoursSpecification"', false);

        // OfferCatalog Schema for Services
        $response->assertSee('"@type": "OfferCatalog"', false);
        $response->assertSee('"name": "دليل خدمات قص وبرمجة المفاتيح وفتح الأقفال"', false);
        $response->assertSee('فتح أبواب الفلل والمنازل المغلقة');
    }

    public function test_article_details_page_contains_article_specific_seo_and_schema(): void
    {
        Setting::set('site_name', 'مفتاح باب البستان');

        $article = Article::factory()->create([
            'title' => 'دليل برمجة مفاتيح سيارات تويوتا الذكية',
            'slug' => 'toyota-smart-key-programming-guide',
            'category' => 'مفاتيح سيارات',
            'excerpt' => 'كل ما تود معرفته عن برمجة بصمات ومفاتيح تويوتا المشفرة بأحدث أجهزة الليزر.',
            'image_url' => 'https://images.unsplash.com/toyota-key.jpg',
            'is_published' => true,
        ]);

        $response = $this->get(route('articles.show', $article->slug));

        $response->assertStatus(200);

        // Title and description match article
        $response->assertSee('<title>دليل برمجة مفاتيح سيارات تويوتا الذكية | مفتاح باب البستان</title>', false);
        $response->assertSee('content="كل ما تود معرفته عن برمجة بصمات ومفاتيح تويوتا المشفرة', false);

        // Open Graph
        $response->assertSee('<meta property="og:type" content="article">', false);
        $response->assertSee('<meta property="og:image" content="https://images.unsplash.com/toyota-key.jpg">', false);

        // BlogPosting / Article JSON-LD
        $response->assertSee('"@type": "BlogPosting"', false);
        $response->assertSee('"headline": "دليل برمجة مفاتيح سيارات تويوتا الذكية"', false);
        $response->assertSee('"image": "https://images.unsplash.com/toyota-key.jpg"', false);
        $response->assertSee('"articleSection": "مفاتيح سيارات"', false);

        // BreadcrumbList JSON-LD
        $response->assertSee('"@type": "BreadcrumbList"', false);
        $response->assertSee('"name": "الرئيسية"', false);
        $response->assertSee('"name": "المقالات والنصائح"', false);
    }

    public function test_sitemap_xml_generates_valid_xml_with_published_pages(): void
    {
        $published = Article::factory()->create([
            'title' => 'مقال مفاتيح سيارات منشور بالخريطة',
            'slug' => 'published-seo-article',
            'image_url' => 'https://images.unsplash.com/published-key.jpg',
            'is_published' => true,
        ]);

        $draft = Article::factory()->create([
            'title' => 'مقال مسودة لا يظهر بالخريطة',
            'slug' => 'draft-hidden-article',
            'is_published' => false,
        ]);

        $response = $this->get('/sitemap.xml');

        $response->assertStatus(200);
        $response->assertHeader('Content-Type', 'application/xml; charset=utf-8');

        // Contains XML structure
        $response->assertSee('<?xml version="1.0" encoding="UTF-8"?>', false);
        $response->assertSee('<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"', false);

        // Home and Articles Index
        $response->assertSee(route('home'));
        $response->assertSee(route('articles.index'));

        // Published article
        $response->assertSee(route('articles.show', $published->slug));
        $response->assertSee('https://images.unsplash.com/published-key.jpg');
        $response->assertSee('مقال مفاتيح سيارات منشور بالخريطة');

        // Draft article excluded
        $response->assertDontSee($draft->slug);
    }

    public function test_robots_txt_exists_and_disallows_admin(): void
    {
        $robotsPath = public_path('robots.txt');
        $this->assertFileExists($robotsPath);

        $content = file_get_contents($robotsPath);
        $this->assertStringContainsString('User-agent: *', $content);
        $this->assertStringContainsString('Disallow: /admin', $content);
        $this->assertStringContainsString('Sitemap:', $content);
    }

    public function test_custom_seo_and_branding_settings_are_rendered_correctly(): void
    {
        Setting::set('site_name', 'مفتاح باب البستان');
        Setting::set('site_logo', 'https://example.com/brand-logo.png');
        Setting::set('site_favicon', 'https://example.com/custom-favicon.png');
        Setting::set('meta_keywords', 'مفاتيح سيارات جدة, قص ليزر, فتح اقفال ذكية');
        Setting::set('og_image', 'https://example.com/custom-og.jpg');
        Setting::set('seo_robots', 'noindex, nofollow');
        Setting::set('seo_alternate_name', 'مختبر مفتاح باب البستان لقص وبرمجة الأقفال');
        Setting::set('google_site_verification', 'googletestcode998877');
        Setting::set('google_analytics_id', 'G-TEST123456');
        Setting::set('social_twitter', 'https://x.com/baba_keys');
        Setting::set('social_instagram', 'https://instagram.com/baba_keys');

        $response = $this->get(route('home'));

        $response->assertStatus(200);

        // Logo in Header & Schema
        $response->assertSee('https://example.com/brand-logo.png');
        $response->assertSee('"logo": "https://example.com/brand-logo.png"', false);

        // Favicon
        $response->assertSee('<link rel="icon" href="https://example.com/custom-favicon.png">', false);

        // Keywords
        $response->assertSee('<meta name="keywords" content="مفاتيح سيارات جدة, قص ليزر, فتح اقفال ذكية">', false);

        // OG Image
        $response->assertSee('<meta property="og:image" content="https://example.com/custom-og.jpg">', false);
        $response->assertSee('<meta name="twitter:image" content="https://example.com/custom-og.jpg">', false);

        // Robots
        $response->assertSee('<meta name="robots" content="noindex, nofollow">', false);

        // Verification & Analytics
        $response->assertSee('<meta name="google-site-verification" content="googletestcode998877">', false);
        $response->assertSee('https://www.googletagmanager.com/gtag/js?id=G-TEST123456', false);
        $response->assertSee("gtag('config', 'G-TEST123456');", false);

        // Schema Alternate Name & sameAs
        $response->assertSee('"alternateName": "مختبر مفتاح باب البستان لقص وبرمجة الأقفال"', false);
        $response->assertSee('"sameAs": ["https://x.com/baba_keys","https://instagram.com/baba_keys"]', false);
    }
}
