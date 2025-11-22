<?php

namespace App\Filament\Resources\Products\Pages;

use App\Filament\Resources\Products\ProductResource;
use App\Filament\Resources\Products\Widgets\ProductWidget;
use App\Filament\Widgets\ProductStatsWidget;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProducts extends ListRecords
{
    protected static string $resource = ProductResource::class;

    protected function getHeaderActions(): array
    {
        $actions = [];

        if (request()->user()?->can('product.create')) {
            $actions[] = CreateAction::make();
        }

        return $actions;
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ProductWidget::class,
        ];
    }
}
