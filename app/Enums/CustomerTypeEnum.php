<?php

namespace App\Enums;

enum CustomerTypeEnum : string
{
    case Tenant = 'Tenant';
    case Owner = 'Owner';

    public function getColor(): string
    {
        return match ($this) {
            self::Tenant => 'primary',
            self::Owner => 'success',
        };
    }
}

