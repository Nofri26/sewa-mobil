<?php

namespace App\Repositories;

use App\Models\Rental;
use App\Models\ReturnRental;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

interface RentalRepositoryInterface
{
    public function findAllWithPaginate(int $perPage): LengthAwarePaginator;

    public function findByWithPaginate(array $conditions, int $perPage): LengthAwarePaginator;

    public function findById(int $id): ?Rental;

    public function findBy(array $conditions): Collection;

    public function save(Rental $rental): Rental;

    public function saveReturnRental(array $data): ReturnRental;

    public function delete(int $id): void;
}
