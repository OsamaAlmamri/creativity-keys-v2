<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\GalleryItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index(): View
    {
        $items = GalleryItem::orderBy('sort_order')->orderBy('id', 'desc')->paginate(12);
        $categories = GalleryItem::select('category')->distinct()->pluck('category');

        return view('admin.gallery.index', compact('items', 'categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:190',
            'category' => 'required|string|max:100',
            'image_file' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
        ], [
            'title.required' => 'يرجى إدخال عنوان الصورة',
            'category.required' => 'يرجى تحديد التصنيف',
        ]);

        $imageUrl = $validated['image_url'] ?? null;

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('gallery', 'public');
            $imageUrl = Storage::url($path);
        }

        if (empty($imageUrl)) {
            return back()->withErrors(['image_url' => 'يرجى إما رفع ملف صورة أو تزويد رابط صورة مباشر.'])->withInput();
        }

        GalleryItem::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'image_url' => $imageUrl,
            'description' => $validated['description'] ?? null,
            'is_active' => true,
            'sort_order' => (int) ($validated['sort_order'] ?? 0),
        ]);

        return redirect()->route('admin.gallery.index')->with('success', 'تمت إضافة العمل إلى معرض الصور بنجاح.');
    }

    public function update(Request $request, GalleryItem $gallery): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:190',
            'category' => 'required|string|max:100',
            'image_file' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
            'description' => 'nullable|string|max:500',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ], [
            'title.required' => 'يرجى إدخال عنوان الصورة',
            'category.required' => 'يرجى تحديد التصنيف',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('gallery', 'public');
            $gallery->image_url = Storage::url($path);
        } elseif (! empty($validated['image_url'])) {
            $gallery->image_url = $validated['image_url'];
        }

        $gallery->title = $validated['title'];
        $gallery->category = $validated['category'];
        $gallery->description = $validated['description'] ?? null;
        $gallery->sort_order = (int) ($validated['sort_order'] ?? 0);
        $gallery->is_active = $request->boolean('is_active');
        $gallery->save();

        return redirect()->route('admin.gallery.index')->with('success', 'تم تحديث عنصر معرض الأعمال بنجاح.');
    }

    public function destroy(GalleryItem $gallery): RedirectResponse
    {
        $gallery->delete();

        return redirect()->route('admin.gallery.index')->with('success', 'تم حذف الصورة من المعرض.');
    }
}
