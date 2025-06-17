<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationsPage extends Component
{
    public function markAsRead($id)
    {
        $notif = Notification::find($id);
        if ($notif && $notif->user_id === Auth::id()) {
            $notif->update(['read' => true]);
        }
    }

    public function deleteNotification($id)
    {
        $notif = Notification::find($id);

        if ($notif && $notif->user_id === auth()->id()) {
            $notif->delete();
        }
    }
    
    public function render()
    {
        $notifications = Notification::where('user_id', Auth::id())
            ->with('fromUser')
            ->latest()
            ->get();

        return view('livewire.notifications-page', compact('notifications'))
            ->layout('layouts.app');
    }
}
