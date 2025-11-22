<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;

enum OrderStatusEnum : string implements HasColor, HasIcon
{
    case BUY = 'Buy';
    case LOAN = 'Loan';
    case SPOILED = 'Spoiled';

    public function getColor(): string
    {
        return match ($this) {
            self::BUY => 'success',
            self::LOAN => 'info',
            self::SPOILED => 'danger',
        };
    }

    public function getIcon(): string
    {
        return match ($this) {
            self::BUY => 'heroicon-o-shopping-cart',
            self::LOAN => 'heroicon-o-truck',
            self::SPOILED => 'heroicon-o-x-circle',
        };
    }
}