<?php

namespace App\Http\Livewire\Features\Reference;

use App\Models\Branch;
use Auth;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\Column;
use Filament\Tables\Columns\TextColumn;

class Branches extends Reference
{

    public function boot (): void
    {
        $this->query = Branch::query();
        $this->columns = [
            TextColumn::make('id')
                ->label('ID')
                ->searchable(),
            TextColumn::make('name')
                ->label('Название')
                ->searchable(),
            TextColumn::make('alias')
                ->label('Сокращенное')
                ->badge()
                ->color('info')
                ->searchable(),
            TextColumn::make('Диапазоны')->state(
                static function (Column $column): string {
                    return $column->getRecord()['channel_range_from']
                        .
                    ' - '
                        .
                    $column->getRecord()['channel_range_to'];
                }
            )->badge()
        ];
        $this->createActions = [
            TextInput::make('name')
                ->required()
                ->maxLength(255)
                ->rules(['required', 'max:255']),
            TextInput::make('alias')
                ->label('Сокращенное')
                ->required()
                ->maxLength(255)
                ->rules(['required', 'max:255']),
            TextInput::make('channel_range_from')
                ->label('Диапазон от')
                ->rules(['nullable', 'integer', 'min:0']),
            TextInput::make('channel_range_to')
                ->label('Диапазон до')
                ->rules(['nullable', 'integer']),
        ];
        $this->actions = [
            EditAction::make()
                ->visible(Auth::user()->hasAnyRole('admin|manager'))
                ->form([
                    TextInput::make('name')
                        ->required()
                        ->maxLength(255)
                        ->rules(['required', 'max:255']),
                    TextInput::make('alias')
                        ->label('Сокращенное')
                        ->required()
                        ->maxLength(255)
                        ->rules(['required', 'max:255']),
                    TextInput::make('channel_range_from')
                        ->label('Диапазон от')
                        ->rules(['nullable', 'integer', 'min:0']),
                    TextInput::make('channel_range_to')
                        ->label('Диапазон до')
                        ->rules(['nullable', 'integer']),
                ])
        ];
    }
    public function render()
    {
        return view('livewire.features.reference.branches')
            ->title(__('Branches'));
    }
}
