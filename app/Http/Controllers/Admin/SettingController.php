<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(): View
    {
        $settings = Setting::all()->groupBy('group');

        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'site_logo_file' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:3072',
            'site_favicon_file' => 'nullable|mimes:ico,png,svg,jpg,jpeg,webp|max:1024',
            'og_image_file' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:4096',
        ], [
            'site_logo_file.image' => 'يجب أن يكون ملف الشعار صورة صالحة.',
            'site_logo_file.max' => 'يجب ألا يتجاوز حجم ملف الشعار 3 ميجابايت.',
            'site_favicon_file.max' => 'يجب ألا يتجاوز حجم ملف الأيقونة 1 ميجابايت.',
            'og_image_file.image' => 'يجب أن تكون صورة المشاركة ملف صورة صالح.',
            'og_image_file.max' => 'يجب ألا يتجاوز حجم صورة المشاركة 4 ميجابايت.',
        ]);

        // 1. Site Logo
        if ($request->boolean('remove_site_logo')) {
            Setting::set('site_logo', '', 'branding', 'شعار الموقع الرئيسي');
        } elseif ($request->hasFile('site_logo_file')) {
            $path = $request->file('site_logo_file')->store('branding', 'public');
            Setting::set('site_logo', Storage::url($path), 'branding', 'شعار الموقع الرئيسي');
        } elseif ($request->has('site_logo')) {
            Setting::set('site_logo', $request->input('site_logo') ?? '', 'branding', 'شعار الموقع الرئيسي');
        }

        // 2. Favicon
        if ($request->boolean('remove_site_favicon')) {
            Setting::set('site_favicon', '', 'branding', 'أيقونة الموقع (Favicon)');
        } elseif ($request->hasFile('site_favicon_file')) {
            $path = $request->file('site_favicon_file')->store('branding', 'public');
            Setting::set('site_favicon', Storage::url($path), 'branding', 'أيقونة الموقع (Favicon)');
        } elseif ($request->has('site_favicon')) {
            Setting::set('site_favicon', $request->input('site_favicon') ?? '', 'branding', 'أيقونة الموقع (Favicon)');
        }

        // 3. OG Image (Social Share Image)
        if ($request->boolean('remove_og_image')) {
            Setting::set('og_image', '', 'seo', 'صورة المشاركة الافتراضية');
        } elseif ($request->hasFile('og_image_file')) {
            $path = $request->file('og_image_file')->store('seo', 'public');
            Setting::set('og_image', Storage::url($path), 'seo', 'صورة المشاركة الافتراضية');
        } elseif ($request->has('og_image')) {
            Setting::set('og_image', $request->input('og_image') ?? '', 'seo', 'صورة المشاركة الافتراضية');
        }

        $inputs = $request->except([
            '_token',
            '_method',
            'site_logo_file',
            'site_favicon_file',
            'og_image_file',
            'remove_site_logo',
            'remove_site_favicon',
            'remove_og_image',
            'site_logo',
            'site_favicon',
            'og_image',
        ]);

        foreach ($inputs as $key => $value) {
            Setting::set($key, $value);
        }

        return redirect()->route('admin.settings.index')->with('success', 'تم حفظ إعدادات الموقع والهوية ومحركات البحث بنجاح وتحديث الواجهة مباشرة.');
    }
}
