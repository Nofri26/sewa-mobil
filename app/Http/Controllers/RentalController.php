<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Http\Resources\RentalResource;
use App\Models\Car;
use App\Models\Rental;
use App\Services\CarService;
use App\Services\RentalService;
use Illuminate\Http\RedirectResponse;
use Inertia\Inertia;
use Inertia\Response;

class RentalController extends Controller
{

    public function __construct(protected RentalService $rentalService, protected CarService $carService)
    {
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $rentals = $this->rentalService->findAllWithPaginate(10);
        return Inertia::render('Rentals/Index', [
            'rentals' => RentalResource::collection($rentals),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Rentals/Form', [
            'cars' => $this->carService->getAvailableCars()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRentalRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $this->rentalService->createRental($data);
        return redirect()->route('rentals.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rental $rental): Response
    {
        return Inertia::render('Rentals/Show', [
            'rental' => $rental
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rental $rental)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRentalRequest $request, Rental $rental)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        //
    }
}
