<?php

namespace App\Filament\Resources\Sports\Pages;

use App\Filament\Resources\Sports\SportResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;

class EditSport extends EditRecord
{
    protected static string $resource = SportResource::class;

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
        ];
    }
}
