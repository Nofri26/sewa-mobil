<?php

namespace App\Enum\Rental;

enum Status: string
{
    case RENTED = 'rented';
    case AVAILABLE = 'available';
}
