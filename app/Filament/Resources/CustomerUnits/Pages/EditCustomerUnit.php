<?php

namespace App\Filament\Resources\CustomerUnits\Pages;

use App\Filament\Resources\CustomerUnits\CustomerUnitResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCustomerUnit extends EditRecord
{
    protected static string $resource = CustomerUnitResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
}
