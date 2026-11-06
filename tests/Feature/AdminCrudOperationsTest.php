<?php

namespace Tests\Feature;

use App\Models\ContactMessage;
use App\Models\GalleryItem;
use App\Models\Review;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class AdminCrudOperationsTest extends TestCase
{
    use RefreshDatabase;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);
    }

    public function test_admin_can_create_update_and_delete_service(): void
    {
        // 1. Create service
        $response = $this->actingAs($this->admin)->post(route('admin.services.store'), [
            'title' => 'خدمة فتح تجوري بالليزر',
            'icon' => 'shield-check',
            'short_description' => 'فتح أحدث الخزائن الرقمية',
            'price_starting_at' => '300 ر.س',
            'is_emergency' => 1,
            'is_active' => 1,
            'sort_order' => 1,
        ]);

        $response->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', ['title' => 'خدمة فتح تجوري بالليزر']);

        $service = Service::where('title', 'خدمة فتح تجوري بالليزر')->first();

        // 2. Update service
        $updateResponse = $this->actingAs($this->admin)->put(route('admin.services.update', $service), [
            'title' => 'خدمة فتح تجوري بالليزر المحدثة',
            'icon' => 'shield-check',
            'short_description' => 'وصف محدث',
            'is_emergency' => 0,
            'is_active' => 1,
        ]);

        $updateResponse->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseHas('services', ['title' => 'خدمة فتح تجوري بالليزر المحدثة']);

        // 3. Delete service
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.services.destroy', $service));
        $deleteResponse->assertRedirect(route('admin.services.index'));
        $this->assertDatabaseMissing('services', ['id' => $service->id]);
    }

    public function test_services_index_renders_custom_delete_button_and_modal_attributes(): void
    {
        $service = Service::factory()->create(['title' => 'خدمة فتح مرسيدس']);

        $response = $this->actingAs($this->admin)->get(route('admin.services.index'));
        $response->assertStatus(200);
        $response->assertSee('btn-delete', false);
        $response->assertSee('data-confirm-title="تأكيد حذف الخدمة الفنية"', false);
        $response->assertSee('data-item-name="خدمة فتح مرسيدس"', false);
        $response->assertSee('id="delete-modal"', false);
    }

    public function test_admin_can_add_and_delete_gallery_item(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.gallery.store'), [
            'title' => 'صورة عمل برمجة مفتاح',
            'category' => 'مفاتيح سيارات',
            'image_url' => 'https://images.unsplash.com/photo-example',
            'description' => 'تفاصيل العمل',
        ]);

        $response->assertRedirect(route('admin.gallery.index'));
        $this->assertDatabaseHas('gallery_items', ['title' => 'صورة عمل برمجة مفتاح']);

        $item = GalleryItem::where('title', 'صورة عمل برمجة مفتاح')->first();

        // Update gallery item
        $updateResponse = $this->actingAs($this->admin)->put(route('admin.gallery.update', $item), [
            'title' => 'صورة عمل برمجة مفتاح معدلة',
            'category' => 'مفاتيح سيارات معدلة',
            'image_url' => 'https://images.unsplash.com/photo-updated',
            'description' => 'وصف معدل',
            'sort_order' => 2,
            'is_active' => 1,
        ]);
        $updateResponse->assertRedirect(route('admin.gallery.index'));
        $this->assertDatabaseHas('gallery_items', ['title' => 'صورة عمل برمجة مفتاح معدلة']);

        // Delete
        $this->actingAs($this->admin)->delete(route('admin.gallery.destroy', $item));
        $this->assertDatabaseMissing('gallery_items', ['id' => $item->id]);
    }

    public function test_admin_can_toggle_review_and_delete(): void
    {
        $review = Review::factory()->create(['is_approved' => false]);

        // Update review
        $updateResponse = $this->actingAs($this->admin)->put(route('admin.reviews.update', $review), [
            'client_name' => 'محمد السالم المعدل',
            'client_title' => 'حي الصحافة',
            'rating' => 5,
            'service_rendered' => 'برمجة ريموت',
            'comment' => 'تجربة ممتازة بعد التعديل',
            'is_approved' => 1,
        ]);
        $updateResponse->assertRedirect(route('admin.reviews.index'));
        $this->assertDatabaseHas('reviews', ['client_name' => 'محمد السالم المعدل']);

        // Toggle review
        $toggleResponse = $this->actingAs($this->admin)->patch(route('admin.reviews.toggle', $review));
        $toggleResponse->assertSessionHas('success');

        // Delete
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.reviews.destroy', $review));
        $this->assertDatabaseMissing('reviews', ['id' => $review->id]);
    }

    public function test_admin_can_manage_service_categories(): void
    {
        // 1. Create service category
        $response = $this->actingAs($this->admin)->post(route('admin.service-categories.store'), [
            'name' => 'تصنيف تجريبي جديد',
            'icon' => 'car-key',
            'description' => 'وصف التصنيف التجريبي',
            'sort_order' => 1,
            'is_active' => 1,
        ]);
        $response->assertRedirect(route('admin.service-categories.index'));
        $this->assertDatabaseHas('service_categories', ['name' => 'تصنيف تجريبي جديد']);

        $category = ServiceCategory::where('name', 'تصنيف تجريبي جديد')->first();

        // 2. Update service category
        $updateResponse = $this->actingAs($this->admin)->put(route('admin.service-categories.update', $category), [
            'name' => 'تصنيف تجريبي محدث',
            'icon' => 'lock-open',
            'description' => 'وصف محدث',
            'sort_order' => 3,
            'is_active' => 1,
        ]);
        $updateResponse->assertRedirect(route('admin.service-categories.index'));
        $this->assertDatabaseHas('service_categories', ['name' => 'تصنيف تجريبي محدث']);

        // 3. Delete service category
        $deleteResponse = $this->actingAs($this->admin)->delete(route('admin.service-categories.destroy', $category));
        $deleteResponse->assertRedirect(route('admin.service-categories.index'));
        $this->assertDatabaseMissing('service_categories', ['id' => $category->id]);
    }

    public function test_admin_can_manage_contact_messages(): void
    {
        $message = ContactMessage::factory()->create(['is_read' => false]);

        // Viewing the message marks it as read
        $this->actingAs($this->admin)->get(route('admin.messages.show', $message));
        $this->assertTrue($message->fresh()->is_read);

        // Add staff note
        $this->actingAs($this->admin)->post(route('admin.messages.notes', $message), [
            'notes' => 'تم الاتصال بالعميل وإرسال الفني',
        ]);
        $this->assertEquals('تم الاتصال بالعميل وإرسال الفني', $message->fresh()->notes);

        // Delete message
        $this->actingAs($this->admin)->delete(route('admin.messages.destroy', $message));
        $this->assertDatabaseMissing('contact_messages', ['id' => $message->id]);
    }

    public function test_admin_can_update_settings(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.settings.update'), [
            'phone' => '0558887766',
            'emergency_phone' => '0551110099',
            'site_name' => 'مفتاح الابداع  - الفرع الرئيسي',
        ]);

        $response->assertRedirect(route('admin.settings.index'));
        $this->assertEquals('0558887766', Setting::get('phone'));
        $this->assertEquals('مفتاح الابداع  - الفرع الرئيسي', Setting::get('site_name'));
    }

    public function test_admin_can_upload_logo_and_save_seo_settings(): void
    {
        Storage::fake('public');

        $logoFile = UploadedFile::fake()->image('custom-logo.png', 200, 60);
        $faviconFile = UploadedFile::fake()->create('custom-favicon.ico', 10, 'image/x-icon');
        $ogImageFile = UploadedFile::fake()->image('custom-og.jpg', 1200, 630);

        $response = $this->actingAs($this->admin)->post(route('admin.settings.update'), [
            'site_logo_file' => $logoFile,
            'site_favicon_file' => $faviconFile,
            'og_image_file' => $ogImageFile,
            'meta_keywords' => 'مفاتيح جدة, قص مفاتيح, فتح ابواب',
            'seo_robots' => 'index, follow',
            'seo_alternate_name' => 'محل مفتاح الابداع  المعتمد',
            'google_site_verification' => 'google-verify-code-12345',
            'google_analytics_id' => 'G-ABC123XYZ',
            'social_twitter' => 'https://x.com/baba_albustan',
            'social_instagram' => 'https://instagram.com/baba_albustan',
        ]);

        $response->assertRedirect(route('admin.settings.index'));
        $this->assertNotEmpty(Setting::get('site_logo'));
        $this->assertNotEmpty(Setting::get('site_favicon'));
        $this->assertNotEmpty(Setting::get('og_image'));
        $this->assertEquals('مفاتيح جدة, قص مفاتيح, فتح ابواب', Setting::get('meta_keywords'));
        $this->assertEquals('google-verify-code-12345', Setting::get('google_site_verification'));
        $this->assertEquals('G-ABC123XYZ', Setting::get('google_analytics_id'));
        $this->assertEquals('https://x.com/baba_albustan', Setting::get('social_twitter'));
    }

    public function test_admin_can_remove_logo_and_favicon(): void
    {
        Setting::set('site_logo', 'https://example.com/old-logo.png');
        Setting::set('site_favicon', 'https://example.com/old-favicon.ico');

        $response = $this->actingAs($this->admin)->post(route('admin.settings.update'), [
            'remove_site_logo' => '1',
            'remove_site_favicon' => '1',
        ]);

        $response->assertRedirect(route('admin.settings.index'));
        $this->assertEquals('', Setting::get('site_logo'));
        $this->assertEquals('', Setting::get('site_favicon'));
    }

    public function test_admin_can_manage_users_and_cannot_delete_self(): void
    {
        // Create user
        $response = $this->actingAs($this->admin)->post(route('admin.users.store'), [
            'name' => 'مشرف جديد',
            'email' => 'newsupervisor@keyshop.com',
            'password' => 'password123',
            'role' => 'manager',
            'phone' => '0500000001',
            'is_active' => 1,
        ]);

        $response->assertRedirect(route('admin.users.index'));
        $this->assertDatabaseHas('users', ['email' => 'newsupervisor@keyshop.com']);

        $user = User::where('email', 'newsupervisor@keyshop.com')->first();

        // Admin cannot delete their own logged-in account
        $selfDeleteResponse = $this->actingAs($this->admin)->delete(route('admin.users.destroy', $this->admin));
        $selfDeleteResponse->assertSessionHasErrors('error');
        $this->assertDatabaseHas('users', ['id' => $this->admin->id]);

        // Admin can delete other user
        $this->actingAs($this->admin)->delete(route('admin.users.destroy', $user));
        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_can_view_all_settings_tabs(): void
    {
        $tabs = ['branding', 'seo', 'social', 'contact', 'coverage', 'location', 'stats'];

        foreach ($tabs as $tab) {
            $response = $this->actingAs($this->admin)->get(route('admin.settings.index', ['tab' => $tab]));
            $response->assertStatus(200);
            $response->assertViewHas('activeTab', $tab);
            $response->assertSee('tab-panel-'.$tab, false);
        }
    }

    public function test_admin_can_update_tabs_independently_without_overwriting_others(): void
    {
        // 1. Set initial contact setting
        Setting::set('emergency_phone', '0559998877', 'contact');
        Setting::set('meta_keywords', 'كلمات مفتاحية أصلية', 'seo');

        // 2. Update branding tab independently
        $brandingResponse = $this->actingAs($this->admin)->post(route('admin.settings.update-tab', 'branding'), [
            'site_name' => 'مفتاح الابداع  المطور',
            'city_name' => 'جدة عروس البحر',
            'site_tagline' => 'خدمة 24 ساعة احترافية',
        ]);

        $brandingResponse->assertRedirect(route('admin.settings.index', ['tab' => 'branding']));
        $brandingResponse->assertSessionHas('success');
        $this->assertEquals('مفتاح الابداع  المطور', Setting::get('site_name'));
        $this->assertEquals('جدة عروس البحر', Setting::get('city_name'));

        // Verify other tabs were untouched
        $this->assertEquals('0559998877', Setting::get('emergency_phone'));
        $this->assertEquals('كلمات مفتاحية أصلية', Setting::get('meta_keywords'));

        // 3. Update SEO tab independently
        $seoResponse = $this->actingAs($this->admin)->post(route('admin.settings.update-tab', 'seo'), [
            'meta_description' => 'وصف سيو جديد ومميز لخدمات المفاتيح بجدة',
            'meta_keywords' => 'مفاتيح, سيارات, برمجة, بصمة',
            'seo_robots' => 'index, follow',
            'google_analytics_id' => 'G-TAB123456',
        ]);

        $seoResponse->assertRedirect(route('admin.settings.index', ['tab' => 'seo']));
        $this->assertEquals('وصف سيو جديد ومميز لخدمات المفاتيح بجدة', Setting::get('meta_description'));
        $this->assertEquals('G-TAB123456', Setting::get('google_analytics_id'));

        // 4. Update Social tab independently
        $socialResponse = $this->actingAs($this->admin)->post(route('admin.settings.update-tab', 'social'), [
            'social_twitter' => 'https://x.com/baba_albustan_tab',
            'social_instagram' => 'https://instagram.com/baba_albustan_tab',
        ]);

        $socialResponse->assertRedirect(route('admin.settings.index', ['tab' => 'social']));
        $this->assertEquals('https://x.com/baba_albustan_tab', Setting::get('social_twitter'));
        $this->assertEquals('https://instagram.com/baba_albustan_tab', Setting::get('social_instagram'));

        // 5. Update Contact tab independently
        $contactResponse = $this->actingAs($this->admin)->post(route('admin.settings.update-tab', 'contact'), [
            'emergency_phone' => '0551122334',
            'phone' => '0126655443',
            'whatsapp' => '966551122334',
            'email' => 'contact@albustan-keys.com',
        ]);

        $contactResponse->assertRedirect(route('admin.settings.index', ['tab' => 'contact']));
        $this->assertEquals('0551122334', Setting::get('emergency_phone'));
        $this->assertEquals('contact@albustan-keys.com', Setting::get('email'));

        // 6. Update Coverage tab independently
        $coverageResponse = $this->actingAs($this->admin)->post(route('admin.settings.update-tab', 'coverage'), [
            'coverage_areas' => 'البلد • الروضة • النزهة • الشاطئ',
            'coverage_note' => 'تغطية شاملة لجميع أحياء جدة',
        ]);

        $coverageResponse->assertRedirect(route('admin.settings.index', ['tab' => 'coverage']));
        $this->assertEquals('البلد • الروضة • النزهة • الشاطئ', Setting::get('coverage_areas'));

        // 7. Update Location tab independently
        $locationResponse = $this->actingAs($this->admin)->post(route('admin.settings.update-tab', 'location'), [
            'address' => 'جدة - شارع حراء - حي الزهراء',
            'working_hours' => '24 ساعة على مدار الأسبوع',
            'map_latitude' => '21.583333',
            'map_longitude' => '39.183333',
        ]);

        $locationResponse->assertRedirect(route('admin.settings.index', ['tab' => 'location']));
        $this->assertEquals('21.583333', Setting::get('map_latitude'));
        $this->assertEquals('39.183333', Setting::get('map_longitude'));

        // 8. Update Stats tab independently
        $statsResponse = $this->actingAs($this->admin)->post(route('admin.settings.update-tab', 'stats'), [
            'years_experience' => '20+',
            'arrival_time' => '10 - 20 دقيقة',
            'happy_clients' => '25,000+',
            'team_size' => '15 فني معتمد',
        ]);

        $statsResponse->assertRedirect(route('admin.settings.index', ['tab' => 'stats']));
        $this->assertEquals('20+', Setting::get('years_experience'));
        $this->assertEquals('15 فني معتمد', Setting::get('team_size'));
    }

    public function test_settings_tab_validation_errors(): void
    {
        // Emergency phone is required for contact tab
        $response = $this->actingAs($this->admin)->post(route('admin.settings.update-tab', 'contact'), [
            'emergency_phone' => '',
            'email' => 'not-an-email',
        ]);

        $response->assertSessionHasErrors(['emergency_phone', 'email']);

        // Social url validation
        $socialResponse = $this->actingAs($this->admin)->post(route('admin.settings.update-tab', 'social'), [
            'social_twitter' => 'not-a-valid-url',
        ]);

        $socialResponse->assertSessionHasErrors(['social_twitter']);
    }
}
