<?php

namespace App\Http\Livewire\Features\Auth;

use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Rule;
use Livewire\Component;

#[Layout('components.layouts.auth')]
class Login extends Component
{
    #[Rule(['required', 'min:5'])]
    public string $login = '';

    #[Rule(['required', 'min:5'])]
    public string $password = 'password';
    public bool $remember = false;

    public function in(): void
    {
        $credentials = ['login' => $this->login, 'password' => $this->password];

        if (Auth::attempt($credentials, $this->remember)) {
            $this->redirect('/');
        }

        $this->addError('auth', 'Invalid login or password');
    }

}
