<?php

namespace App\Filament\Resources\CustomerUnits\Schemas;

use App\Enums\CustomerUnitEnum;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class CustomerUnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('unit_name')
                    ->label('Unit Name')
                    ->required(),
                TextInput::make('floor')
                    ->label('Floor')
                    ->required(),
                Select::make('site_id')
                    ->label('Site')
                    ->relationship('site', 'name')
                    ->searchable()
                    ->preload()
                    ->required(),
                Select::make('status')
                    ->options([
                        CustomerUnitEnum::Active->value => 'Active',
                        CustomerUnitEnum::Inactive->value => 'Inactive',
                        CustomerUnitEnum::Pending->value => 'Pending',
                        CustomerUnitEnum::Terminated->value => 'Terminated',
                    ])
                    ->label('Status')
                    ->required(),
                TextInput::make('remark')
                    ->label('Remarks')
                    ->nullable(),
            ]);
    }
}
