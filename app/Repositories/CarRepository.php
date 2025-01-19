<?php

namespace App\Repositories;

use App\Models\Car;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CarRepository implements CarRepositoryInterface
{
    /**
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Car::query()->with('rentals')->get();
    }

    /**
     * @param int $perPage
     * @return LengthAwarePaginator
     */
    public function findAllWithPaginate(int $perPage): LengthAwarePaginator
    {
        return Car::query()->paginate($perPage);
    }

    /**
     * @param int $id
     * @return Car|null
     */
    public function findById(int $id): ?Car
    {
        return Car::query()->find($id);
    }

    /**
     * @param array $conditions
     * @return Collection
     */
    public function findBy(array $conditions): Collection
    {
        return Car::query()->with('rentals')->where($conditions)->get();
    }

    /**
     * @param Car $car
     * @return Car
     */
    public function save(Car $car): Car
    {
        $car->save();
        return $car;
    }

    /**
     * @param int $id
     * @param bool $is_available
     * @return Car
     */
    public function updateAvailableCar(int $id, bool $is_available): Car
    {
        $car = $this->findById($id);
        $car?->update(['is_available' => $is_available]);
        return $car;
    }

    /**
     * @param int $id
     * @return void
     */
    public function delete(int $id): void
    {
        $car = $this->findById($id);
        $car?->delete();
    }
}
