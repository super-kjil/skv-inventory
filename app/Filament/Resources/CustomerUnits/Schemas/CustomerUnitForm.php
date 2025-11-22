<?php

namespace App\Filament\Resources\CustomerUnits\Schemas;

use App\Enums\CustomerTypeEnum;
use App\Enums\CustomerUnitEnum;
use Dom\Text;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class CustomerUnitForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Customer Info')
                    ->schema([
                        Group::make([
                            TextInput::make('unit_name')
                                ->label('Unit')
                                ->required(),
                            Select::make('customer_type')
                                ->label('Customer Type')
                                ->options([
                                    CustomerTypeEnum::Tenant->value => 'Tenant',
                                    CustomerTypeEnum::Owner->value => 'Owner',
                                ]),
                        ])->columns(2),
                        Group::make([
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
                                ->default(CustomerUnitEnum::Active->value)
                                ->label('Status')
                                ->required(),
                        ])->columns(2),
                        Group::make([
                            TextInput::make('customer_name')
                                ->label('Customer Name')
                                ->nullable(),
                            TextInput::make('customer_id')
                                ->label('Customer ID')
                                ->nullable(),
                        ])->columns(2),
                        Group::make([
                            TextInput::make('customer_tel')
                                ->label('Phone Number')
                                ->tel()
                                ->nullable(),
                            TextInput::make('remark')
                                ->label('Remarks')
                                ->nullable(),
                        ])->columns(2),
                    ])->columns(2),
            ])->columns(1);
    }
}
