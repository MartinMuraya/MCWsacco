<?php

namespace App\Filament\Resources\HostelBookingResource\Pages;

use App\Filament\Resources\HostelBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditHostelBooking extends EditRecord
{
    protected static string $resource = HostelBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
