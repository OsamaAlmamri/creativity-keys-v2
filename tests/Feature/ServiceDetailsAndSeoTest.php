<?php

namespace Tests\Feature;

use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceFaq;
use App\Models\ServiceFeature;
use App\Models\ServicePricingTier;
use App\Models\Setting;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ServiceDetailsAndSeoTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_details_page_loads_successfully_with_rich_content(): void
    {
        Setting::set('site_name', 'مفاتيح الإبداع');
        Setting::set('emergency_phone', '0568191921');
        Setting::set('city_name', 'جدة');

        $category = ServiceCategory::create([
            'name' => 'مفاتيح السيارات',
            'slug' => 'car-keys',
            'is_active' => true,
        ]);

        $service = Service::create([
            'category_id' => $category->id,
            'title' => 'برمجة مفاتيح وبصمات السيارات المشفرة',
            'slug' => 'car-keys-programming',
            'icon' => 'cpu-chip',
            'badge' => 'تقنية ذكية',
            'hero_subtitle' => 'برمجة وتوليف أحدث مفاتيح وبصمات السيارات بأحدث الأجهزة',
            'short_description' => 'برمجة احترافية لكافة مفاتيح وبصمات السيارات المشفرة الذكية.',
            'full_description' => 'شرح كامل عن خدمة برمجة المفاتيح.',
            'overview_title' => 'التكنولوجيا الحديثة في برمجة المفاتيح المشفرة',
            'overview_content' => 'نستخدم أحدث أجهزة البرمجة المتطورة واستخراج الكود السري.',
            'features_title' => 'أنواع المفاتيح التي نبرمجها',
            'process_title' => 'خطوات برمجة المفتاح',
            'pricing_title' => 'الأسعار التقديرية للبرمجة',
            'pricing_note' => '* الأسعار تقريبية وتعتمد على موديل السيارة.',
            'price_starting_at' => 'يبدأ من 150 ر.س',
            'meta_title' => 'برمجة مفاتيح وبصمات السيارات في جدة | مفتاح الإبداع',
            'meta_description' => 'أفضل محل برمجة مفاتيح وبصمات سيارات في جدة.',
            'meta_keywords' => 'برمجة مفاتيح سيارات جدة, بصمة سيارة',
            'is_emergency' => true,
            'is_active' => true,
            'sort_order' => 1,
            'steps' => [
                ['step' => 1, 'title' => 'فحص النظام', 'desc' => 'توصيل جهاز البرمجة لفحص كمبيوتر السيارة.'],
                ['step' => 2, 'title' => 'استخراج الكود السري', 'desc' => 'استخراج كود الأمان بأمان.'],
            ],
            'features' => ['برمجة جميع الشرائح والمتحكمات', 'قص ليزر مطابق للوكالة'],
        ]);

        ServiceFeature::create([
            'service_id' => $service->id,
            'title' => 'المفاتيح الذكية Smart Keys',
            'description' => 'مفاتيح البصمة والدخول الذكي بدون إخراج المفتاح.',
            'icon' => 'sparkles',
            'badge' => 'الأكثر طلباً',
            'sort_order' => 1,
        ]);

        ServicePricingTier::create([
            'service_id' => $service->id,
            'name' => 'برمجة مفتاح شريحة عادي',
            'price' => 'يبدأ من 150 ر.س',
            'note' => 'يشمل الشريحة والبرمجة',
            'sort_order' => 1,
        ]);

        ServiceFaq::create([
            'service_id' => $service->id,
            'question' => 'هل تبرمجون جميع ماركات السيارات في جدة؟',
            'answer' => 'نعم، نبرمج كافة الماركات والموديلات الحديثة.',
            'sort_order' => 1,
        ]);

        $response = $this->get(route('services.show', $service->slug));

        $response->assertStatus(200);
        $response->assertSee('برمجة مفاتيح وبصمات السيارات المشفرة');
        $response->assertSee('التكنولوجيا الحديثة في برمجة المفاتيح المشفرة');
        $response->assertSee('نستخدم أحدث أجهزة البرمجة المتطورة واستخراج الكود السري');
        $response->assertSee('المفاتيح الذكية Smart Keys');
        $response->assertSee('فحص النظام');
        $response->assertSee('برمجة مفتاح شريحة عادي');
        $response->assertSee('هل تبرمجون جميع ماركات السيارات في جدة؟');
        $response->assertSee('نعم، نبرمج كافة الماركات والموديلات الحديثة');
        $response->assertSee('0568191921');

        // Check SEO Schemas
        $response->assertSee('"@type":"BreadcrumbList"', false);
        $response->assertSee('"@type":"Service"', false);
        $response->assertSee('"@type":"FAQPage"', false);
        $response->assertSee('<link rel="canonical" href="'.route('services.show', $service->slug).'">', false);
    }

    public function test_inactive_service_returns_404(): void
    {
        $service = Service::create([
            'title' => 'خدمة معطلة',
            'slug' => 'inactive-service',
            'short_description' => 'خدمة غير نشطة حالياً',
            'is_active' => false,
        ]);

        $response = $this->get(route('services.show', $service->slug));
        $response->assertStatus(404);
    }

    public function test_services_index_redirects_to_homepage_services_section(): void
    {
        $response = $this->get(route('services.index'));
        $response->assertRedirect('/#services');
    }

    public function test_sitemap_includes_active_services(): void
    {
        $service = Service::create([
            'title' => 'خدمة فتح تجوري بالليزر',
            'slug' => 'laser-safe-opening',
            'short_description' => 'فتح الخزائن بالليزر',
            'is_active' => true,
        ]);

        $response = $this->get(route('sitemap'));
        $response->assertStatus(200);
        $response->assertSee(route('services.show', $service->slug));
    }
}
