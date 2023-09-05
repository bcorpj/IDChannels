<?php

namespace App\Http\Livewire\Features\Reference;

use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Данные')]
class Index extends Component
{
    public function render()
    {
        return view('livewire.features.reference.index');
    }
}
