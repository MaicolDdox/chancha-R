<?php

namespace App\Filament\Resources\Zones\Schemas;

use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class ZoneForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('category_id')
                    ->relationship('category', 'name')
                    ->required(),
                Select::make('sport_id')
                    ->relationship('sport', 'name')
                    ->required(),
                TextInput::make('name')
                    ->required(),
                TextInput::make('location')
                    ->label('Location'),
                Textarea::make('description')
                    ->columnSpanFull(),
                TextInput::make('price_per_hour')
                    ->required()
                    ->numeric(),
                FileUpload::make('image')
                    ->image(),
                Select::make('status')
                    ->options(['disponible' => 'Disponible', 'mantenimiento' => 'Mantenimiento', 'ocupada' => 'Ocupada'])
                    ->default('disponible')
                    ->required(),
            ]);
    }
}
