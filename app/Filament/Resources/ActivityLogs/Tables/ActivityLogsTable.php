<?php

namespace App\Filament\Resources\ActivityLogs\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ActivityLogsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                // TextColumn::make('log_name')
                //     ->label('Log Name')
                //     ->searchable(),

                TextColumn::make('description')
                    ->label('Description')
                    ->wrap()
                    ->searchable(),

                TextColumn::make('causer.name')
                    ->label('Caused By')
                    ->badge()
                    ->color('primary')
                    ->sortable(),

                // TextColumn::make('subject_type')
                //     ->label('Subject Type'),

                // TextColumn::make('subject_id')
                //     ->label('Subject ID'),

                TextColumn::make('properties')
                    ->label('Changes')
                    ->formatStateUsing(function ($state) {
                        if (!is_array($state)) {
                            return $state; // Display as is if not an array
                        }

                        $output = [];
                        foreach ($state as $key => $value) {
                            if (is_array($value)) {
                                // For nested arrays, you might want to further process or simplify
                                $output[] = "{$key}: " . json_encode($value); // Fallback to JSON for nested arrays
                            } else {
                                $output[] = "{$key}: {$value}";
                            }
                        }
                        return implode(', ', $output);
                    })
                    ->wrap(),

                TextColumn::make('created_at')
                    ->label('Date')
                    ->datetime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                // EditAction::make(),
            ])
            ->toolbarActions([
                // BulkActionGroup::make([
                //     DeleteBulkAction::make(),
                // ]),
            ]);
    }
}
