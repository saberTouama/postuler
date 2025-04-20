<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notifications extends Component
{
    
    public function render()
    {
        $notifications=Auth::user()->unreadNotifications;
        return view('livewire.notifications', [
            'notifications' => $notifications
        ]);
    }
}
