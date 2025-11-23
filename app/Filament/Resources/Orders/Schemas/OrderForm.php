<?php

namespace App\Filament\Resources\Orders\Schemas;

use App\Enums\CustomerTypeEnum;
use App\Enums\CustomerUnitEnum;
use App\Enums\OrderStatusEnum;
use App\Models\Order;
use App\Models\Product;
use Filament\Actions\Action;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Infolists\Components\TextEntry;
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
                                ->required()
                                ->createOptionForm([
                                    TextInput::make('unit_name')
                                        ->label('Unit Name')
                                        ->required(),
                                    TextInput::make('customer_name')
                                        ->label('Customer Name')
                                        ->nullable(),
                                    TextInput::make('customer_id')
                                        ->label('Customer ID')
                                        ->nullable(),
                                    Select::make('customer_type')
                                        ->label('Customer Type')
                                        ->options([
                                            CustomerTypeEnum::Tenant->value => 'Tenant',
                                            CustomerTypeEnum::Owner->value => 'Owner',
                                        ])
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
                                        ->default(CustomerUnitEnum::Active->value)
                                        ->label('Status')
                                        ->required(),
                                    TextInput::make('remark')
                                        ->label('Remarks')
                                        ->nullable(),

                                ])
                                ->createOptionAction(function (Action $action) {
                                    return $action
                                        ->modalHeading('Create customer')
                                        ->modalSubmitActionLabel('Create customer')
                                        ->modalWidth('lg');
                                }),
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
                            ToggleButtons::make('status')
                                ->inline()
                                ->options(OrderStatusEnum::class)
                                ->required(),
                        ])->columns(2),

                        TextInput::make('remark')
                            ->label('Remarks')
                            ->nullable(),
                    ])->columnSpan(2),
                Section::make()
                    ->schema([
                        TextEntry::make('created_at')
                            ->label('Order date')
                            ->state(fn(Order $record): ?string => $record->created_at?->diffForHumans()),

                        TextEntry::make('updated_at')
                            ->label('Last modified at')
                            ->state(fn(Order $record): ?string => $record->updated_at?->diffForHumans()),
                    ])
                    ->columnSpan(['lg' => 1])
                    ->hidden(fn(?Order $record) => $record === null),
            ])->columns(3);
    }
}
