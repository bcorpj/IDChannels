<?php

namespace App\Http\Livewire\Features\Auth;

use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{

    public string $login = '';
    public string $password = '';

    public function in()
    {

    }

}
