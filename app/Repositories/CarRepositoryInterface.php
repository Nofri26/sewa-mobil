<?php

namespace App\Repositories;

use App\Models\Car;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface CarRepositoryInterface
{
    public function getAll(): Collection;

    public function findAllWithPaginate(int $perPage): LengthAwarePaginator;

    public function findById(int $id): ?Car;

    public function findBy(array $conditions): Collection;

    public function save(Car $car): Car;

    public function updateAvailableCar(int $id, bool $is_available): Car;

    public function delete(int $id): void;
}
