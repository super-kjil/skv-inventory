<?php

namespace App\Filament\Resources\Products\Widgets;

use App\Models\Product;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

// class ProductWidget extends StatsOverviewWidget
// {
//     protected function getStats(): array
//     {
//         return Product::all()->map(function ($product) {
//             return
//                 Stat::make($product->name, $product->qty)
//                 ->description('Quantity in stock')
//                 ->color($product->qty <= 5 ? 'danger' : 'success');
//         })->toArray();
//     }
// }

class ProductWidget extends StatsOverviewWidget
{
    protected function getStats(): array
    {
        return [
            Stat::make('Total Products', Product::count())
                ->description('Total number of products')
                ->descriptionIcon('heroicon-o-cube')
                ->color('success'),
            Stat::make('Low Stock', Product::where('qty', '<', 5)->count())
                ->description('Products with quantity below 5')
                ->descriptionIcon('heroicon-m-exclamation-triangle')
                ->color('warning'),
            Stat::make('Out of Stock', Product::where('qty', '=', 0)->count())
                ->description('Products with zero quantity')
                ->descriptionIcon('heroicon-o-archive-box-x-mark')
                ->color('danger'),
        ];
    }
}