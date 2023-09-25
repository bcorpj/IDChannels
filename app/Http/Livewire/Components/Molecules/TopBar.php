<?php

namespace App\Http\Livewire\Components\Molecules;

use Filament\Notifications\Notification;
use Livewire\Component;

class TopBar extends Component
{
    public function logout(): void
    {
        auth()->logout();
        Notification::make()
            ->title(__('notification.logout'))
            ->icon('heroicon-o-information-circle')
            ->iconColor('info')
            ->send();
        $this->redirect(route('login'), true);
    }

    public function boot()
    {
        if (session('access')) {
            Notification::make()
                ->title(session('access'))
                ->warning()
                ->send();
        }
    }

}
