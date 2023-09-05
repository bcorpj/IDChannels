<?php

namespace App\Http\Livewire\Features\Reference;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Тип канала')]
class ChannelType extends Reference
{
    public function boot (): void
    {
        $this->query = \App\Models\ChannelType::query();
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
