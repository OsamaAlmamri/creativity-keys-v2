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
            'short_description' => 'required|string',
            'full_description' => 'nullable|string',
            'price_starting_at' => 'nullable|string|max:100',
            'features' => 'nullable|string', // comma or newline separated
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
        $service->short_description = $validated['short_description'];
        $service->full_description = $validated['full_description'] ?? null;
        $service->price_starting_at = $validated['price_starting_at'] ?? null;
        $service->features = $featuresArray;
        $service->is_emergency = $request->boolean('is_emergency');
        $service->is_active = $request->boolean('is_active', true);
        $service->sort_order = (int) ($validated['sort_order'] ?? 0);
        $service->save();

        return redirect()->route('admin.services.index')->with('success', 'تمت إضافة الخدمة بنجاح.');
    }

    public function edit(Service $service): View
    {
        $categories = ServiceCategory::where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.services.edit', compact('service', 'categories'));
    }

    public function update(Request $request, Service $service): RedirectResponse
    {
        $validated = $request->validate([
            'category_id' => 'nullable|exists:service_categories,id',
            'title' => 'required|string|max:190',
            'slug' => 'nullable|string|max:190|unique:services,slug,'.$service->id,
            'icon' => 'nullable|string|max:50',
            'short_description' => 'required|string',
            'full_description' => 'nullable|string',
            'price_starting_at' => 'nullable|string|max:100',
            'features' => 'nullable|string',
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
        $service->short_description = $validated['short_description'];
        $service->full_description = $validated['full_description'] ?? null;
        $service->price_starting_at = $validated['price_starting_at'] ?? null;
        $service->features = $featuresArray;
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
