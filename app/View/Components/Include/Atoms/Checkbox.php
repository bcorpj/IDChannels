<?php

namespace App\View\Components\Include\Atoms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Checkbox extends Component
{
    public function __construct(
        public string $title,
        public string $name,
        public string|null $class = null
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.include.atoms.checkbox');
    }
}
