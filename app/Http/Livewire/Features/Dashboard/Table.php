<?php

namespace App\Http\Livewire\Features\Dashboard;

use App\Models\Channel;
use App\Models\ChannelType;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
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
            EditAction::make()
                ->form([
                    Section::make()
                        ->schema([
                            TextInput::make('channel_number')
                                ->required()
                                ->maxLength(255),
                            TextInput::make('klm')
                                ->required()
                                ->maxLength(255),
                            Select::make('channel_type_id')
                                ->label('Тип канала')
                                ->options(ChannelType::query()->pluck('name', 'id'))
                                ->required()
                                ->searchable()
                                ->preload()
                                ->createOptionForm([
                                    TextInput::make('name')
                                        ->required()
                                        ->maxLength(255)
                                ])
                                ->createOptionUsing(function (array $data) {
                                    ChannelType::create($data);
                                })
                        ])
                ]),
        ])
        ->paginated([10, 20, 50]);
    }
}
