<?php

namespace App\Http\Livewire\Features\Reference;

use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Тип среды передач')]
class TransmissionType extends Reference
{
    public function boot (): void
    {
        $this->query = \App\Models\TransmissionType::query();
        $this->columns = [
            TextColumn::make('id')
                ->label('ID')
                ->searchable(),
            TextInputColumn::make('name')
                ->label('Название')
                ->searchable()
                ->rules(['required', 'max:255'])
        ];
        $this->createActions = [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
        ];
    }

    public function render()
    {
        return view('livewire.features.reference.transmission-type')
            ->title(__('Transmission type'));
    }
}
