<?php

namespace App\Http\Livewire\Features\Auth;

use Filament\Notifications\Notification;
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
    public bool $isSuccess = false;

    public function in(): void
    {
        $credentials = ['login' => $this->login, 'password' => $this->password];

        if (Auth::attempt($credentials, $this->remember)) {
            $this->isSuccess = true;
            Notification::make()
                    ->title(__('notification.login'))
                    ->success()
                    ->send();

            $this->redirect('/', true);
        }

        $this->addError('auth', 'Invalid login or password');
    }

    public function changeLocale(string $locale): void
    {
        changeLocale($locale);
    }

    public function render()
    {
        return view('livewire.features.auth.login')
            ->title(__('ui.login_page'));
    }

}
