<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\GalleryItem;
use App\Models\Review;
use App\Models\Service;
use App\Models\User;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'services_count' => Service::count(),
            'gallery_count' => GalleryItem::count(),
            'reviews_count' => Review::count(),
            'pending_reviews' => Review::where('is_approved', false)->count(),
            'messages_count' => ContactMessage::count(),
            'unread_messages' => ContactMessage::where('is_read', false)->count(),
            'emergency_messages' => ContactMessage::where('is_emergency', true)->where('is_read', false)->count(),
            'users_count' => User::count(),
        ];

        $latestMessages = ContactMessage::orderBy('created_at', 'desc')->take(6)->get();
        $recentServices = Service::orderBy('sort_order')->take(4)->get();

        return view('admin.dashboard', compact('stats', 'latestMessages', 'recentServices'));
    }
}
