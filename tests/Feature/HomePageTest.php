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
        Setting::set('site_name', 'مفتاح الإبداع');
        Setting::set('site_tagline', 'قص وبرمجة المفاتيح الذكية');
        Article::factory()->create(['title' => 'مقال رئيسي مميز', 'is_published' => true]);
        Service::factory()->create(['title' => 'برمجة بصمة سيارة']);
        GalleryItem::factory()->create(['title' => 'قص مفتاح ليزر']);
        Review::factory()->create(['client_name' => 'سعد الشمري']);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('مفتاح الإبداع');
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
        $response->assertDontSee('id="coverage"', false);
        $response->assertSee('id="gallery"', false);
        $response->assertSee('id="reviews"', false);
        $response->assertSee('id="articles"', false);
        $response->assertSee('id="location"', false);
        $response->assertSee('id="contact"', false);
    }

    public function test_coverage_section_is_hidden_from_home_page(): void
    {
        Setting::set('coverage_areas', 'الروضة • السلامة • الزهراء • المروة • الصفا • أبحر');

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertDontSee('id="coverage"', false);
        $response->assertDontSee('نغطي جميع مناطق وأحياء ومخططات جدة');
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

    public function test_accessibility_aria_attributes_are_valid_on_interactive_and_rating_elements(): void
    {
        $response = $this->get(route('home'));
        $response->assertStatus(200);

        // Rating containers must use role="img" when labeled by aria-label to satisfy ARIA 1.2 / Lighthouse specs
        $response->assertSee('role="img"', false);
        $response->assertDontSee('<div class="mt-3 flex gap-1 text-amber-400" aria-label=', false);
        $response->assertDontSee('<div class="mt-4 flex gap-0.5 text-amber-400" aria-label=', false);

        // Floating buttons container must have role="group" when labeled by aria-label
        $response->assertSee('role="group" aria-label="تواصل سريع"', false);

        // Ensure no invalid role="tablist" without role="tab" exists on gallery filters
        $response->assertDontSee('role="tablist"', false);
    }

    public function test_gallery_renders_lightbox_preview_and_interactive_items(): void
    {
        GalleryItem::factory()->create([
            'title' => 'واجهة محل مفتاح الإبداع في جدة',
            'category' => 'المركز والواجهة',
            'image_url' => '/images/store/800_6abfe27982073.jpg',
            'description' => 'المقر الرئيسي لخدمات قص وبرمجة المفاتيح',
        ]);

        $response = $this->get(route('home'));
        $response->assertStatus(200);

        // Verify Gallery Lightbox and Interactive items
        $response->assertSee('id="galleryLightbox"', false);
        $response->assertSee('id="galleryLightboxImg"', false);
        $response->assertSee('id="galleryClose"', false);
        $response->assertSee('id="galleryPrev"', false);
        $response->assertSee('id="galleryNext"', false);
        $response->assertSee('gallery-item', false);
        $response->assertSee('data-gallery-src=', false);
        $response->assertSee('واجهة محل مفتاح الإبداع في جدة');
    }
}
