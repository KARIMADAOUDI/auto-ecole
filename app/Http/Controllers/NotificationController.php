<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Http\Request;

class NotificationController extends Controller
{
    public function index()
    {
        $notifications = Notification::latest()
            ->paginate(10);

        $unreadCount = Notification::where('is_read', false)->count();

        return view('components.notifications-dropdown', compact('notifications', 'unreadCount'));
    }

    public function markAsRead(Notification $notification)
    {
        $notification->markAsRead();

        return back()->with('success', 'Notification marquée comme lue.');
    }

    public function markAllAsRead()
    {
        Notification::where('is_read', false)->update([
            'is_read' => true,
            'read_at' => now()
        ]);

        return back()->with('success', 'Toutes les notifications ont été marquées comme lues.');
    }
} 