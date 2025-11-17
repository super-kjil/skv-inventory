<?php

namespace App\Enums;

enum OrderStatusEnum : string
{
    case BUY = 'Buy';
    case LOAN = 'Loan';
    case SPOILED = 'Spoiled';
}
