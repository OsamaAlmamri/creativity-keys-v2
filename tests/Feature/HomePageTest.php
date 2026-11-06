<?php

namespace Tests\Feature;

use App\Models\Article;
use App\Models\GalleryItem;
use App\Models\Review;
use App\Models\Service;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HomePageTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_successfully(): void
    {
        Setting::set('site_name', 'مفاتيح الإبداع');
        Setting::set('site_tagline', 'قص وبرمجة المفاتيح الذكية');
        Article::factory()->create(['title' => 'مقال رئيسي مميز', 'is_published' => true]);
        Service::factory()->create(['title' => 'برمجة بصمة سيارة']);
        GalleryItem::factory()->create(['title' => 'قص مفتاح ليزر']);
        Review::factory()->create(['client_name' => 'سعد الشمري']);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('مفاتيح الإبداع');
        $response->assertSee('قص وبرمجة المفاتيح الذكية');
        $response->assertSee('برمجة بصمة سيارة');
        $response->assertSee('قص مفتاح ليزر');
        $response->assertSee('سعد الشمري');
        $response->assertSee('مقال رئيسي مميز');
        $response->assertSee('قراءة المقال');
        $response->assertSee('معرض الصور والأعمال');
        $response->assertSee('موقع المحل وساعات العمل');
        $response->assertSee('أرسل طلبك أو استفسارك');
        $response->assertSee('id="hero"', false);
        $response->assertSee('id="about"', false);
        $response->assertSee('id="services"', false);
        $response->assertSee('id="coverage"', false);
        $response->assertSee('id="gallery"', false);
        $response->assertSee('id="reviews"', false);
        $response->assertSee('id="articles"', false);
        $response->assertSee('id="location"', false);
        $response->assertSee('id="contact"', false);
    }

    public function test_coverage_section_displays_jeddah_neighborhoods(): void
    {
        Setting::set('coverage_areas', 'الروضة • السلامة • الزهراء • المروة • الصفا • أبحر');

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('نغطي جميع مناطق وأحياء ومخططات جدة');
        $response->assertSee('الروضة');
        $response->assertSee('السلامة');
        $response->assertSee('أبحر');
    }

    public function test_legacy_301_redirects_preserve_seo_value(): void
    {
        // 1. GET /contact -> 301 to /#contact
        $contactResponse = $this->get('/contact');
        $contactResponse->assertRedirect('/#contact');
        $contactResponse->assertStatus(301);

        // 2. GET /blog -> 301 to /articles
        $blogResponse = $this->get('/blog');
        $blogResponse->assertRedirect(route('articles.index'));
        $blogResponse->assertStatus(301);

        // 3. GET /article/{slug} -> 301 to /articles/{slug}
        $article = Article::factory()->create(['slug' => 'test-car-key', 'is_published' => true]);
        $articleResponse = $this->get('/article/test-car-key');
        $articleResponse->assertRedirect(route('articles.show', 'test-car-key'));
        $articleResponse->assertStatus(301);

        // 4. GET /category/{slug} -> 301 to /articles
        $catResponse = $this->get('/category/cars');
        $catResponse->assertRedirect(route('articles.index'));
        $catResponse->assertStatus(301);

        // 5. GET /tag/{slug} -> 301 to /articles
        $tagResponse = $this->get('/tag/toyota');
        $tagResponse->assertRedirect(route('articles.index'));
        $tagResponse->assertStatus(301);
    }

    public function test_social_media_links_are_displayed_in_footer_only_when_configured(): void
    {
        // 1. Without social media links: section is hidden
        Setting::set('social_twitter', '');
        Setting::set('social_instagram', '');
        Setting::set('social_tiktok', '');
        Setting::set('social_snapchat', '');
        Setting::set('social_facebook', '');
        Setting::set('social_youtube', '');
        Setting::set('social_linkedin', '');

        $responseEmpty = $this->get(route('home'));
        $responseEmpty->assertStatus(200);
        $responseEmpty->assertDontSee('تابعنا على وسائل التواصل:');

        // 2. With specific social media links: only configured ones are rendered
        Setting::set('social_twitter', 'https://x.com/creativity_keys');
        Setting::set('social_instagram', 'https://instagram.com/creativity_keys');
        Setting::set('social_tiktok', '');

        $responseWithSocials = $this->get(route('home'));
        $responseWithSocials->assertStatus(200);
        $responseWithSocials->assertSee('تابعنا على وسائل التواصل:');
        $responseWithSocials->assertSee('https://x.com/creativity_keys');
        $responseWithSocials->assertSee('https://instagram.com/creativity_keys');
        $responseWithSocials->assertDontSee('https://tiktok.com');
        $responseWithSocials->assertDontSee('https://facebook.com');
    }
}
