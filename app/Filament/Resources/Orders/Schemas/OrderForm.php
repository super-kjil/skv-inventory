<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\OrderStatusEnum;
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
                    ->label('Quantity')
                    ->numeric()
                    ->required(),
                Select::make('status')
                    ->options([
                        OrderStatusEnum::BUY->value => 'Buy',
                        OrderStatusEnum::LOAN->value => 'Loan',
                        OrderStatusEnum::SPOILED->value => 'Spoiled',
                    //  //
                    //     'pending' => 'Pending',
                    //     'completed' => 'Completed',
                    //     'canceled' => 'Canceled',
                    ])
                    ->label('Status')
                    ->required(),
                TextInput::make('commands')
                    ->label('Commands')
                    ->nullable(),
            ]);
    }
}
