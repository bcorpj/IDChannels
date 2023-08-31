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
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\Action;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Grouping\Group;
use Illuminate\Database\Eloquent\Model;
use Livewire\Component;

class Table extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    public function table(\Filament\Tables\Table $table): \Filament\Tables\Table
    {
        return $table
            ->query(Channel::with(['deChannel', 'channelType', 'trafficType', 'transmissionType', 'directionLevel', 'type']))
            ->columns([
                TextColumn::make('channel_number')
                    ->label('ID канала')
                    ->searchable(),
                TextColumn::make('klm')
                    ->label('KLM')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('channelType.name')
                    ->label('Тип канала')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('trafficType.name')
                    ->label('Тип трафика')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),
                TextColumn::make('transmissionType.name')
                    ->label('Тип среды передач')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('directionLevel.name')
                    ->label('Уровень/направление')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('bandwidth')
                    ->label('Пропускная способность')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('type.alias')
                    ->label('Вид')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.client_provider_name')
                    ->label('Принадлженость')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.start_connection_point')
                    ->label('ТП №1')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.end_connection_point')
                    ->label('ТП №2')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.intermediate_connection')
                    ->label('Промежуточное подключение')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.using_device')
                    ->label('Используемый вид оборудования')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.connection_date')
                    ->label('Дата подключения')
                    ->badge()
                    ->color('info')
                    ->date('d-m-Y')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.length')
                    ->label('Протяженность')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.testing')
                    ->label('Тестирование')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.connection_line')
                    ->label('Соединительная линия')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('deChannel.reason')
                    ->label('Основание')
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->groups([
                Group::make('klm')
                    ->label('KLM'),
                Group::make('channelType.name')
                    ->label('Тип канала'),
            ])
            ->actions([
                $this->openIdChannel(),
                $this->editMainTable(),
            ])
            ->striped()
            ->paginated([10, 20, 50]);
    }

    public function openIdChannel()
    {
        return ViewAction::make()
            ->form([
                Section::make('ID-канала')
                    ->schema([
                        TextInput::make('channel_number')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('klm')
                            ->required()
                            ->maxLength(255),
                        Select::make('channel_type_id')
                            ->label('Тип канала')
                            ->relationship(name: 'channelType', titleAttribute: 'name')
                            ->options(ChannelType::query()->pluck('name', 'id'))
                            ->required()
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
                            ->required()
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
                            ->required()
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
                            ->required()
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
                            ->required()
                            ->maxLength(255),
                        Select::make('type_id')
                            ->label('Вид')
                            ->relationship(name: 'type', titleAttribute: 'name')
                            ->options(Type::query()->pluck('name', 'id'))
                            ->required()
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
                    ->columns(),
                Section::make('DE-канала')
                    ->relationship('deChannel')
                    ->columns()
                    ->schema([
                        TextInput::make('client_provider_name')
                            ->required()
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
                        TextInput::make('reason')
                            ->label('Основание')
                            ->maxLength(255),
                    ])
            ])
            ->modalWidth('7xl');
    }

    public function editMainTable()
    {
        return EditAction::make()
            ->form([
                Section::make('ID-канала')
                    ->schema([
                        TextInput::make('channel_number')
                            ->required()
                            ->maxLength(255),
                        TextInput::make('klm')
                            ->required()
                            ->maxLength(255),
                        Select::make('channel_type_id')
                            ->label('Тип канала')
                            ->relationship(name: 'channelType', titleAttribute: 'name')
                            ->options(ChannelType::query()->pluck('name', 'id'))
                            ->required()
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
                            ->required()
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
                            ->required()
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
                            ->required()
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
                            ->required()
                            ->maxLength(255),
                        Select::make('type_id')
                            ->label('Вид')
                            ->relationship(name: 'type', titleAttribute: 'name')
                            ->options(Type::query()->pluck('name', 'id'))
                            ->required()
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
                    ->columns(),
                Section::make('DE-канала')
                    ->relationship('deChannel')
                    ->columns()
                    ->schema([
                        TextInput::make('client_provider_name')
                            ->required()
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
                        TextInput::make('reason')
                            ->label('Основание')
                            ->maxLength(255),
                    ])

            ])
            ->modalWidth('7xl');
    }
}


//                                ->createOptionUsing(function (array $data) {
//                                    $channelType = ChannelType::create($data);
//                                    return $channelType->getKey();
//                                })
