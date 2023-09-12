<?php

namespace App\Http\Livewire\Features\Users;

use App\Models\User;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Livewire\Component;

class Users extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::doesntHave('roles'))
            ->columns([
                TextColumn::make('id')
                    ->label('id')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('fullname')
                    ->label('ФИО')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('login')
                    ->label('Логин')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
            ])
            ->headerActions([
                $this->newUser()
            ])
            ->actions([
                $this->tableRowActions()
            ]);
    }

    public function tableRowActions()
    {
        return ActionGroup::make([
            EditAction::make()
                ->form([
                    Section::make()
                        ->columns([
                            'sm' => 3,
                        ])
                        ->schema([
                            TextInput::make('fullname')
                                ->label('ФИО')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('login')
                                ->required()
                                ->label('Логин')
                                ->maxLength(255),
                        ])
                ]),
            Action::make('delete')
                ->requiresConfirmation()
                ->action(fn (User $user) => $user->delete())
                ->icon('heroicon-o-trash')
                ->modalHeading('Delete post')
                ->modalDescription('Are you sure you\'d like to delete this post? This cannot be undone.')
                ->modalSubmitActionLabel('Yes, delete it')
        ])->iconButton();
    }

    public function newUser()
    {
        return CreateAction::make()
            ->form([
                TextInput::make('fullname')
                    ->label('ФИО')
                    ->required()
                    ->maxLength(255),
                TextInput::make('login')
                    ->required()
                    ->label('Логин')
                    ->maxLength(255),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(112)
            ])
            ->mutateFormDataUsing(function ($data) {
                return [ ...$data, 'settings' => ['locale' => config('app.locale')] ];
            });
    }

    public function render()
    {
        return view('livewire.features.users.users')
            ->title(__('ui.users'));
    }
}
