<?php

namespace App\Filament\Resources\ShareCapitalResource\Pages;

use App\Filament\Resources\ShareCapitalResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditShareCapital extends EditRecord
{
    protected static string $resource = ShareCapitalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
