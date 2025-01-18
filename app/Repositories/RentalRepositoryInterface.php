<?php

namespace App\Repositories;

use App\Models\Rental;
use App\Models\ReturnRental;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface RentalRepositoryInterface
{
    public function findAllWithPaginate(int $perPage): LengthAwarePaginator;

    public function findById(int $id): ?Rental;

    public function findBy(array $conditions): array;

    public function save(Rental $rental): Rental;

    public function saveReturnRental(array $data): ReturnRental;

    public function delete(int $id): void;
}
