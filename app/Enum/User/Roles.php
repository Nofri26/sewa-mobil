<?php

namespace App\Enum\User;

enum Roles: string
{
    case ADMIN = 'admin';
    case USER = 'user';
}
