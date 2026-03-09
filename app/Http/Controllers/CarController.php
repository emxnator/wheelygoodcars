<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CarController extends Controller
{
    /**
     * Show the license plate form (step 1).
     */
    public function showLicensePlateForm()
    {
        return view('cars.create_step1');
    }

    /**
     * Process license plate and redirect to details form.
     */
    public function storeLicensePlate(Request $request)
    {
        $validated = $request->validate([
            'license_plate' => 'required|string|max:255',
        ]);

        // Store license plate in session for step 2
        session(['car_data' => ['license_plate' => $validated['license_plate']]]);

        // Optional: Fetch car data from RDW API (Dutch vehicle registration)
        // This is a placeholder - you can implement actual API call if needed
        $carData = $this->fetchCarDataFromAPI($validated['license_plate']);
        
        if ($carData) {
            session()->put('car_data', array_merge(session('car_data', []), $carData));
        }

        return redirect()->route('cars.create.details');
    }

    /**
     * Show the car details form (step 2).
     */
    public function showDetailsForm()
    {
        // Check if step 1 data exists
        if (!session()->has('car_data.license_plate')) {
            return redirect()->route('cars.create')
                ->with('error', 'Vul eerst het kenteken in.');
        }

        $carData = session('car_data', []);
        
        return view('cars.create_step2', compact('carData'));
    }

    /**
     * Store the car in the database.
     */
    public function store(Request $request)
    {
        if (!session()->has('car_data.license_plate')) {
            return redirect()->route('cars.create')
                ->with('error', 'Vul eerst het kenteken in.');
        }

        $validated = $request->validate([
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'mileage' => 'required|integer|min:0',
            'seats' => 'nullable|integer|min:1',
            'doors' => 'nullable|integer|min:1',
            'production_year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'weight' => 'nullable|integer|min:0',
            'color' => 'nullable|string|max:255',
        ]);

        $carData = array_merge(session('car_data', []), $validated);

        // Create the car using the relationship (automatically sets user_id)
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $car = $user->cars()->create($carData);

        session()->forget('car_data');

        return redirect()->route('cars.show', $car->id)
            ->with('success', 'Auto succesvol aangeboden!');
    }

    /**
     * Display all available cars.
     */
    public function index()
    {
        $cars = Car::with('user')
            ->available()
            ->orderBy('created_at', 'desc')
            ->get();

        return view('cars.index', compact('cars'));
    }

    /**
     * Display the authenticated user's car listings.
     */
    public function myListings()
    {
        // Using the relationship method as recommended
        /** @var \App\Models\User $user */
        $user = auth()->user();
        $cars = $user->cars()->orderBy('created_at', 'desc')->get();

        return view('cars.my_listings', compact('cars'));
    }

    /**
     * Display the specified car.
     */
    public function show(Car $car)
    {
        $car->increment('views');

        return view('cars.show', compact('car'));
    }

   
    public function destroy(Car $car)
    {
        if ($car->user_id !== auth()->id()) {
            abort(403, 'Ongeautoriseerde actie.');
        }

        $car->delete();

        return redirect()->route('cars.my-listings')
            ->with('success', 'Auto succesvol verwijderd.');
    }

    /**
     * Fetch car data from external API (placeholder).
     */
    private function fetchCarDataFromAPI($licensePlate)
    {
        // This is a placeholder for RDW API integration
        // You can implement actual API call here
        // For now, return null to skip auto-fill
        
        /* Example implementation:
        try {
            $response = Http::get('https://api.rdw.nl/v1/kenteken/' . $licensePlate);
            if ($response->successful()) {
                $data = $response->json();
                return [
                    'brand' => $data['merk'] ?? null,
                    'model' => $data['handelsbenaming'] ?? null,
                    // etc.
                ];
            }
        } catch (\Exception $e) {
            // Handle error
        }
        */
        
        return null;
    }
}
