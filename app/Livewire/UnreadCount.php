<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Chat;

class UnreadCount extends Component
{
    public $count = 0;

    public function render()
    {
        $this->count = Chat::where('receiver_id', auth()->id())
            ->whereNull('read_at')
            ->count();
        return view('livewire.unread-count');
    }
}
