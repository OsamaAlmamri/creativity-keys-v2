<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthAndDashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get(route('admin.dashboard'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_login_with_correct_credentials(): void
    {
        $user = User::factory()->create([
            'email' => 'admin@keyshop.com',
            'password' => Hash::make('password123'),
            'role' => 'admin',
            'is_active' => true,
        ]);

        $response = $this->post(route('admin.login.submit'), [
            'email' => 'admin@keyshop.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_inactive_user_cannot_login(): void
    {
        User::factory()->create([
            'email' => 'inactive@keyshop.com',
            'password' => Hash::make('password123'),
            'role' => 'manager',
            'is_active' => false,
        ]);

        $response = $this->post(route('admin.login.submit'), [
            'email' => 'inactive@keyshop.com',
            'password' => 'password123',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest();
    }

    public function test_admin_can_access_dashboard_and_users_management(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);
        $response->assertSee('لوحة التحكم الرئيسية');

        $usersResponse = $this->actingAs($admin)->get(route('admin.users.index'));
        $usersResponse->assertStatus(200);
        $usersResponse->assertSee('إدارة المستخدمين وصلاحيات لوحة التحكم');
    }

    public function test_manager_cannot_access_users_management(): void
    {
        $manager = User::factory()->create([
            'role' => 'manager',
            'is_active' => true,
        ]);

        $response = $this->actingAs($manager)->get(route('admin.users.index'));
        $response->assertStatus(403);
    }
}
