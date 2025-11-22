<?php

namespace App\Filament\Resources\Sites\Tables;

use App\Traits\HasResourceTableActions;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SitesTable
{   
    use HasResourceTableActions;

    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('name')
                    ->label('Site Name'),
            ])
            ->filters([
                //
            ])
            ->recordActions(
                self::getEditDeleteActions('site')
                )
            ->toolbarActions([
            BulkActionGroup::make([
                self::getDeleteBulkAction('site'),
            ]),
        ]);
    }
}
