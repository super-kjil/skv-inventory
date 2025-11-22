<?php

namespace App\Filament\Resources\Sites\Pages;

use App\Filament\Resources\Sites\SiteResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListSites extends ListRecords
{
    protected static string $resource = SiteResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];
        
        if (request()->user()?->can('site.create')) {
            $actions[] = CreateAction::make();
        }
        
        return $actions;
    }
}
