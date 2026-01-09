<?php

namespace App\Filament\Resources\Sports\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class SportForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                Textarea::make('description')
                    ->columnSpanFull(),
                Select::make('status')
                    ->options(['activa' => 'Activa', 'inactiva' => 'Inactiva'])
                    ->default('activa')
                    ->required(),
            ]);
    }
}
