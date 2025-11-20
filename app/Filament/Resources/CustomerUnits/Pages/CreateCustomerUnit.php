<?php

namespace App\Filament\Resources\CustomerUnits\Pages;

use App\Filament\Resources\CustomerUnits\CustomerUnitResource;
use Filament\Resources\Pages\CreateRecord;

class CreateCustomerUnit extends CreateRecord
{
    protected static string $resource = CustomerUnitResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
