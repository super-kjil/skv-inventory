<?php

namespace App\Enums;

enum CustomerUnitEnum : string
{
    case Active = 'Active';
    case Inactive = 'Inactive';
    case Terminated = 'Terminated';
    case Pending = 'Pending';

    public function getColor(): string
    {
        return match ($this) {
            self::Active => 'success',
            self::Inactive => 'danger',
            self::Terminated => 'danger',
            self::Pending => 'warning',
        };
    }
}