<?php

namespace App\Http\Livewire\Features\Reference;

use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Тип канала')]
class DirectionLevel extends Reference
{
    public function boot (): void
    {
        $this->query = \App\Models\DirectionLevel::query();
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
}
