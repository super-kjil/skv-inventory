<?php

namespace App\Traits;

/**
 * Trait HasResourcePermissions
 * 
 * Automatically handles permission checks for Filament resources.
 * The resource name is derived from the model class name (e.g., Product -> product).
 * 
 * Usage:
 * 1. Add to your Resource class: use HasResourcePermissions;
 * 2. No need to define canViewAny(), canCreate(), canEdit(), canDelete(), canDeleteAny()
 * 
 * Example:
 * class ProductResource extends Resource {
 *     use HasResourcePermissions;
 *     protected static ?string $model = Product::class;
 * }
 */
trait HasResourcePermissions
{
    /**
     * Get the resource name for permission checks.
     * Converts the model class name to snake_case.
     * 
     * Example: Product -> product, CustomerUnit -> customer_unit
     */
    protected static function getResourceName(): string
    {
        $modelClass = static::$model ?? static::class;
        $modelName = class_basename($modelClass);
        
        // Convert CamelCase to snake_case
        // e.g., "Product" -> "product", "CustomerUnit" -> "customer_unit"
        return strtolower(preg_replace('/(?<!^)(?=[A-Z])/', '_', $modelName));
    }

    public static function canViewAny(): bool
    {
        $resource = static::getResourceName();
        return request()->user()?->can("{$resource}.view");
    }

    public static function canCreate(): bool
    {
        $resource = static::getResourceName();
        return request()->user()?->can("{$resource}.create");
    }

    public static function canEdit($record): bool
    {
        $resource = static::getResourceName();
        return request()->user()?->can("{$resource}.edit");
    }

    public static function canDelete($record): bool
    {
        $resource = static::getResourceName();
        return request()->user()?->can("{$resource}.delete");
    }

    public static function canDeleteAny(): bool
    {
        $resource = static::getResourceName();
        return request()->user()?->can("{$resource}.delete");
    }
}
