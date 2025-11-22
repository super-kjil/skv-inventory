<?php

namespace App\Traits;

use Filament\Actions\DeleteAction;
use Filament\Actions\EditAction;

/**
 * Trait HasResourceTableActions
 * 
 * Provides static helper methods for common table actions with automatic permission checks.
 * 
 * Usage Examples:
 * 
 * 1. For record actions (individual row actions):
 *    ->recordActions(HasResourceTableActions::getEditDeleteActions('product'))
 * 
 * 2. For bulk delete actions:
 *    ->toolbarActions([
 *        BulkActionGroup::make([
 *            HasResourceTableActions::getDeleteBulkAction('product'),
 *        ]),
 *    ])
 */
trait HasResourceTableActions
{
    /**
     * Get standard edit and delete actions with permission checks.
     * 
     * @param string $resource The resource name (e.g., 'product', 'category')
     * @return array
     */
    public static function getEditDeleteActions(string $resource): array
    {
        return [
            EditAction::make()
                ->visible(fn () => request()->user()?->can("{$resource}.edit")),
            DeleteAction::make()
                ->visible(fn () => request()->user()?->can("{$resource}.delete")),
        ];
    }

    /**
     * Get standard bulk delete action with permission checks.
     * 
     * @param string $resource The resource name (e.g., 'product', 'category')
     * @return \Filament\Actions\DeleteBulkAction
     */
    public static function getDeleteBulkAction(string $resource)
    {
        return \Filament\Actions\DeleteBulkAction::make()
            ->visible(fn () => request()->user()?->can("{$resource}.delete"));
    }
}
