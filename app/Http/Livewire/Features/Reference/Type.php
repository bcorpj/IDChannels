<?php

namespace App\Http\Livewire\Features\Reference;

use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Livewire\Component;

#[Title('Вид')]
class Type extends Reference
{
    public function boot (): void
    {
        $this->query = \App\Models\Type::query();
        $this->columns = [
            TextColumn::make('id')
                ->label('ID')
                ->searchable(),
            TextInputColumn::make('alias')
                ->rules(['required', 'max:255'])
                ->label('Алиас'),
            TextInputColumn::make('name')
                ->label('Название')
                ->searchable()
                ->rules(['required', 'max:255'])
        ];
        $this->createActions = [
            TextInput::make('name')
                ->required()
                ->maxLength(255),
            TextInput::make('alias')
                ->required()
                ->maxLength(255),
        ];
    }
}
