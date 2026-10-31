<?php

namespace Tests\Feature;

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
        Setting::set('site_name', 'مفاتيح الأمان الذهبية');
        Service::factory()->create(['title' => 'برمجة بصمة سيارة']);
        GalleryItem::factory()->create(['title' => 'قص مفتاح ليزر']);
        Review::factory()->create(['client_name' => 'سعد الشمري']);

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('مفاتيح الأمان الذهبية');
        $response->assertSee('برمجة بصمة سيارة');
        $response->assertSee('قص مفتاح ليزر');
        $response->assertSee('سعد الشمري');
        $response->assertSee('معرض الصور والأعمال');
        $response->assertSee('موقع المحل وساعات العمل');
        $response->assertSee('أرسل طلبك أو استفسارك');
    }
}
