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
            'site_name' => 'مركز مفاتيح الأمان المتطور',
        ]);

        $response->assertRedirect(route('admin.settings.index'));
        $this->assertEquals('0558887766', Setting::get('phone'));
        $this->assertEquals('مركز مفاتيح الأمان المتطور', Setting::get('site_name'));
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
}
