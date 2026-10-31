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

    public function test_admin_layout_has_well_formed_header_sidebar_and_breadcrumbs(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
            'is_active' => true,
        ]);

        $response = $this->actingAs($admin)->get(route('admin.dashboard'));
        $response->assertStatus(200);

        // Sidebar & drawer
        $response->assertSee('id="admin-sidebar"', false);
        $response->assertSee('id="mobile-sidebar"', false);

        // Header and breadcrumb structure
        $response->assertSee('admin-header', false);
        $response->assertSee('admin-breadcrumb', false);
        $response->assertSee('handleSidebarToggle()', false);
        $response->assertSee('طوارئ 24/7 نشط', false);

        // Check theme style includes admin breadcrumb styling
        $response->assertSee('html.theme-light .admin-header', false);
        $response->assertSee('html.theme-light .admin-breadcrumb', false);

        // Check global delete confirmation modal is included
        $response->assertSee('id="delete-modal"', false);
        $response->assertSee('id="delete-modal-backdrop"', false);
        $response->assertSee('openDeleteModal', false);
        $response->assertSee('closeDeleteModal', false);
        $response->assertSee('submitDeleteModalForm', false);
    }
}
