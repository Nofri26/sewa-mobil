<?php

namespace App\Services;

use App\Models\Car;
use App\Models\Rental;
use App\Repositories\CarRepository;
use App\Repositories\CarRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class CarService
{

    public function __construct(protected CarRepositoryInterface $repository)
    {
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function findAllWithPaginate(int $perPage): LengthAwarePaginator
    {
        return $this->repository->findAllWithPaginate($perPage);
    }

    public function findAvailableCars(): Collection
    {
        return $this->repository->findBy(['is_available' => false]);
    }

    public function findBy(array $condition): Collection
    {
        return $this->repository->findBy($condition);
    }

    public function createCar(array $data): Car
    {
        $car = new Car($data);
        return $this->repository->save($car);
    }

    public function updateAvailableCar(Rental $rental, bool $is_available): Car
    {
        $id = $rental['car_id'];
        return $this->repository->updateAvailableCar($id, $is_available);
    }
}
