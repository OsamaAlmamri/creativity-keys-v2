<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function index(Request $request): View
    {
        $query = ContactMessage::orderBy('created_at', 'desc');

        if ($request->filled('filter')) {
            if ($request->filter === 'unread') {
                $query->where('is_read', false);
            } elseif ($request->filter === 'emergency') {
                $query->where('is_emergency', true);
            }
        }

        $messages = $query->paginate(15);
        $unreadCount = ContactMessage::where('is_read', false)->count();

        return view('admin.messages.index', compact('messages', 'unreadCount'));
    }

    public function show(ContactMessage $message): View
    {
        if (! $message->is_read) {
            $message->is_read = true;
            $message->save();
        }

        return view('admin.messages.show', compact('message'));
    }

    public function markAsRead(Request $request, ContactMessage $message): RedirectResponse
    {
        $message->is_read = ! $message->is_read;
        $message->save();

        return back()->with('success', 'تم تعديل حالة القراءة للرسالة.');
    }

    public function updateNotes(Request $request, ContactMessage $message): RedirectResponse
    {
        $request->validate(['notes' => 'nullable|string|max:1000']);
        $message->notes = $request->input('notes');
        $message->save();

        return back()->with('success', 'تم حفظ الملاحظات الداخلية بنجاح.');
    }

    public function destroy(ContactMessage $message): RedirectResponse
    {
        $message->delete();

        return redirect()->route('admin.messages.index')->with('success', 'تم حذف الرسالة بنجاح.');
    }
}
