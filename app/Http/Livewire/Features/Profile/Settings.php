<?php

namespace App\Http\Livewire\Features\Profile;

use App\Models\User;
use Auth;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Actions\Contracts\HasActions;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Livewire\Component;

class Settings extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public User $user;

    public function mount()
    {
        $this->user = Auth::user();
    }

    public function updateName()
    {
        return EditAction::make('updateName')
            ->link()
            ->record($this->user)
            ->form([
                TextInput::make('fullname')
                    ->label(__(''))
                    ->required()
                    ->maxLength(255)
            ]);

    }



    public function changeLocale(string $locale): void
    {
        changeLocale($locale);
    }

    public function render()
    {
        return view('livewire.features.profile.settings')
            ->title(__('ui.settings'));
    }
}
