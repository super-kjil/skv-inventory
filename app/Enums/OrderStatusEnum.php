<?php

namespace App\Enums;

use Filament\Support\Contracts\HasColor;

enum OrderStatusEnum : string implements HasColor
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
}


