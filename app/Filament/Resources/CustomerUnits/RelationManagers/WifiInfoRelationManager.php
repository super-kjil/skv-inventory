<?php

namespace App\Filament\Resources\CustomerUnits\RelationManagers;

use Dom\Text;
use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class WifiInfoRelationManager extends RelationManager
{
    protected static string $relationship = 'wifiInfomation';

    protected static ?string $recordTitleAttribute = 'ssid';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('ssid')
                    ->label('WiFi SSID')
                    ->required(),
                TextInput::make('password')
                    ->label('WiFi Password')
                    ->required(),
                Select::make('product_id')
                    ->label('Access Point (AP)')
                    ->relationship('product', 'name')
                    ->required(),
                TextInput::make('mgmt_ip')
                    ->label('Management IP')
                    ->required(),
                TextInput::make('wifi_user')
                    ->label('Management User')
                    ->required(),
                TextInput::make('wifi_password')
                    ->label('Management Password')
                    ->required(),
                Select::make('status')
                    ->label('Status')
                    ->options([
                        'Active' => 'Active',
                        'Inactive' => 'Inactive',
                        'Pending' => 'Pending',
                        'Terminated' => 'Terminated',
                    ])
                    ->default('Active')
                    ->required(),
                TextInput::make('remark')
                    ->label('Remark')
                    ->nullable(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('ssid')
            ->columns([
                TextColumn::make('index')
                    ->label('No.') // Optional: customize the column header label
                    ->rowIndex()
                    ->getStateUsing(function ($rowLoop) {
                        return $rowLoop->iteration;
                    }),
                TextColumn::make('ssid')
                    ->label('SSID')
                    ->sortable()  
                    ->searchable(),
                TextColumn::make('password')
                    ->label('Password')
                    ->sortable()  
                    ->searchable(),
                TextColumn::make('product.name') 
                    ->label('AP Model')   
                    ->sortable()  
                    ->searchable(),
                TextColumn::make('mgmt_ip')
                    ->label('Management IP') 
                    ->sortable()   
                    ->searchable(),
                TextColumn::make('mgmt_user')
                    ->label('Management User')
                    ->searchable(),
                TextColumn::make('mgmt_password')
                    ->label('Management Password')
                    ->searchable(),
                TextColumn::make('status')  
                    ->label('Status')
                    ->badge()
                    ->searchable(),
                TextColumn::make('remark')
                    ->label('Remark')
                    ->searchable(),
            ])  
            ->filters([
                //
            ])
            ->headerActions([
                CreateAction::make(),
                // AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                // DissociateAction::make(),
                // DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    // DissociateBulkAction::make(),
                    // DeleteBulkAction::make(),
                ]),
            ]);
    }
}
