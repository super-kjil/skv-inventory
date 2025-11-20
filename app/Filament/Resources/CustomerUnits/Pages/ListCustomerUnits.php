<?php

namespace App\Filament\Resources\CustomerUnits\Pages;

use App\Filament\Resources\CustomerUnits\CustomerUnitResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCustomerUnits extends ListRecords
{
    protected static string $resource = CustomerUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
