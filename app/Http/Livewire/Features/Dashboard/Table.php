<?php

namespace App\Http\Livewire\Features\Dashboard;

use App\Models\Channel;
use App\Models\ChannelType;
use App\Models\DirectionLevel;
use App\Models\TrafficType;
use App\Models\TransmissionType;
use App\Models\Type;
use App\Models\User;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Grouping\Group;
use Livewire\Component;

class Table extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    private User $user;

    public function boot()
    {
        $this->user = auth()->user();
    }

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->query(Channel::with(['deChannel', 'information', 'channelType', 'trafficType', 'transmissionType', 'directionLevel', 'type']))
            ->columns([
                TextColumn::make('channel_number')
                    ->label(__('ChannelID'))
                    ->translateLabel()
                    ->searchable(),
                TextColumn::make('klm')
                    ->label('KLM')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(),
                TextColumn::make('channelType.id')
                    ->label(__('Channel type'))
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(),
                TextColumn::make('trafficType.name')
                    ->label(__('Traffic type'))
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(),
                TextColumn::make('transmissionType.name')
                    ->label(__('Transmission type'))
                    ->searchable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('directionLevel.name')
                    ->label(__('Direction level'))
                    ->searchable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('bandwidth')
                    ->label(__('Bandwidth'))
                    ->searchable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('type.alias')
                    ->label(__('Type'))
                    ->searchable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.client_provider_name')
                    ->label(__('Сlient provider'))
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.start_connection_point')
                    ->label(__('CP №1'))
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.end_connection_point')
                    ->label(__('CP №2'))
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.intermediate_connection')
                    ->label(__('Intermediate connection'))
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.using_device')
                    ->label(__('Using device'))
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.connection_date')
                    ->label(__('Connection date'))
                    ->badge()
                    ->color('info')
                    ->date('d-m-Y')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.length')
                    ->label(__('Length'))
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.testing')
                    ->label(__('Testing'))
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.connection_line')
                    ->label(__('Connection line'))
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->groups([
                Group::make('klm')
                    ->label('KLM'),
                Group::make('channelType.name')
                    ->label(__('Channel type')),
            ])
            ->actions([
                $this->openIdChannel(),
                ActionGroup::make([
                    $this->editChannel(),
                    $this->deleteChannel()
                ])
            ])
            ->deferLoading()
            ->headerActions([
                $this->createNewChannel(),
            ])
            ->striped()
            ->paginated([10, 20, 50]);
    }

    /*
     *
     * Open view menu of ID channel
     */
    public function openIdChannel() : Action
    {
        return ViewAction::make()
            ->form([
                Section::make(__('ChannelID'))
                    ->schema([
                        TextInput::make('channel_number')
                            ->label(__('ChannelID'))
                            ->required()
                            ->maxLength(255),
                        TextInput::make('klm')
                            ->label('KLM')
                            ->maxLength(255),
                        Select::make('channel_type_id')
                            ->label(__('Channel type'))
                            ->relationship(name: 'channelType', titleAttribute: 'name')
                            ->options(ChannelType::query()->pluck('name', 'id')),
                        Select::make('traffic_type_id')
                            ->label(__('Traffic type'))
                            ->relationship(name: 'trafficType', titleAttribute: 'name')
                            ->options(TrafficType::query()->pluck('name', 'id')),
                        Select::make('transmission_type_id')
                            ->label(__('Transmission type'))
                            ->relationship(name: 'transmissionType', titleAttribute: 'name')
                            ->options(TransmissionType::query()->pluck('name', 'id')),
                        Select::make('direction_level_id')
                            ->label(__('Direction level'))
                            ->relationship(name: 'directionLevel', titleAttribute: 'name')
                            ->options(DirectionLevel::query()->pluck('name', 'id')),
                        TextInput::make('bandwidth')
                            ->label(__('Bandwidth'))
                            ->maxLength(255),
                        Select::make('type_id')
                            ->label(__('Type'))
                            ->relationship(name: 'type', titleAttribute: 'name')
                            ->options(Type::query()->pluck('name', 'id')),
                    ])
                    ->columns(),
                Section::make(__('ChannelDE'))
                    ->relationship('deChannel')
                    ->columns()
                    ->schema([
                        TextInput::make('client_provider_name')
                            ->label(__('Сlient provider'))
                            ->maxLength(255),
                        TextInput::make('start_connection_point')
                            ->label(__('CP №1'))
                            ->maxLength(255),
                        TextInput::make('end_connection_point')
                            ->label(__('CP №2'))
                            ->maxLength(255),
                        TextInput::make('intermediate_connection')
                            ->label(__('Intermediate connection'))
                            ->maxLength(255),
                        TextInput::make('using_device')
                            ->label(__('Using device'))
                            ->maxLength(255),
                        DatePicker::make('connection_date')
                            ->label(__('Connection date'))
                            ->native(false),
                        TextInput::make('length')
                            ->label(__('Length'))
                            ->maxLength(255),
                        TextInput::make('testing')
                            ->label(__('Testing'))
                            ->maxLength(255),
                        TextInput::make('connection_line')
                            ->label(__('Connection line'))
                            ->maxLength(255),
                        Textarea::make('reason')
                            ->autosize()
                            ->label(__('Reason'))
                            ->maxLength(1024),
                    ]),
                Section::make(__("Additional information"))
                    ->relationship('information')
                    ->schema([
                        Repeater::make('repeater')
                            ->schema([
                                TextInput::make('key')
                                    ->label(''),
                                TextInput::make('value')
                                    ->label('')
                            ])
                            ->label('Пользовательские данные')
                            ->columns(),
                        MarkdownEditor::make('markdown')
                            ->label(''),
                    ])
                    ->columns()
                    ->collapsed(false)
            ])
            ->modalWidth('7xl');
    }

    /*
     *
     * Open edit menu of ID channel
     */
    public function editChannel() : Action
    {
        return EditAction::make()
            ->visible($this->user->hasAnyRole('admin|manager'))
            ->form([
                Section::make(__('ChannelID'))
                    ->schema([
                        TextInput::make('channel_number')
                            ->required()
                            ->disabled()
                            ->maxLength(255),
                        TextInput::make('klm')
                            ->maxLength(255),
                        Select::make('channel_type_id')
                            ->label(__('Channel type'))
                            ->relationship(name: 'channelType', titleAttribute: 'name')
                            ->options(ChannelType::query()->pluck('name', 'id'))
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required()
                            ]),
                        Select::make('traffic_type_id')
                            ->label(__('Traffic type'))
                            ->relationship(name: 'trafficType', titleAttribute: 'name')
                            ->options(TrafficType::query()->pluck('name', 'id'))
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required()
                            ]),
                        Select::make('transmission_type_id')
                            ->label(__('Transmission type'))
                            ->relationship(name: 'transmissionType', titleAttribute: 'name')
                            ->options(TransmissionType::query()->pluck('name', 'id'))
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required()
                            ]),
                        Select::make('direction_level_id')
                            ->label(__('Direction level'))
                            ->relationship(name: 'directionLevel', titleAttribute: 'name')
                            ->options(DirectionLevel::query()->pluck('name', 'id'))
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required()
                            ]),
                        TextInput::make('bandwidth')
                            ->label(__('Bandwidth'))
                            ->maxLength(255),
                        Select::make('type_id')
                            ->label(__('Type'))
                            ->relationship(name: 'type', titleAttribute: 'name')
                            ->options(Type::query()->pluck('name', 'id'))
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('alias')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('alias')
                                    ->required()
                            ]),
                    ])
                    ->columns()
                    ->collapsed(false),
                Section::make(__('ChannelDE'))
                    ->relationship('deChannel')
                    ->columns()
                    ->schema([
                        TextInput::make('client_provider_name')
                            ->label(__('Сlient provider'))
                            ->maxLength(255),
                        TextInput::make('start_connection_point')
                            ->label(__('CP №1'))
                            ->maxLength(255),
                        TextInput::make('end_connection_point')
                            ->label(__('CP №2'))
                            ->maxLength(255),
                        TextInput::make('intermediate_connection')
                            ->label(__('Intermediate connection'))
                            ->maxLength(255),
                        TextInput::make('using_device')
                            ->label(__('Using device'))
                            ->maxLength(255),
                        DatePicker::make('connection_date')
                            ->label(__('Connection date'))
                            ->native(false),
                        TextInput::make('length')
                            ->label(__('Length'))
                            ->maxLength(255),
                        TextInput::make('testing')
                            ->label(__('Testing'))
                            ->maxLength(255),
                        TextInput::make('connection_line')
                            ->label(__('Connection line'))
                            ->maxLength(255),
                        Textarea::make('reason')
                            ->autosize()
                            ->label(__('Reason'))
                            ->maxLength(1024),
                    ])
                    ->collapsed(false),
                Section::make(__("Additional information"))
                    ->relationship('information')
                    ->schema([
                        Repeater::make('repeater')
                            ->schema([
                                TextInput::make('key')
                                    ->label('Ключ'),
                                TextInput::make('value')
                                    ->label('Значение')
                            ])
                            ->label('Пользовательские данные')
                            ->columns()
                            ->collapsed()
                            ->cloneable()
                            ->itemLabel(fn (array $state): ?string => $state['key'] ?? null),
                        MarkdownEditor::make('markdown')
                            ->fileAttachmentsDirectory('markdown-attachments'),
                    ])
                    ->columns()
                    ->collapsed(false)

            ])
            ->modalWidth('7xl');
    }


    public function createNewChannel() : Action
    {
        return CreateAction::make()
            ->visible($this->user->hasAnyRole('admin|manager'))
            ->form([
                Section::make(__('ChannelID'))
                    ->schema([
                        TextInput::make('channel_number')
                            ->label(__('ID'))
                            ->required()
                            ->unique()
                            ->maxLength(255),
                        TextInput::make('klm')
                            ->maxLength(255),
                        Select::make('channel_type_id')
                            ->label(__('Channel type'))
                            ->relationship(name: 'channelType', titleAttribute: 'name')
                            ->options(ChannelType::query()->pluck('name', 'id'))
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required()
                            ]),
                        Select::make('traffic_type_id')
                            ->label(__('Traffic type'))
                            ->relationship(name: 'trafficType', titleAttribute: 'name')
                            ->options(TrafficType::query()->pluck('name', 'id'))
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required()
                            ]),
                        Select::make('transmission_type_id')
                            ->label(__('Transmission type'))
                            ->relationship(name: 'transmissionType', titleAttribute: 'name')
                            ->options(TransmissionType::query()->pluck('name', 'id'))
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required()
                            ]),
                        Select::make('direction_level_id')
                            ->label(__('Direction level'))
                            ->relationship(name: 'directionLevel', titleAttribute: 'name')
                            ->options(DirectionLevel::query()->pluck('name', 'id'))
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255)
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required()
                            ]),
                        TextInput::make('bandwidth')
                            ->label(__('Bandwidth'))
                            ->maxLength(255),
                        Select::make('type_id')
                            ->label(__('Type'))
                            ->relationship(name: 'type', titleAttribute: 'name')
                            ->options(Type::query()->pluck('name', 'id'))
                            ->searchable()
                            ->createOptionForm([
                                TextInput::make('name')
                                    ->required()
                                    ->maxLength(255),
                                TextInput::make('alias')
                                    ->required()
                                    ->maxLength(255),
                            ])
                            ->editOptionForm([
                                TextInput::make('name')
                                    ->required(),
                                TextInput::make('alias')
                                    ->required()
                            ]),
                    ])
                    ->columns()
                    ->collapsed(false),
                Section::make(__('ChannelDE'))
                    ->relationship('deChannel')
                    ->columns()
                    ->schema([
                        TextInput::make('client_provider_name')
                            ->label(__('Сlient provider'))
                            ->maxLength(255),
                        TextInput::make('start_connection_point')
                            ->label(__('CP №1'))
                            ->maxLength(255),
                        TextInput::make('end_connection_point')
                            ->label(__('CP №2'))
                            ->maxLength(255),
                        TextInput::make('intermediate_connection')
                            ->label(__('Intermediate connection'))
                            ->maxLength(255),
                        TextInput::make('using_device')
                            ->label(__('Using device'))
                            ->maxLength(255),
                        DatePicker::make('connection_date')
                            ->label(__('Connection date'))
                            ->native(false),
                        TextInput::make('length')
                            ->label(__('Length'))
                            ->maxLength(255),
                        TextInput::make('testing')
                            ->label(__('Testing'))
                            ->maxLength(255),
                        TextInput::make('connection_line')
                            ->label(__('Connection line'))
                            ->maxLength(255),
                        Textarea::make('reason')
                            ->autosize()
                            ->label(__('Reason'))
                            ->maxLength(1024),
                    ])
                    ->collapsed(false),
                Section::make(__("Additional information"))
                    ->relationship('information')
                    ->schema([
                        Repeater::make('repeater')
                            ->schema([
                                TextInput::make('key')
                                    ->label('Ключ'),
                                TextInput::make('value')
                                    ->label('Значение')
                            ])
                            ->label('Пользовательские данные')
                            ->columns()
                            ->collapsed()
                            ->cloneable()
                            ->itemLabel(fn (array $state): ?string => $state['key'] ?? null),
                        MarkdownEditor::make('markdown')
                            ->fileAttachmentsDirectory('markdown-attachments'),
                    ])
                    ->columns()
                    ->collapsed(false)
            ])
            ->modalWidth('7xl');
    }

    public function deleteChannel()
    {
        return DeleteAction::make()
            ->visible($this->user->hasAnyRole('admin'))
            ->requiresConfirmation()
            ->label('Delete');
    }

}
//                                ->createOptionUsing(function (array $data) {
//                                    $channelType = ChannelType::create($data);
//                                    return $channelType->getKey();
//                                })
