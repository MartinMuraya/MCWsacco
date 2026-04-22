<?php

namespace App\Filament\Resources\HostelBookingResource\Pages;

use App\Filament\Resources\HostelBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListHostelBookings extends ListRecords
{
    protected static string $resource = HostelBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
