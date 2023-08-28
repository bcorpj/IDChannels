<?php

namespace App\Http\Livewire\Components\Molecules;

use Livewire\Component;

class TopBar extends Component
{
    public function logout(): void
    {
        auth()->logout();
        $this->redirect('login');
    }
}
