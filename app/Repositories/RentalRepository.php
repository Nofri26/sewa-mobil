<?php

namespace App\Repositories;

use App\Models\Rental;
use App\Models\ReturnRental;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class RentalRepository implements RentalRepositoryInterface
{

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function findAllWithPaginate(int $perPage): LengthAwarePaginator
    {
        return Rental::query()->with('createdBy')->paginate($perPage);
    }

    /**
     * @param int $id
     * @return Rental|null
     */
    public function findById(int $id): ?Rental
    {
        return Rental::query()->find($id);
    }

    /**
     * @param array $conditions
     * @return Collection
     */
    public function findBy(array $conditions): Collection
    {
        return Rental::query()->where($conditions)->get();
    }

    /**
     * @param Rental $rental
     * @return Rental
     */
    public function save(Rental $rental): Rental
    {
        $rental->save();
        return $rental;
    }

    /**
     * @param array $data
     * @return ReturnRental
     */
    public function saveReturnRental(array $data): ReturnRental
    {
        return ReturnRental::query()->create($data);
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $rental = $this->findById($id);
        $rental->delete();
    }

    /**
     * @param array $conditions
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function findByWithPaginate(array $conditions, int $perPage): LengthAwarePaginator
    {
        return Rental::query()
            ->with('createdBy')
            ->where($conditions)
            ->paginate($perPage);
    }
}
