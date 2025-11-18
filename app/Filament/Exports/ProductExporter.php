<?php

namespace App\Filament\Exports;

use App\Models\Product;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Number;

class ProductExporter extends Exporter
{
    protected static ?string $model = Product::class;
    private static int $rowIndex = 0;

    public function getJobData(Collection $records): array
    {
        self::$rowIndex = 0;

        return [
            'records' => $records,
        ];
    }

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('index')
                ->label('No.')
                ->formatStateUsing(fn () => ++self::$rowIndex),
            ExportColumn::make('name')
                ->label('Name'),
            ExportColumn::make('category.name')
                ->label('Category')
                ->enabledByDefault(false),
            ExportColumn::make('qty')
                ->label('Quantity'),
            ExportColumn::make('instock_date')
                ->label('In-Stock Date'),
            ExportColumn::make('commands')
                ->label('Commands'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your product export has completed and ' . Number::format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . Number::format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
