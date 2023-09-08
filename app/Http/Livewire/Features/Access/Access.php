<?php

namespace App\Http\Livewire\Features\Access;

use App\Models\User;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Grouping\Group;
use Filament\Tables\Table;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Access extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
            ->query(
                User::query()
                    ->select([
                        'users.*',
                        'roles.name as role_name'
                    ])
                    ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
                    ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            )
            ->columns([
                TextColumn::make('role_name')
                    ->label('Роль')
                    ->formatStateUsing(fn (string $state): string => User::$castRoles[$state] ?? 'Гость')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'manager' => 'info',
                        'admin' => 'success',
                        default => 'gray'
                    }),
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
            ->groups([
                Group::make('role_name')
                    ->label('Роль'),
            ])
            ->actions([
                $this->changeRole()
            ])
            ->headerActions([
                $this->newTeammate()
            ]);
    }

    public function changeRole()
    {
        $options = Role::all()->pluck('name', 'id')->map(function ($value, $key) {
            return User::$castRoles[$value];
        });
        return ActionGroup::make([
            Action::make('Edit Role')
                ->fillForm(function (User $user) {
                    return [
                        'role_id' => $user->roles()->first()->id
                    ];
                })
                ->form([
                    Select::make('role_id')
                        ->label('Role')
                        ->options($options)
                        ->required(),
                ])
                ->action(function (User $user, array $data): void {
                    $user->syncRoles([]);
                    $user->assignRole(Role::find($data['role_id']));
                })
                ->icon('heroicon-o-eye'),
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
            Action::make('delete role')
                ->requiresConfirmation()
                ->action(fn (User $user) => $user->syncRoles([]))
                ->icon('heroicon-o-trash')
        ])->iconButton();
    }

    public function newTeammate()
    {
        $options = Role::all()->pluck('name', 'id')->map(function ($value, $key) {
            return User::$castRoles[$value];
        });
        return Action::make('Добавить')
            ->form([
                Select::make('user_id')
                    ->label('Пользователь')
                    ->options(User::doesntHave('roles')->pluck('fullname', 'id'))
                    ->required()
                    ->searchable(),
                Select::make('role_id')
                    ->label('Доступ')
                    ->options($options)
                    ->required()
                    ->searchable()
            ])
            ->action(function (array $data): void {
                $user = User::find($data['user_id']);
                $user->syncRoles([]);
                $user->assignRole(Role::find($data['role_id']));
            });
    }


    public function render()
    {
        return view('livewire.features.access.access')
            ->title(__('ui.user_accesses'));
    }
}
