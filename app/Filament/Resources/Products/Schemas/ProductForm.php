<?php

namespace App\Filament\Resources\Products\Schemas;

use Dom\Text;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Facades\Date;

class ProductForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make()
                    ->schema([
                        TextInput::make('name')
                            ->label('Product Name')
                            ->required()
                            ->maxLength(255),
                        Select::make('category_id')
                            ->label('Category')
                            ->relationship('category', 'name')
                            ->searchable()
                            ->preload()
                            ->nullable(),
                        
                        TextInput::make('qty')
                            ->label('Quantity')
                            ->numeric()
                            ->required(),
                        DatePicker::make('instock_date')
                            ->label('In-Stock Date')
                            ->required()
                            ->default(Date::now()),
                        TextInput::make('commands')
                            ->label('Commands')
                            ->maxLength(65535)
                            ->nullable(),
                    ])->columns(1),
                Section::make()
                    ->schema([
                        FileUpload::make('image')
                            ->label('Product Image')
                            ->image()
                            ->imagePreviewHeight(350)
                            ->required(),
                    ])
            ])->columns(2);
    }
}
