<?php

namespace App\Enums;

enum UserRole: string
{
    case ADMIN = 'ADMIN';
    case RETAILER = 'RETAILER';
    case USER = 'USER';
}
