<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\ThemeService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ThemeController extends Controller
{
    /**
     * Show the theme customization settings page.
     */
    public function index(): View
    {
        $presets = ThemeService::presetColors();
        $fonts = ThemeService::supportedFonts();
        $activeColors = ThemeService::getActiveColors();

        $current = [
            'theme_preset' => Setting::get('theme_preset', 'amber'),
            'theme_custom_color' => Setting::get('theme_custom_color', '#f59e0b'),
            'theme_mode' => Setting::get('theme_mode', 'dark'),
            'theme_visitor_toggle' => (bool) Setting::get('theme_visitor_toggle', '1'),
            'theme_font' => Setting::get('theme_font', 'Cairo'),
            'theme_radius' => Setting::get('theme_radius', 'medium'),
            'show_emergency_ticker' => (bool) Setting::get('show_emergency_ticker', '1'),
            'show_header_contact_buttons' => (bool) Setting::get('show_header_contact_buttons', '1'),
            'show_floating_buttons' => (bool) Setting::get('show_floating_buttons', '1'),
            'show_home_articles' => (bool) Setting::get('show_home_articles', '1'),
            'header_style' => Setting::get('header_style', 'sticky'),
        ];

        return view('admin.theme.index', compact('presets', 'fonts', 'activeColors', 'current'));
    }

    /**
     * Update the theme settings.
     */
    public function update(Request $request): RedirectResponse
    {
        $allowedPresets = array_merge(array_keys(ThemeService::presetColors()), ['custom']);

        $validated = $request->validate([
            'theme_preset' => ['required', 'string', Rule::in($allowedPresets)],
            'theme_custom_color' => ['nullable', 'string', 'regex:/^#([a-fA-F0-9]{6}|[a-fA-F0-9]{3})$/'],
            'theme_mode' => ['required', 'string', 'in:dark,light,system'],
            'theme_visitor_toggle' => ['nullable', 'boolean'],
            'theme_font' => ['required', 'string', 'in:Cairo,Tajawal,Alexandria,Almarai'],
            'theme_radius' => ['required', 'string', 'in:sharp,medium,pill'],
            'show_emergency_ticker' => ['nullable', 'boolean'],
            'show_header_contact_buttons' => ['nullable', 'boolean'],
            'show_floating_buttons' => ['nullable', 'boolean'],
            'show_home_articles' => ['nullable', 'boolean'],
            'header_style' => ['required', 'string', 'in:sticky,static'],
        ]);

        Setting::set('theme_preset', $validated['theme_preset'], 'theme', 'نمط لون السمة');

        if (! empty($validated['theme_custom_color'])) {
            Setting::set('theme_custom_color', $validated['theme_custom_color'], 'theme', 'اللون المخصص');
        }

        Setting::set('theme_mode', $validated['theme_mode'], 'theme', 'وضع المظهر الافتراضي');
        Setting::set('theme_visitor_toggle', $request->has('theme_visitor_toggle') ? '1' : '0', 'theme', 'تبديل الوضع للزوار', 'boolean');
        Setting::set('theme_font', $validated['theme_font'], 'theme', 'نوع الخط العربي');
        Setting::set('theme_radius', $validated['theme_radius'], 'theme', 'نمط حواف العناصر');
        Setting::set('show_emergency_ticker', $request->has('show_emergency_ticker') ? '1' : '0', 'theme', 'إظهار شريط الطوارئ', 'boolean');
        Setting::set('show_header_contact_buttons', $request->has('show_header_contact_buttons') ? '1' : '0', 'theme', 'إظهار أزرار اتصال الهيدر', 'boolean');
        Setting::set('show_floating_buttons', $request->has('show_floating_buttons') ? '1' : '0', 'theme', 'إظهار أزرار الاتصال العائمة', 'boolean');
        Setting::set('show_home_articles', $request->has('show_home_articles') ? '1' : '0', 'theme', 'إظهار قسم المقالات بالرئيسية', 'boolean');
        Setting::set('header_style', $validated['header_style'], 'theme', 'نمط شريط التنقل');

        return redirect()->route('admin.theme.index')
            ->with('success', 'تم حفظ وتطبيق إعدادات الثيم والمظهر بنجاح! تم تحديث الموقع مباشرة.');
    }

    /**
     * Reset theme to default settings.
     */
    public function reset(): RedirectResponse
    {
        ThemeService::resetToDefaults();

        return redirect()->route('admin.theme.index')
            ->with('success', 'تمت استعادة إعدادات الثيم والمظهر الأصلية بنجاح.');
    }
}
