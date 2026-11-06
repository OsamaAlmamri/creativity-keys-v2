<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\ServiceCategory;
use App\Models\ServiceFaq;
use App\Models\ServiceFeature;
use App\Models\ServicePricingTier;
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
            'features' => 'nullable|string',
            'meta_title' => 'nullable|string|max:190',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'is_emergency' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'sort_order' => 'nullable|integer',
            'steps' => 'nullable|array',
            'sub_features' => 'nullable|array',
            'pricing_tiers' => 'nullable|array',
            'faqs' => 'nullable|array',
        ]);

        $featuresArray = [];
        if (! empty($validated['features'])) {
            $featuresArray = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n|,/', $validated['features']))));
        }

        // Clean steps array
        $stepsArray = [];
        if ($request->has('steps') && is_array($request->input('steps'))) {
            $idx = 1;
            foreach ($request->input('steps') as $stepItem) {
                if (! empty($stepItem['title'])) {
                    $stepsArray[] = [
                        'step' => $idx++,
                        'title' => trim($stepItem['title']),
                        'desc' => trim($stepItem['desc'] ?? ''),
                    ];
                }
            }
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
        $service->steps = ! empty($stepsArray) ? $stepsArray : null;
        $service->meta_title = $validated['meta_title'] ?? null;
        $service->meta_description = $validated['meta_description'] ?? null;
        $service->meta_keywords = $validated['meta_keywords'] ?? null;
        $service->is_emergency = $request->boolean('is_emergency');
        $service->is_active = $request->boolean('is_active', true);
        $service->sort_order = (int) ($validated['sort_order'] ?? 0);
        $service->save();

        // Sync Sub-Features
        if ($request->has('sub_features') && is_array($request->input('sub_features'))) {
            foreach ($request->input('sub_features') as $order => $f) {
                if (! empty($f['title'])) {
                    ServiceFeature::create([
                        'service_id' => $service->id,
                        'title' => trim($f['title']),
                        'description' => trim($f['description'] ?? ''),
                        'icon' => $f['icon'] ?? 'sparkles',
                        'badge' => $f['badge'] ?? null,
                        'sort_order' => $order + 1,
                    ]);
                }
            }
        }

        // Sync Pricing Tiers
        if ($request->has('pricing_tiers') && is_array($request->input('pricing_tiers'))) {
            foreach ($request->input('pricing_tiers') as $order => $p) {
                if (! empty($p['name'])) {
                    ServicePricingTier::create([
                        'service_id' => $service->id,
                        'name' => trim($p['name']),
                        'price' => trim($p['price'] ?? ''),
                        'note' => $p['note'] ?? null,
                        'sort_order' => $order + 1,
                    ]);
                }
            }
        }

        // Sync FAQs
        if ($request->has('faqs') && is_array($request->input('faqs'))) {
            foreach ($request->input('faqs') as $order => $q) {
                if (! empty($q['question']) && ! empty($q['answer'])) {
                    ServiceFaq::create([
                        'service_id' => $service->id,
                        'question' => trim($q['question']),
                        'answer' => trim($q['answer']),
                        'sort_order' => $order + 1,
                    ]);
                }
            }
        }

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
            'steps' => 'nullable|array',
            'sub_features' => 'nullable|array',
            'pricing_tiers' => 'nullable|array',
            'faqs' => 'nullable|array',
        ]);

        $featuresArray = [];
        if (! empty($validated['features'])) {
            $featuresArray = array_values(array_filter(array_map('trim', preg_split('/\r\n|\r|\n|,/', $validated['features']))));
        }

        // Clean steps array if passed
        if ($request->has('steps') && is_array($request->input('steps'))) {
            $stepsArray = [];
            $idx = 1;
            foreach ($request->input('steps') as $stepItem) {
                if (! empty($stepItem['title'])) {
                    $stepsArray[] = [
                        'step' => $idx++,
                        'title' => trim($stepItem['title']),
                        'desc' => trim($stepItem['desc'] ?? ''),
                    ];
                }
            }
            $service->steps = $stepsArray;
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

        // Sync Sub-Features if present in request
        if ($request->has('sub_features') && is_array($request->input('sub_features'))) {
            $service->featuresList()->delete();
            foreach ($request->input('sub_features') as $order => $f) {
                if (! empty($f['title'])) {
                    ServiceFeature::create([
                        'service_id' => $service->id,
                        'title' => trim($f['title']),
                        'description' => trim($f['description'] ?? ''),
                        'icon' => $f['icon'] ?? 'sparkles',
                        'badge' => $f['badge'] ?? null,
                        'sort_order' => $order + 1,
                    ]);
                }
            }
        }

        // Sync Pricing Tiers if present in request
        if ($request->has('pricing_tiers') && is_array($request->input('pricing_tiers'))) {
            $service->pricingTiers()->delete();
            foreach ($request->input('pricing_tiers') as $order => $p) {
                if (! empty($p['name'])) {
                    ServicePricingTier::create([
                        'service_id' => $service->id,
                        'name' => trim($p['name']),
                        'price' => trim($p['price'] ?? ''),
                        'note' => $p['note'] ?? null,
                        'sort_order' => $order + 1,
                    ]);
                }
            }
        }

        // Sync FAQs if present in request
        if ($request->has('faqs') && is_array($request->input('faqs'))) {
            $service->faqs()->delete();
            foreach ($request->input('faqs') as $order => $q) {
                if (! empty($q['question']) && ! empty($q['answer'])) {
                    ServiceFaq::create([
                        'service_id' => $service->id,
                        'question' => trim($q['question']),
                        'answer' => trim($q['answer']),
                        'sort_order' => $order + 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.services.index')->with('success', 'تم تحديث بيانات الخدمة بنجاح.');
    }

    public function destroy(Service $service): RedirectResponse
    {
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'تم حذف الخدمة بنجاح.');
    }
}
