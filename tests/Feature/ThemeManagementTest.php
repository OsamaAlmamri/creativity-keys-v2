<?php

namespace Tests\Feature;

use App\Models\Setting;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ThemeManagementTest extends TestCase
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

    public function test_guests_cannot_access_theme_settings(): void
    {
        $response = $this->get(route('admin.theme.index'));
        $response->assertRedirect(route('admin.login'));
    }

    public function test_admin_can_view_theme_settings_page(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.theme.index'));

        $response->assertStatus(200);
        $response->assertSee('تخصيص المظهر والثيم والهوية البصرية');
        $response->assertSee('الأزرق الملكي');
        $response->assertSee('خط تجوال');
        $response->assertSee('الوضع الليلي الفاخر');
    }

    public function test_admin_can_update_theme_settings(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.theme.update'), [
            'theme_preset' => 'blue',
            'theme_mode' => 'light',
            'theme_visitor_toggle' => 1,
            'theme_font' => 'Tajawal',
            'theme_radius' => 'pill',
            'show_emergency_ticker' => 1,
            'show_header_contact_buttons' => 1,
            'show_floating_buttons' => 1,
            'show_home_articles' => 1,
            'header_style' => 'sticky',
        ]);

        $response->assertRedirect(route('admin.theme.index'));
        $response->assertSessionHas('success');

        $this->assertEquals('blue', Setting::get('theme_preset'));
        $this->assertEquals('light', Setting::get('theme_mode'));
        $this->assertEquals('Tajawal', Setting::get('theme_font'));
        $this->assertEquals('pill', Setting::get('theme_radius'));
        $this->assertEquals('1', Setting::get('show_header_contact_buttons'));
    }

    public function test_admin_can_set_custom_color(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.theme.update'), [
            'theme_preset' => 'custom',
            'theme_custom_color' => '#14b8a6',
            'theme_mode' => 'dark',
            'theme_font' => 'Alexandria',
            'theme_radius' => 'sharp',
            'header_style' => 'static',
        ]);

        $response->assertRedirect(route('admin.theme.index'));
        $this->assertEquals('custom', Setting::get('theme_preset'));
        $this->assertEquals('#14b8a6', Setting::get('theme_custom_color'));
        $this->assertEquals('Alexandria', Setting::get('theme_font'));
    }

    public function test_admin_can_select_sage_creativity_preset(): void
    {
        $response = $this->actingAs($this->admin)->post(route('admin.theme.update'), [
            'theme_preset' => 'sage',
            'theme_mode' => 'dark',
            'theme_visitor_toggle' => 1,
            'theme_font' => 'Cairo',
            'theme_radius' => 'medium',
            'header_style' => 'sticky',
        ]);

        $response->assertRedirect(route('admin.theme.index'));
        $this->assertEquals('sage', Setting::get('theme_preset'));

        $publicResponse = $this->get(route('home'));
        $publicResponse->assertStatus(200);
        $publicResponse->assertSee('#588157', false); // Sage 500
        $publicResponse->assertSee('#4a6b53', false); // Sage 600
        $publicResponse->assertSee('88, 129, 87', false); // Sage RGB
    }

    public function test_public_pages_render_theme_styles_and_variables(): void
    {
        Setting::set('theme_preset', 'emerald', 'theme');
        Setting::set('theme_font', 'Almarai', 'theme');

        $response = $this->get(route('home'));

        $response->assertStatus(200);
        $response->assertSee('--brand-font: \'Almarai\'', false);
        $response->assertSee('#10b981', false); // Emerald 500
        $response->assertSee('--brand-300: #6ee7b7', false); // Emerald 300
        $response->assertSee('--brand-700: #047857', false); // Emerald 700
        $response->assertSee('hero-radial-glow', false);
        $response->assertSee('hover-brand-card', false);
    }

    public function test_emergency_ticker_can_be_hidden(): void
    {
        Setting::set('show_emergency_ticker', '0', 'theme');

        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertDontSee('طوارئ 24/7:');
    }

    public function test_header_contact_buttons_can_be_hidden_and_shown(): void
    {
        // 1. By default or enabled: header contact buttons are visible
        Setting::set('show_header_contact_buttons', '1', 'theme');
        $response = $this->get(route('home'));
        $response->assertStatus(200);
        $response->assertSee('<span>واتساب</span>', false);
        $response->assertSee('<span>اتصال طوارئ 24/7</span>', false);

        // 2. When disabled: header contact buttons are hidden and theme toggle switches to refined pill
        Setting::set('show_header_contact_buttons', '0', 'theme');
        $responseDisabled = $this->get(route('home'));
        $responseDisabled->assertStatus(200);
        $responseDisabled->assertDontSee('<span>واتساب</span>', false);
        $responseDisabled->assertDontSee('<span>اتصال طوارئ 24/7</span>', false);
        $responseDisabled->assertDontSee('محادثة واتساب سريعة', false);
        $responseDisabled->assertSee('theme-text-sun', false);
        $responseDisabled->assertSee('الوضع الليلي', false);
        $responseDisabled->assertSee('emergency-ticker-btn', false);
    }

    public function test_admin_can_reset_theme_to_defaults(): void
    {
        // First change to blue
        Setting::set('theme_preset', 'blue', 'theme');
        Setting::set('theme_font', 'Tajawal', 'theme');

        $response = $this->actingAs($this->admin)->post(route('admin.theme.reset'));

        $response->assertRedirect(route('admin.theme.index'));
        $response->assertSessionHas('success');

        $this->assertEquals('custom', Setting::get('theme_preset'));
        $this->assertEquals('#588157', Setting::get('theme_custom_color'));
        $this->assertEquals('Cairo', Setting::get('theme_font'));
    }

    public function test_light_mode_provides_harmonized_colors_and_protects_white_text_on_buttons(): void
    {
        $response = $this->get(route('home'));

        $response->assertStatus(200);
        // Confirms light mode styles exist in template
        $response->assertSee('html.theme-light body', false);
        $response->assertSee('html.theme-light .bg-emerald-600', false);
        $response->assertSee('html.theme-light h1', false);
        $response->assertSee('html.theme-light header nav a', false);
        $response->assertSee('html.theme-light aside', false);
    }

    public function test_modern_switches_and_controls_render_in_theme_settings(): void
    {
        $response = $this->actingAs($this->admin)->get(route('admin.theme.index'));
        $response->assertStatus(200);

        // Modern switch structure
        $response->assertSee('modern-switch-track', false);
        $response->assertSee('modern-switch-thumb', false);
        $response->assertSee('modern-switch-input', false);

        // Header segmented control
        $response->assertSee('header-style-segmented', false);

        // Check CSS styling in theme-styles
        $response->assertSee('.modern-switch-track', false);
        $response->assertSee('html.theme-light .modern-switch-track', false);
        $response->assertSee('html.theme-light .modern-switch-input:checked + .modern-switch-track', false);
    }
}
