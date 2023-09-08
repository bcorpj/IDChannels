<?php

namespace App\Http\Livewire\Features\Reference;

use Closure;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Columns\Layout\Grid;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\TextInputColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

abstract class Reference extends Component implements HasTable, HasForms
{
    use InteractsWithTable, InteractsWithForms;

    protected Closure|Builder|null $query;
    protected array $columns;
    protected array $createActions = [];
    protected array $actions = [];

    public function table(Table $table): Table
    {
        return $table
            ->query($this->query)
            ->columns($this->columns)
            ->headerActions(empty($this->createActions) ? $this->createActions : [
                CreateAction::make()
                    ->form([
                        ...$this->createActions
                    ])
            ])
            ->actions($this->actions)
            ->paginated([10, 25, 50]);
    }

}
