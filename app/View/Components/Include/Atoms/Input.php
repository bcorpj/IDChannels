<?php

namespace App\View\Components\Include\Atoms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public function __construct(
        public ?string $label = null
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.include.atoms.input');
    }
}
