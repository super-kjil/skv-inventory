<?php

namespace App\Filament\Resources\CustomerUnits;

use App\Filament\Resources\CustomerUnits\Pages\CreateCustomerUnit;
use App\Filament\Resources\CustomerUnits\Pages\EditCustomerUnit;
use App\Filament\Resources\CustomerUnits\Pages\ListCustomerUnits;
use App\Filament\Resources\CustomerUnits\RelationManagers\WifiInfoRelationManager;
use App\Filament\Resources\CustomerUnits\Schemas\CustomerUnitForm;
use App\Filament\Resources\CustomerUnits\Tables\CustomerUnitsTable;
use App\Models\CustomerUnit;
use App\Traits\HasResourcePermissions;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class CustomerUnitResource extends Resource
{
    use HasResourcePermissions;
    
    protected static ?string $model = CustomerUnit::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static string|UnitEnum|null $navigationGroup = 'Customer Management';
    
    protected static ?string $recordTitleAttribute = 'unit_name';

    protected static ?int $navigationSort = 1;


    public static function form(Schema $schema): Schema
    {
        return CustomerUnitForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustomerUnitsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            WifiInfoRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListCustomerUnits::route('/'),
            'create' => CreateCustomerUnit::route('/create'),
            'edit' => EditCustomerUnit::route('/{record}/edit'),
        ];
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }
}
