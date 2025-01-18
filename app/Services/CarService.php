<?php

namespace App\Services;

use App\Models\Car;
use Illuminate\Database\Eloquent\Collection;

class CarService
{
    public function getAllCars(): Collection
    {
        return Car::all();
    }

    public function createCar($data)
    {
        return Car::query()->create($data);
    }
}
