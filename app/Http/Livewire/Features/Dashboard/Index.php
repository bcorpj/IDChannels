<?php

namespace App\Http\Livewire\Features\Dashboard;

use Livewire\Component;

class Index extends Component
{
    public function logout(): void
    {
        auth()->logout();
        $this->redirect('login');
    }

    public function render()
    {
        return view('livewire.features.dashboard.index');
    }
}
