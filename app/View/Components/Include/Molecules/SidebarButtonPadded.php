<?php

namespace App\View\Components\Include\Molecules;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SidebarButtonPadded extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $title,
        public string $icon,
        public bool $active = false,
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.include.molecules.sidebar-button-padded');
    }
}
