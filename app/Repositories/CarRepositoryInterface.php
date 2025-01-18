<?php

namespace App\Repositories;

use App\Models\Car;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CarRepositoryInterface
{
    public function findAllWithPaginate(int $perPage): LengthAwarePaginator;

    public function findById(int $id): ?Car;

    public function findBy(array $conditions): array;

    public function save(Car $car): Car;

    public function updateAvailableCar(int $id, bool $is_available): Car;

    public function delete(int $id): void;
}
