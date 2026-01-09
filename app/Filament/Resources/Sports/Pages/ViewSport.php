<?php

namespace App\Filament\Resources\Sports\Pages;

use App\Filament\Resources\Sports\SportResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;

class ViewSport extends ViewRecord
{
    protected static string $resource = SportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
}
