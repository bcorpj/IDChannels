<?php

namespace App\View\Components\Include\Molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarButton extends Component
{

    public function __construct(
        public string $title,
        public string $icon,
        public bool $active = false,
    ) {}

    public function render(): View|Closure|string
    {
        return view('components.include.molecules.sidebar-button');
    }
}
