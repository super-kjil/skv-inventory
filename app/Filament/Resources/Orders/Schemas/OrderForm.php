<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatusEnum;
use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Group;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Order Details')
                    ->schema([
                        Group::make([
                            Select::make('customer_unit_id')
                                ->label('Customer Unit')
                                ->relationship('customerUnit', 'unit_name')
                                ->searchable()
                                ->preload()
                                ->required(),
                            Select::make('product_id')
                                ->label('Product Items')
                                ->relationship('product', 'name')
                                ->preload()
                                ->afterStateUpdated(
                                    fn($state, callable $set) =>
                                    $set('available_qty', Product::find($state)?->qty)
                                )
                                ->required(),
                        ])->columns(2),
                        Group::make([
                            TextInput::make('qty')
                                ->label('Items Qty')
                                ->numeric()
                                // ->required()
                                ->reactive()
                                ->rule(function (callable $get) {
                                    return function (string $attribute, $value, $fail) use ($get) {
                                        $available = $get('available_qty');
                                        if ($available !== null && $value > $available) {
                                            $fail("Only {$available} item(s) available in stock.");
                                        }
                                    };
                                }),
                            DatePicker::make('date')
                                ->label('Date')
                                ->date()
                                ->default(now())
                                ->required(),
                        ])->columns(2),
                        Group::make([
                            TextInput::make('support_person')
                                ->label('Support Person')
                                ->required(),
                            Select::make('status')
                                ->options([
                                    OrderStatusEnum::BUY->value => 'Buy',
                                    OrderStatusEnum::LOAN->value => 'Loan',
                                    OrderStatusEnum::SPOILED->value => 'Spoiled',
                                ])
                                ->label('Status')
                                ->required(),
                        ])->columns(2),

                        TextInput::make('remark')
                            ->label('Remarks')
                            ->nullable(),
                    ])
            ])->columns(1);
    }
}
