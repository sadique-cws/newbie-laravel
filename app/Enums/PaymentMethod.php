<?php

namespace App\Enums;

enum PaymentMethod: string
{
    case COD = 'COD';
    case ONLINE = 'ONLINE';
    case UPI = 'UPI';
    case CARD = 'CARD';
}
