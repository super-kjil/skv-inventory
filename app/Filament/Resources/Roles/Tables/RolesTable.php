<?php

namespace App\Filament\Resources\Roles\Tables;

use App\Traits\HasResourceTableActions;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class RolesTable
{   
    use HasResourceTableActions;

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Role Name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('permissions_count')
                    ->label('Permissions')
                    ->counts('permissions')
                    ->sortable(),
                TextColumn::make('created_at')
                    ->label('Created')
                    ->date('d-M-Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions(
                self::getEditDeleteActions('role')
                )
            ->toolbarActions([
            BulkActionGroup::make([
                self::getDeleteBulkAction('role'),
            ]),
            ]);
    }
}
