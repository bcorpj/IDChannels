<?php

namespace App\Http\Livewire\Features\Dashboard;

use App\Models\Channel;
use App\Models\ChannelType;
use App\Models\DeChannel;
use App\Models\DirectionLevel;
use App\Models\TrafficType;
use App\Models\TransmissionType;
use App\Models\Type;
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

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->query(Channel::with(['deChannel', 'information', 'channelType', 'trafficType', 'transmissionType', 'directionLevel', 'type']))
            ->columns([
                TextColumn::make('channel_number')
                    ->label('ID канала')
                    ->searchable(),
                TextColumn::make('klm')
                    ->label('KLM')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(),
                TextColumn::make('channelType.id')
                    ->label('Тип канала')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(),
                TextColumn::make('trafficType.name')
                    ->label('Тип трафика')
                    ->searchable()
                    ->sortable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(),
                TextColumn::make('transmissionType.name')
                    ->label('Тип среды передач')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('directionLevel.name')
                    ->label('Уровень/направление')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('bandwidth')
                    ->label('Пропускная способность')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('type.alias')
                    ->label('Вид')
                    ->searchable()
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.client_provider_name')
                    ->label('Принадлженость')
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.start_connection_point')
                    ->label('ТП №1')
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.end_connection_point')
                    ->label('ТП №2')
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.intermediate_connection')
                    ->label('Промежуточное подключение')
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.using_device')
                    ->label('Используемый вид оборудования')
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.connection_date')
                    ->label('Дата подключения')
                    ->badge()
                    ->color('info')
                    ->date('d-m-Y')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.length')
                    ->label('Протяженность')
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.testing')
                    ->label('Тестирование')
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.connection_line')
                    ->label('Соединительная линия')
                    ->limit(50)
                    ->tooltip(columnTooltip())
                    ->toggleable(isToggledHiddenByDefault: true),

            ])->groups([
                Group::make('klm')
                    ->label('KLM'),
                Group::make('channelType.name')
                    ->label('Тип канала'),
            ])
            ->actions([
                ActionGroup::make([
                    $this->openIdChannel(),
                    $this->editMainTable(),
                ])
            ])
            ->deferLoading()
            ->headerActions([
                $this->createNewChannel()
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
                Section::make('ID-канала')
                    ->schema([
                        TextInput::make('channel_number')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('klm')
                            ->maxLength(255),
                        Select::make('channel_type_id')
                            ->label('Тип канала')
                            ->relationship(name: 'channelType', titleAttribute: 'name')
                            ->options(ChannelType::query()->pluck('name', 'id')),
                        Select::make('traffic_type_id')
                            ->label('Тип трафика')
                            ->relationship(name: 'trafficType', titleAttribute: 'name')
                            ->options(TrafficType::query()->pluck('name', 'id')),
                        Select::make('transmission_type_id')
                            ->label('Тип среды передач')
                            ->relationship(name: 'transmissionType', titleAttribute: 'name')
                            ->options(TransmissionType::query()->pluck('name', 'id')),
                        Select::make('direction_level_id')
                            ->label('Уровень/направление')
                            ->relationship(name: 'directionLevel', titleAttribute: 'name')
                            ->options(DirectionLevel::query()->pluck('name', 'id')),
                        TextInput::make('bandwidth')
                            ->maxLength(255),
                        Select::make('type_id')
                            ->label('Вид')
                            ->relationship(name: 'type', titleAttribute: 'name')
                            ->options(Type::query()->pluck('name', 'id')),
                    ])
                    ->columns(),
                Section::make('DE-канала')
                    ->relationship('deChannel')
                    ->columns()
                    ->schema([
                        TextInput::make('client_provider_name')
                            ->maxLength(255),
                        TextInput::make('start_connection_point')
                            ->label('ТП №1')
                            ->maxLength(255),
                        TextInput::make('end_connection_point')
                            ->label('ТП №2')
                            ->maxLength(255),
                        TextInput::make('intermediate_connection')
                            ->label('Промежуточное подключение')
                            ->maxLength(255),
                        TextInput::make('using_device')
                            ->label('Используемый вид оборудования')
                            ->maxLength(255),
                        DatePicker::make('connection_date')
                            ->label('Дата подключения')
                            ->native(false),
                        TextInput::make('length')
                            ->label('Протяженность')
                            ->maxLength(255),
                        TextInput::make('testing')
                            ->label('Тестирование')
                            ->maxLength(255),
                        TextInput::make('connection_line')
                            ->label('Соединительная линия')
                            ->maxLength(255),
                        Textarea::make('reason')
                            ->autosize()
                            ->label('Основание')
                            ->maxLength(1024),
                    ]),
                Section::make('Дополнительная информация')
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
    public function editMainTable() : Action
    {
        return EditAction::make()
            ->form([
                Section::make('ID-канала')
                    ->schema([
                        TextInput::make('channel_number')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('klm')
                            ->maxLength(255),
                        Select::make('channel_type_id')
                            ->label('Тип канала')
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
                            ->label('Тип трафика')
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
                            ->label('Тип среды передач')
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
                            ->label('Уровень/направление')
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
                            ->maxLength(255),
                        Select::make('type_id')
                            ->label('Вид')
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
                Section::make('DE-канала')
                    ->relationship('deChannel')
                    ->columns()
                    ->schema([
                        TextInput::make('client_provider_name')
                            ->maxLength(255),
                        TextInput::make('start_connection_point')
                            ->label('ТП №1')
                            ->maxLength(255),
                        TextInput::make('end_connection_point')
                            ->label('ТП №2')
                            ->maxLength(255),
                        TextInput::make('intermediate_connection')
                            ->label('Промежуточное подключение')
                            ->maxLength(255),
                        TextInput::make('using_device')
                            ->label('Используемый вид оборудования')
                            ->maxLength(255),
                        DatePicker::make('connection_date')
                            ->label('Дата подключения')
                            ->native(false),
                        TextInput::make('length')
                            ->label('Протяженность')
                            ->maxLength(255),
                        TextInput::make('testing')
                            ->label('Тестирование')
                            ->maxLength(255),
                        TextInput::make('connection_line')
                            ->label('Соединительная линия')
                            ->maxLength(255),
                        Textarea::make('reason')
                            ->autosize()
                            ->label('Основание')
                            ->maxLength(1024),
                    ])
                    ->collapsed(false),
                Section::make('Дополнительная информация')
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
            ->form([
                Section::make('ID-канала')
                    ->schema([
                        TextInput::make('channel_number')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('klm')
                            ->maxLength(255),
                        Select::make('channel_type_id')
                            ->label('Тип канала')
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
                            ->label('Тип трафика')
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
                            ->label('Тип среды передач')
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
                            ->label('Уровень/направление')
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
                            ->maxLength(255),
                        Select::make('type_id')
                            ->label('Вид')
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
                Section::make('DE-канала')
                    ->relationship('deChannel')
                    ->columns()
                    ->schema([
                        TextInput::make('client_provider_name')
                            ->maxLength(255),
                        TextInput::make('start_connection_point')
                            ->label('ТП №1')
                            ->maxLength(255),
                        TextInput::make('end_connection_point')
                            ->label('ТП №2')
                            ->maxLength(255),
                        TextInput::make('intermediate_connection')
                            ->label('Промежуточное подключение')
                            ->maxLength(255),
                        TextInput::make('using_device')
                            ->label('Используемый вид оборудования')
                            ->maxLength(255),
                        DatePicker::make('connection_date')
                            ->label('Дата подключения')
                            ->native(false),
                        TextInput::make('length')
                            ->label('Протяженность')
                            ->maxLength(255),
                        TextInput::make('testing')
                            ->label('Тестирование')
                            ->maxLength(255),
                        TextInput::make('connection_line')
                            ->label('Соединительная линия')
                            ->maxLength(255),
                        Textarea::make('reason')
                            ->autosize()
                            ->label('Основание')
                            ->maxLength(1024),
                    ])
                    ->collapsed(false),
                Section::make('Дополнительная информация')
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

}
//                                ->createOptionUsing(function (array $data) {
//                                    $channelType = ChannelType::create($data);
//                                    return $channelType->getKey();
//                                })