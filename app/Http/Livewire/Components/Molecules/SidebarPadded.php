<?php

namespace App\Http\Livewire\Components\Molecules;

use App\Models\User;
use Livewire\Component;

class SidebarPadded extends Component
{

    public User $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function render()
    {
        return view('livewire.components.molecules.sidebar-padded');
    }
}
