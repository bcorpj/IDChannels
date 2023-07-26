<?php

namespace App\View\Components\Include\Atoms;

use App\Enums\Tailwind\Colors;
use App\Enums\Tailwind\FontWeight;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Link extends Component
{
    public function __construct(
        public string $title,
        public string|null $class = null
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.include.atoms.link');
    }
}
