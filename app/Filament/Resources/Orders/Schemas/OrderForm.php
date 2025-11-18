<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatusEnum;
use App\Models\Product;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class OrderForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('product_id')
                    ->label('Product')
                    ->relationship('product', 'name')
                    ->preload()
                    ->afterStateUpdated(fn ($state, callable $set) =>
                    $set('available_qty', Product::find($state)?->qty)
                )
                ->required(),
                TextInput::make('support_person')
                    ->label('Support Person')
                    ->required(),
                TextInput::make('customer_unit')
                    ->label('Customer Unit')
                    ->required(),
                DatePicker::make('date')
                    ->label('Date')
                    ->date()
                    ->default(now())
                    ->required(),
                TextInput::make('qty')
                ->label('Order Qty')
                ->numeric()
                ->required()
                ->reactive()
                ->rule(function (callable $get) {
                    return function (string $attribute, $value, $fail) use ($get) {
                        $available = $get('available_qty');
                        if ($available !== null && $value > $available) {
                            $fail("Only {$available} item(s) available in stock.");
                        }
                    };
                }),
                Select::make('status')
                    ->options([
                        OrderStatusEnum::BUY->value => 'Buy',
                        OrderStatusEnum::LOAN->value => 'Loan',
                        OrderStatusEnum::SPOILED->value => 'Spoiled',
                    ])
                    ->label('Status')
                    ->required(),
                TextInput::make('commands')
                    ->label('Commands')
                    ->nullable(),
            ]);
    }
}
