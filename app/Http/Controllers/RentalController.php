<?php

namespace App\Http\Controllers;

use App\Enum\User\Roles;
use App\Http\Requests\SearchRentalRequest;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use App\Http\Resources\CarResource;
use App\Http\Resources\RentalResource;
use App\Models\Rental;
use App\Models\User;
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
        if (auth()->user()->role === Roles::ADMIN) {
            $rentals = $this->rentalService->findAllWithPaginate(10);
        } else {
            $rentals = $this->rentalService->findByWithPaginate(['created_by_id' => auth()->user()->id], 10);
        }
        return Inertia::render('Rentals/Index', [
            'rentals' => RentalResource::collection($rentals),
            'users' => User::all()
        ]);
    }

    /**
     * @param SearchRentalRequest $request
     * @return Response
     */
    public function search(SearchRentalRequest $request): Response
    {
        $data = $request->validated();
        $rental = $this->rentalService->searchByPlateNumber($data['user_id'], $data['plate_number']);
        return Inertia::render('Rentals/Show', [
            'rental' => new RentalResource($rental),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): Response
    {
        return Inertia::render('Rentals/Form', [
            'cars' => CarResource::collection($this->carService->getAll()),
            'users' => User::all()
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
            'rental' => new RentalResource($rental),
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
    public function update(UpdateRentalRequest $request, Rental $rental): RedirectResponse
    {
        $this->rentalService->createReturnRental($rental);
        return redirect()->route('rentals.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rental $rental)
    {
        //
    }
}
