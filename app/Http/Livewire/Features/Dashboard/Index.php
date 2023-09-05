<?php

namespace App\Http\Livewire\Features\Dashboard;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Главная')]
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
