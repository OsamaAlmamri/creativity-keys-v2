<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index(): View
    {
        $services = Service::with('category')->orderBy('sort_order')->orderBy('id')->paginate(15);

        return view('admin.services.index', compact('services'));
    }

    public function create(): View
    {
        $categories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.services.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:service_categories,id',
            'title' => 'required|string|max:190',
            'slug' => 'nullable|string|max:190|unique:services,slug',
            'icon' => 'nullable|string|max:50',
            'badge' => 'nullable|string|max:100',
            'hero_subtitle' => 'nullable|string|max:255',
            'short_description' => 'required|string',
            'full_description' => 'nullable|string',
            'overview_title' => 'nullable|string|max:255',
            'overview_content' => 'nullable|string',
            'features_title' => 'nullable|string|max:255',
            'process_title' => 'nullable|string|max:255',
            'pricing_title' => 'nullable|string|max:255',
            'pricing_note' => 'nullable|string|max:255',
            'price_starting_at' => 'nullable|string|max:100',
            'features' => 'nullable|string', // comma or newline separated
            'meta_title' => 'nullable|string|max:190',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_emergency' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $featuresArray = [];
        if (! empty($validated['features'])) {
            $featuresArray = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n|,/', $validated['features']))));
        }

        $service = new Service;
        $service->category_id = $validated['category_id'] ?? null;
        $service->title = $validated['title'];
        $service->slug = ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']).'-'.Str::random(4);
        $service->icon = $validated['icon'] ?? 'key';
        $service->badge = $validated['badge'] ?? null;
        $service->hero_subtitle = $validated['hero_subtitle'] ?? null;
        $service->short_description = $validated['short_description'];
        $service->full_description = $validated['full_description'] ?? null;
        $service->overview_title = $validated['overview_title'] ?? null;
        $service->overview_content = $validated['overview_content'] ?? null;
        $service->features_title = $validated['features_title'] ?? null;
        $service->process_title = $validated['process_title'] ?? null;
        $service->pricing_title = $validated['pricing_title'] ?? null;
        $service->pricing_note = $validated['pricing_note'] ?? null;
        $service->price_starting_at = $validated['price_starting_at'] ?? null;
        $service->features = $featuresArray;
        $service->meta_title = $validated['meta_title'] ?? null;
        $service->meta_description = $validated['meta_description'] ?? null;
        $service->meta_keywords = $validated['meta_keywords'] ?? null;
        $service->is_emergency = $request->boolean('is_emergency');
        $service->is_active = $request->boolean('is_active', true);
        $service->sort_order = (int) ($validated['sort_order'] ?? 0);
        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'تمت إضافة الخدمة بنجاح.');
    }

    public function edit(Service $service): View
    {
        $categories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();
        $service->load(['featuresList', 'faqs', 'pricingTiers']);

        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:service_categories,id',
            'title' => 'required|string|max:190',
            'slug' => 'nullable|string|max:190|unique:services,slug,'.$service->id,
            'icon' => 'nullable|string|max:50',
            'badge' => 'nullable|string|max:100',
            'hero_subtitle' => 'nullable|string|max:255',
            'short_description' => 'required|string',
            'full_description' => 'nullable|string',
            'overview_title' => 'nullable|string|max:255',
            'overview_content' => 'nullable|string',
            'features_title' => 'nullable|string|max:255',
            'process_title' => 'nullable|string|max:255',
            'pricing_title' => 'nullable|string|max:255',
            'pricing_note' => 'nullable|string|max:255',
            'price_starting_at' => 'nullable|string|max:100',
            'features' => 'nullable|string',
            'meta_title' => 'nullable|string|max:190',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_emergency' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
        ]);

        $featuresArray = [];
        if (! empty($validated['features'])) {
            $featuresArray = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n|,/', $validated['features']))));
        }

        $service->category_id = $validated['category_id'] ?? null;
        $service->title = $validated['title'];
        if (! empty($validated['slug'])) {
            $service->slug = Str::slug($validated['slug']);
        }
        $service->icon = $validated['icon'] ?? $service->icon;
        $service->badge = $validated['badge'] ?? $service->badge;
        $service->hero_subtitle = $validated['hero_subtitle'] ?? $service->hero_subtitle;
        $service->short_description = $validated['short_description'];
        $service->full_description = $validated['full_description'] ?? null;
        $service->overview_title = $validated['overview_title'] ?? $service->overview_title;
        $service->overview_content = $validated['overview_content'] ?? $service->overview_content;
        $service->features_title = $validated['features_title'] ?? $service->features_title;
        $service->process_title = $validated['process_title'] ?? $service->process_title;
        $service->pricing_title = $validated['pricing_title'] ?? $service->pricing_title;
        $service->pricing_note = $validated['pricing_note'] ?? $service->pricing_note;
        $service->price_starting_at = $validated['price_starting_at'] ?? null;
        $service->features = $featuresArray;
        $service->meta_title = $validated['meta_title'] ?? $service->meta_title;
        $service->meta_description = $validated['meta_description'] ?? $service->meta_description;
        $service->meta_keywords = $validated['meta_keywords'] ?? $service->meta_keywords;
        $service->is_emergency = $request->boolean('is_emergency');
        $service->is_active = $request->boolean('is_active');
        $service->sort_order = (int) ($validated['sort_order'] ?? 0);
        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'تم تحديث بيانات الخدمة بنجاح.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'تم حذف الخدمة بنجاح.');
    }
}
