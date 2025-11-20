<?php

namespace App\Filament\Resources\CustomerUnits\Tables;

use App\Enums\CustomerUnitEnum;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CustomerUnitsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('unit_name')
                    ->label('Unit Name'),
                TextColumn::make('floor')
                    ->label('Floor'),
                TextColumn::make('site.name')
                    ->label('Site'),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state): string => CustomerUnitEnum::from($state)->getColor()),
                TextColumn::make('remark')
                    ->label('Remarks'),
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
            ]);
    }
}
