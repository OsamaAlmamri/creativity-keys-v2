<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse|JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'required|string|max:20',
            'service_needed' => 'nullable|string|max:150',
            'city_district' => 'nullable|string|max:100',
            'is_emergency' => 'nullable|boolean',
            'message' => 'required|string|max:2000',
        ], [
            'name.required' => 'يرجى إدخال الاسم الكريم',
            'phone.required' => 'يرجى إدخال رقم الجوال للتواصل السريع',
            'message.required' => 'يرجى كتابة تفاصيل طلبك أو مشكلتك',
        ]);

        $validated['is_emergency'] = $request->boolean('is_emergency');

        $contactMessage = ContactMessage::create($validated);

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'تم استلام طلبك بنجاح! سيتواصل معك أقرب فني متخصص خلال دقائق.',
                'data' => $contactMessage,
            ]);
        }

        return redirect()->to(url()->previous().'#contact')
            ->with('success', 'تم استلام طلبك بنجاح! سيتواصل معك أقرب فني متخصص خلال دقائق معدودة.');
    }
}
