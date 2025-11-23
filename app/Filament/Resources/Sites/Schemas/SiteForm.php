<?php

namespace App\Filament\Resources\Sites\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;

class SiteForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Site Details')
                    ->schema([
                        TextInput::make('name')
                            ->label('Site Name')
                            ->required(),
                        Select::make('location_id')
                            ->label('Location')
                            ->relationship('location', 'name')
                            ->required(),
                        TextInput::make('direction')  
                    ->label('Lat-Long Direction'), 
                    ])->columns(2),                       
            ])->columns(1);
    }
}
