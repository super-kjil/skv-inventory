<?php

namespace App\Filament\Resources\Orders\Tables;

use App\Enums\OrderStatusEnum;
use App\Traits\HasResourceTableActions;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class OrdersTable
{   
    use HasResourceTableActions;
    
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                ->label('No.')
                ->rowIndex(),
                TextColumn::make('customerUnit.unit_name')
                    ->label('Customer Unit')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('product.name')
                    ->label('Product Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('support_person')
                    ->label('Support Person')
                    ->sortable()
                    ->searchable(),               
                TextColumn::make('date')
                    ->label('Date')
                    ->date()
                    ->sortable(),
                TextColumn::make('qty') 
                    ->label('Quantity')
                    ->sortable(),
                TextColumn::make('status')
                    ->label('Status')
                    ->badge()
                    ->color(fn ($state): string => OrderStatusEnum::from($state)->getColor())
                    ->sortable(),
                TextColumn::make('remark')
                    ->label('Remarks')
                    ->limit(50)
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions(
                self::getEditDeleteActions('order')
                )
            ->toolbarActions([
            BulkActionGroup::make([
                self::getDeleteBulkAction('order'),
            ]),
            ]);
    }
}
