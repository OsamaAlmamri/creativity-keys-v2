<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Article;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ArticleController extends Controller
{
    public function index(Request $request): View
    {
        $query = Article::orderBy('created_at', 'desc');

        if ($request->filled('status')) {
            if ($request->status === 'published') {
                $query->where('is_published', true);
            } elseif ($request->status === 'draft') {
                $query->where('is_published', false);
            }
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        $articles = $query->paginate(12);
        $categories = Article::select('category')->distinct()->pluck('category');

        return view('admin.articles.index', compact('articles', 'categories'));
    }

    public function create(): View
    {
        $existingCategories = Article::select('category')->distinct()->pluck('category');

        return view('admin.articles.create', compact('existingCategories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:220',
            'slug' => 'nullable|string|max:220|unique:articles,slug',
            'category' => 'required|string|max:100',
            'excerpt' => 'required|string|max:1000',
            'content' => 'required|string',
            'image_file' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
            'read_time' => 'nullable|string|max:50',
            'is_published' => 'nullable|boolean',
        ], [
            'title.required' => 'عنوان المقال مطلوب',
            'excerpt.required' => 'المقدمة المختصرة للمقال مطلوبة',
            'content.required' => 'نص ومحتوى المقال مطلوب',
        ]);

        $imageUrl = $validated['image_url'] ?? null;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('articles', 'public');
            $imageUrl = Storage::url($path);
        }

        $isPublished = $request->boolean('is_published', true);

        Article::create([
            'title' => $validated['title'],
            'slug' => ! empty($validated['slug']) ? Str::slug($validated['slug']) : Str::slug($validated['title']).'-'.Str::random(5),
            'category' => $validated['category'],
            'image_url' => $imageUrl ?? 'https://images.unsplash.com/photo-1617814076367-b759c7d7e738?auto=format&fit=crop&w=800&q=80',
            'excerpt' => $validated['excerpt'],
            'content' => $validated['content'],
            'read_time' => $validated['read_time'] ?? '3 دقائق قراءة',
            'is_published' => $isPublished,
            'published_at' => $isPublished ? now() : null,
        ]);

        return redirect()->route('admin.articles.index')->with('success', 'تم إنشاء ونشر المقال بنجاح.');
    }

    public function edit(Article $article): View
    {
        $existingCategories = Article::select('category')->distinct()->pluck('category');

        return view('admin.articles.edit', compact('article', 'existingCategories'));
    }

    public function update(Request $request, Article $article): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:220',
            'slug' => 'nullable|string|max:220|unique:articles,slug,'.$article->id,
            'category' => 'required|string|max:100',
            'excerpt' => 'required|string|max:1000',
            'content' => 'required|string',
            'image_file' => 'nullable|image|max:5120',
            'image_url' => 'nullable|url|max:500',
            'read_time' => 'nullable|string|max:50',
            'is_published' => 'nullable|boolean',
        ], [
            'title.required' => 'عنوان المقال مطلوب',
            'excerpt.required' => 'المقدمة المختصرة للمقال مطلوبة',
            'content.required' => 'نص ومحتوى المقال مطلوب',
        ]);

        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('articles', 'public');
            $article->image_url = Storage::url($path);
        } elseif (! empty($validated['image_url'])) {
            $article->image_url = $validated['image_url'];
        }

        $isPublished = $request->boolean('is_published');

        $article->title = $validated['title'];
        if (! empty($validated['slug'])) {
            $article->slug = Str::slug($validated['slug']);
        }
        $article->category = $validated['category'];
        $article->excerpt = $validated['excerpt'];
        $article->content = $validated['content'];
        $article->read_time = $validated['read_time'] ?? $article->read_time;

        if ($isPublished && ! $article->is_published) {
            $article->published_at = now();
        }
        $article->is_published = $isPublished;
        $article->save();

        return redirect()->route('admin.articles.index')->with('success', 'تم تحديث المقال بنجاح.');
    }

    public function toggle(Article $article): RedirectResponse
    {
        $article->is_published = ! $article->is_published;
        if ($article->is_published && empty($article->published_at)) {
            $article->published_at = now();
        }
        $article->save();

        $msg = $article->is_published ? 'تم نشر المقال في الموقع للزوار.' : 'تم تحويل المقال إلى مسودة مخفية.';

        return back()->with('success', $msg);
    }

    public function destroy(Article $article): RedirectResponse
    {
        $article->delete();

        return redirect()->route('admin.articles.index')->with('success', 'تم حذف المقال بنجاح.');
    }
}
