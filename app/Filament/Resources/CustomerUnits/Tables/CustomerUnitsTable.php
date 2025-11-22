<?php

namespace App\Filament\Resources\CustomerUnits\Tables;

use App\Enums\CustomerTypeEnum;
use App\Enums\CustomerUnitEnum;
use App\Traits\HasResourceTableActions;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\RichEditor\TextColor;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomerUnitsTable
{
    use HasResourceTableActions;

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                    ->label('No.')
                    ->rowIndex(),
                TextColumn::make('unit_name')
                    ->label('Unit')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('customer_type')
                    ->label('Type')
                    ->sortable()
                    ->searchable()
                    ->toggleable()
                    // ->badge()
                    ->color(fn($state): string => CustomerTypeEnum::from($state)->getColor()),
                TextColumn::make('customer_name')
                    ->label('Customer Name')
                    ->sortable()
                    ->placeholder('N/A')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('customer_tel')
                    ->label('Phone Number')
                    ->sortable()
                    ->placeholder('N/A')
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('customer_id')
                    ->label('Customer ID')
                    ->sortable()
                    ->toggleable()
                    ->searchable(),
                TextColumn::make('site.name')
                    ->label('SITE')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn($state): string => CustomerUnitEnum::from($state)->getColor()),
                TextColumn::make('remark')
                    ->label('Remarks'),
            ])
            ->filters([
                //
            ])
            ->recordActions([])
            // (
            //     self::getEditDeleteActions('customer_unit')
            // )
            ->toolbarActions([
                BulkActionGroup::make([
                    self::getDeleteBulkAction('customer_unit'),
                ]),
            ]);
    }
}
