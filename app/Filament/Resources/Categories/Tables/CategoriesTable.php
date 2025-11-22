<?php

namespace App\Filament\Resources\Categories\Tables;

use App\Traits\HasResourceTableActions;
use Illuminate\Support\Facades\Auth;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Schemas\Components\View;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class CategoriesTable
{   
    use HasResourceTableActions;
    
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('index')
                ->label('No.') // Optional: customize the column header label
                ->rowIndex(),
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                IconColumn::make('active')
                    ->label('Status')
                    ->boolean()
                    ->sortable()
                    ->searchable(),
                TextColumn::make('updated_at')
                    ->label('Last Modified At')
                    ->date('d-M-Y')
                    ->sortable()
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->recordActions(
                self::getEditDeleteActions('category')
                )
            ->toolbarActions([
            BulkActionGroup::make([
                self::getDeleteBulkAction('category'),
            ]),
            ]);
    }
}
