@extends('layouts.app')

@section('content')
<div class="all-cars container mt-5">
    <div class="row">
        <div class="col-12">
            <h2 class="mb-4">Alle auto's</h2>
            @if($cars->isEmpty())
                <div class="empty card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-car-front" style="font-size: 4rem; color: #ddd;"></i>
                        <h4 class="mt-3 text-muted">Nog geen auto's beschikbaar</h4>
                        <p class="text-muted">Wees de eerste om een auto aan te bieden!</p>
                    </div>
                </div>
            @else
                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                    @foreach($cars as $car)
                        <div class="col">
                            <div class="card h-100">
                                @if($car->image)
                                    <img src="{{ asset('storage/' . $car->image) }}" class="card-img-top" alt="{{ $car->brand }} {{ $car->model }}">
                                @else
                                    <div class="bg-light p-5 text-center">
                                        <i class="bi bi-car-front-fill" style="font-size: 3rem; color: #ddd;"></i>
                                    </div>
                                @endif
                                <div class="card-body">
                                    <h5 class="card-title">{{ $car->brand }} {{ $car->model }}</h5>
                                    <h6 class="text-primary mb-3">€ {{ number_format($car->price, 2, ',', '.') }}</h6>
                                    
                                    <ul class="list-unstyled small">
                                        <li><strong>Kenteken:</strong> {{ $car->license_plate }}</li>
                                        <li><strong>Kilometerstand:</strong> {{ number_format($car->mileage, 0, ',', '.') }} km</li>
                                        @if($car->production_year)
                                            <li><strong>Bouwjaar:</strong> {{ $car->production_year }}</li>
                                        @endif
                                        @if($car->color)
                                            <li><strong>Kleur:</strong> {{ $car->color }}</li>
                                        @endif
                                    </ul>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="bi bi-eye"></i> {{ $car->views }} views
                                        </small>
                                        <a href="{{ route('cars.show', $car->id) }}" class="btn btn-primary btn-sm">
                                            Bekijken
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
