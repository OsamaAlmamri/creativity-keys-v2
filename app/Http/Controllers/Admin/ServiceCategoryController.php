<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceCategoryController extends Controller
{
    public function index(): View
    {
        $categories = ServiceCategory::withCount('services')
            ->orderBy('sort_order')
            ->orderBy('id')
            ->get();

        return view('admin.services.categories', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:100|unique:service_categories,slug',
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ], [
            'name.required' => 'اسم صنف الخدمة مطلوب',
            'slug.unique' => 'الاسم اللطيف (slug) مستخدم مسبقاً',
        ]);

        ServiceCategory::create([
            'name' => $validated['name'],
            'slug' => ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['name']).'-'.Str::random(4),
            'icon' => $validated['icon'] ?? 'key',
            'description' => $validated['description'] ?? null,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
            'is_active' => $request->boolean('is_active', true),
        ]);

        return redirect()->route('admin.service-categories.index')->with('success', 'تمت إضافة صنف الخدمة بنجاح.');
    }

    public function update(Request $request, ServiceCategory $serviceCategory): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'slug' => 'nullable|string|max:100|unique:service_categories,slug,'.$serviceCategory->id,
            'icon' => 'nullable|string|max:50',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ], [
            'name.required' => 'اسم صنف الخدمة مطلوب',
        ]);

        $serviceCategory->name = $validated['name'];
        if (! empty($validated['slug'])) {
            $serviceCategory->slug = Str::slug($validated['slug']);
        }
        $serviceCategory->icon = $validated['icon'] ?? $serviceCategory->icon;
        $serviceCategory->description = $validated['description'] ?? null;
        $serviceCategory->sort_order = (int) ($validated['sort_order'] ?? 0);
        $serviceCategory->is_active = $request->boolean('is_active');
        $serviceCategory->save();

        return redirect()->route('admin.service-categories.index')->with('success', 'تم تحديث صنف الخدمة بنجاح.');
    }

    public function destroy(ServiceCategory $serviceCategory): RedirectResponse
    {
        $serviceCategory->delete();

        return redirect()->route('admin.service-categories.index')->with('success', 'تم حذف صنف الخدمة بنجاح.');
    }
}
