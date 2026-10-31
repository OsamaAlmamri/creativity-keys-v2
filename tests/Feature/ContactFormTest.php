<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactFormTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_submit_contact_form(): void
    {
        $payload = [
            'name' => 'خالد السالم',
            'phone' => '0551112233',
            'service_needed' => 'فتح باب شقة',
            'city_district' => 'حي الملز',
            'is_emergency' => '1',
            'message' => 'أنا محتجز خارج الشقة والمفتاح بالداخل.',
        ];

        $response = $this->post(route('contact.store'), $payload);

        $response->assertSessionHas('success');
        $this->assertDatabaseHas('contact_messages', [
            'name' => 'خالد السالم',
            'phone' => '0551112233',
            'is_emergency' => true,
        ]);
    }

    public function test_contact_form_requires_name_phone_and_message(): void
    {
        $response = $this->post(route('contact.store'), []);

        $response->assertSessionHasErrors(['name', 'phone', 'message']);
    }
}
