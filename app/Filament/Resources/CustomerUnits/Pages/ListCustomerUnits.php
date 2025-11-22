<?php

namespace App\Filament\Resources\CustomerUnits\Pages;

use App\Filament\Resources\CustomerUnits\CustomerUnitResource;
use App\Models\Site;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Schemas\Components\Tabs\Tab;
use Illuminate\Support\Str;

class ListCustomerUnits extends ListRecords
{
    protected static string $resource = CustomerUnitResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];
        
        if (request()->user()?->can('customer_unit.create')) {
            $actions[] = CreateAction::make();
        }
        
        return $actions;
    }

    public function getTabs(): array
    {
        $tabs = [
            null => Tab::make('All'),
        ];

        $sites = Site::orderBy('name')->get();

        foreach ($sites as $site) {
            $key = Str::slug($site->name) ?: (string) $site->id;

            $tabs[$key] = Tab::make($site->name)
                ->query(fn ($query) => $query->whereHas('site', fn ($q) => $q->where('sites.id', $site->id)));
        }

        return $tabs;
    }
}
