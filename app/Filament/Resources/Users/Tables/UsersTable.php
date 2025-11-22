<?php

namespace App\Filament\Resources\Users\Tables;

use App\Traits\HasResourceTableActions;
use Dom\Text;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    use HasResourceTableActions;

    public static function configure(Table $table): Table
    {

        return $table
            ->columns([
                TextColumn::make('index')
                ->label('No.')
                ->rowIndex(),
                TextColumn::make('name')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('email')
                    ->label('Email')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('roles.name')->badge(),
                TextColumn::make('created_at')
                    ->label('Created At')
                    ->date('d-M-Y')
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            // ->recordActions([
            //     EditAction::make()
            //         ->visible(fn () => request()->user()?->can('user.edit')),
            //     DeleteAction::make()
            //         ->visible(fn () => request()->user()?->can('user.delete')),
            // ])
            // ->toolbarActions([
            //     BulkActionGroup::make([
            //         DeleteBulkAction::make()
            //             ->visible(fn () => request()->user()?->can('user.delete')),
            //     ]),
            // ]);
            ->recordActions(
                self::getEditDeleteActions('user')
                )
            ->toolbarActions([
            BulkActionGroup::make([
                self::getDeleteBulkAction('user'),
            ]),
        ]);
    }
}
