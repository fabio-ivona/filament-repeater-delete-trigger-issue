<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Repeater::make('elements')
                    ->live()
                    ->schema([
                        Hidden::make('id')->default(fn() => (string) Str::uuid()),
                        TextInput::make('label'),
                    ]),

                Select::make('main_element')
                    ->options(fn(Get $get) => collect($get('elements'))
                        ->pluck('label','id')->filter()->all()
                    ),
            ]);
    }
}
