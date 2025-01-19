<?php

namespace App\Services;

use App\Enum\Rental\Status;
use App\Models\Rental;
use App\Models\ReturnRental;
use App\Repositories\RentalRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Carbon;

class RentalService
{
    public function __construct(protected RentalRepositoryInterface $repository, protected CarService $carService)
    {
    }

    public function findAllWithPaginate(int $perPage): LengthAwarePaginator
    {
        return $this->repository->findAllWithPaginate($perPage);
    }

    public function findByWithPaginate(array $condition, int $perPage): LengthAwarePaginator
    {
        return $this->repository->findByWithPaginate($condition, $perPage);
    }

    public function createRental(array $data): Rental
    {
        $rental = new Rental($data);
        $this->carService->updateAvailableCar($rental, false);
        return $this->repository->save($rental);
    }

    public function findBy(array $condition): Collection
    {
        return $this->repository->findBy($condition);
    }

    public function searchByPlateNumber(int $user_id, string $plateNumber): Rental
    {
        $car = $this->carService->findBy([
            'plate_number' => $plateNumber,
            'is_available' => false,
        ]);
        $rental = $this->repository->findBy([
            'car_id' => $car[0]['id'],
            'created_by_id' => $user_id,
            'status' => Status::RENTED
        ]);
        return $rental[0];
    }

    public function createReturnRental(Rental $rental): ReturnRental
    {
        $rental['status'] = Status::COMPLETED;
        $this->repository->save($rental);

        $returnRentalData = [
            'rental_id' => $rental['id'],
            'return_date' => Carbon::now(),
            'days' => Carbon::parse($rental['start'])->diffInDays(Carbon::parse($rental['end'])),
            'cost' => $rental['cost'],
        ];

        return $this->repository->saveReturnRental($returnRentalData);
    }
}
