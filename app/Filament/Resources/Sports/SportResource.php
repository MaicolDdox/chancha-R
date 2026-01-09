<?php

namespace App\Filament\Resources\Sports;

use App\Filament\Resources\Sports\Pages\CreateSport;
use App\Filament\Resources\Sports\Pages\EditSport;
use App\Filament\Resources\Sports\Pages\ListSports;
use App\Filament\Resources\Sports\Pages\ViewSport;
use App\Filament\Resources\Sports\Schemas\SportForm;
use App\Filament\Resources\Sports\Schemas\SportInfolist;
use App\Filament\Resources\Sports\Tables\SportsTable;
use App\Models\Sport;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class SportResource extends Resource
{
    protected static ?string $model = Sport::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return SportForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return SportInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return SportsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListSports::route('/'),
            'create' => CreateSport::route('/create'),
            'view' => ViewSport::route('/{record}'),
            'edit' => EditSport::route('/{record}/edit'),
        ];
    }
}
