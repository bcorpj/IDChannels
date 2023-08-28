<?php

namespace App\View\Components\Include\Atoms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Input extends Component
{
    public function __construct(
        public string $name,
        public string|null $label = null,
        public string|null $class = null,
        public bool $showError = false
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.include.atoms.input');
    }
}
