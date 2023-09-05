<?php

namespace App\View\Components\Include\Atoms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SandboxAction extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $icon,
        public string $name,
        public string $color = 'red',
        public string $description = '',
        public string $to = '',
        public $disabled = false
    )
    {
        if ($this->disabled) $this->disabled = 'pointer-events-none';
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.include.atoms.sandbox-action');
    }
}
