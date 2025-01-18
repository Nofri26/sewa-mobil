<?php

namespace App\Services;

use App\Enum\Rental\Status;
use App\Models\Car;
use App\Models\Rental;
use App\Models\ReturnRental;
use App\Repositories\RentalRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Date;

class RentalService
{
    public function __construct(protected RentalRepositoryInterface $repository, protected CarService $carService)
    {
    }

    public function findAllWithPaginate(int $perPage): LengthAwarePaginator
    {
        return $this->repository->findAllWithPaginate($perPage);
    }

    public function createRental(array $data): Rental
    {
        $rental = new Rental($data);
        $this->carService->updateAvailableCar($rental, false);
        return $this->repository->save($rental);
    }

    public function createReturnRental(array $data): ReturnRental
    {
        $rental = $data['rental'];

        $returnRentalData = [
            'rental_id' => $rental['id'],
            'return_date' => Date::now(),
            'days' => $rental['end']->diffInDays($rental['start']),
            'cost' => $rental['cost'],
        ];

        return $this->repository->saveReturnRental($returnRentalData);
    }
}
