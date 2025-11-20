<?php

namespace App\Filament\Resources\Products\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ExportAction;
use Filament\Schemas\Components\Image;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use App\Filament\Exports\ProductExporter;
use Filament\Actions\ExportBulkAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Actions\Exports\Models\Export;
use Illuminate\Support\Carbon;

class ProductsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No.') // Optional: customize the column header label
                    ->rowIndex()
                    ->getStateUsing(function ($rowLoop) {
                        return $rowLoop->iteration;
                    }),
                ImageColumn::make('image')
                    ->label('Image')
                    ->imageHeight(50),
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('category.name')
                    ->label('Category')
                    ->sortable()
                    ->searchable(),   
                TextColumn::make('qty')
                    ->label('Quantity')
                    ->sortable(),
                TextColumn::make('instock_date')
                    ->label('In-Stock Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('remark')
                    ->label('Remark')
                    ->limit(50)
                    ->sortable()
                    ->searchable(),
            ])
            ->headerActions([
            ExportAction::make()
                ->exporter(ProductExporter::class)
                ->formats([ExportFormat::Xlsx])
                ->fileName(fn (Export $export): string => 'Product-List-' . Carbon::now()->format('d-M-y')),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
                ExportBulkAction::make()
                    ->exporter(ProductExporter::class)
                    ->formats([ExportFormat::Xlsx]),
            ]);
    }
}
