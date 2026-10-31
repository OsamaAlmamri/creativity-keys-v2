<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function index(): View
    {
        $reviews = Review::orderBy('sort_order')->orderBy('id', 'desc')->paginate(15);

        return view('admin.reviews.index', compact('reviews'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:100',
            'client_title' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'service_rendered' => 'nullable|string|max:150',
            'comment' => 'required|string|max:1000',
            'is_approved' => 'nullable|boolean',
        ]);

        $validated['is_approved'] = $request->boolean('is_approved', true);

        Review::create($validated);

        return redirect()->route('admin.reviews.index')->with('success', 'تمت إضافة التقييم بنجاح.');
    }

    public function update(Request $request, Review $review): RedirectResponse
    {
        $validated = $request->validate([
            'client_name' => 'required|string|max:100',
            'client_title' => 'nullable|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'service_rendered' => 'nullable|string|max:150',
            'comment' => 'required|string|max:1000',
            'is_approved' => 'nullable|boolean',
        ]);

        $validated['is_approved'] = $request->boolean('is_approved');

        $review->update($validated);

        return redirect()->route('admin.reviews.index')->with('success', 'تم تعديل بيانات التقييم بنجاح.');
    }

    public function toggleApproval(Review $review): RedirectResponse
    {
        $review->is_approved = ! $review->is_approved;
        $review->save();

        $status = $review->is_approved ? 'تم اعتماد التقييم وظهوره في الموقع.' : 'تم إخفاء التقييم عن الزوار.';

        return back()->with('success', $status);
    }

    public function destroy(Review $review): RedirectResponse
    {
        $review->delete();

        return redirect()->route('admin.reviews.index')->with('success', 'تم حذف التقييم.');
    }
}
