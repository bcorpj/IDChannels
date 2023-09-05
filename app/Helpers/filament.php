<?php


use Filament\Tables\Columns\TextColumn;

if (!function_exists('columnTooltip')){
    function columnTooltip (): Closure
    {
        return function (TextColumn $column): ?string {
            $state = $column->getState();
            if (is_array($state)) $state = $state[0];
            if (strlen($state) <= $column->getCharacterLimit()) {
                return null;
            }
            return $state;
        };
    }

}
