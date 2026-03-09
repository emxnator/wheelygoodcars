@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card">
            <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                <h4 class="mb-0">{{ $car->brand }} {{ $car->model }}</h4>
                <span class="badge bg-warning text-dark">{{ $car->license_plate }}</span>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        @if($car->image)
                            <img src="{{ asset('storage/' . $car->image) }}" class="img-fluid rounded mb-3" alt="{{ $car->brand }} {{ $car->model }}">
                        @else
                            <div class="bg-light p-5 text-center rounded mb-3">
                                <i class="bi bi-car-front-fill" style="font-size: 5rem; color: #ddd;"></i>
                                <p class="text-muted mt-2">Geen afbeelding beschikbaar</p>
                            </div>
                        @endif

                        <h2 class="text-primary mb-4">€ {{ number_format($car->price, 2, ',', '.') }}</h2>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <h5 class="text-muted">Basiscspecificaties</h5>
                                <table class="table table-sm">
                                    <tr>
                                        <th>Merk</th>
                                        <td>{{ $car->brand }}</td>
                                    </tr>
                                    <tr>
                                        <th>Model</th>
                                        <td>{{ $car->model }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kenteken</th>
                                        <td>{{ $car->license_plate }}</td>
                                    </tr>
                                    <tr>
                                        <th>Kilometerstand</th>
                                        <td>{{ number_format($car->mileage, 0, ',', '.') }} km</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="col-md-6">
                                <h5 class="text-muted">Extra gegevens</h5>
                                <table class="table table-sm">
                                    @if($car->production_year)
                                        <tr>
                                            <th>Jaar van productie</th>
                                            <td>{{ $car->production_year }}</td>
                                        </tr>
                                    @endif
                                    @if($car->color)
                                        <tr>
                                            <th>Kleur</th>
                                            <td>{{ $car->color }}</td>
                                        </tr>
                                    @endif
                                    @if($car->seats)
                                        <tr>
                                            <th>Zitplaatsen</th>
                                            <td>{{ $car->seats }}</td>
                                        </tr>
                                    @endif
                                    @if($car->doors)
                                        <tr>
                                            <th>Aantal deuren</th>
                                            <td>{{ $car->doors }}</td>
                                        </tr>
                                    @endif
                                    @if($car->weight)
                                        <tr>
                                            <th>Massa rijklaar</th>
                                            <td>{{ number_format($car->weight, 0, ',', '.') }} kg</td>
                                        </tr>
                                    @endif
                                </table>
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <strong>Aangeboden door:</strong> {{ $car->user->name }}<br>
                            <strong>Bekeken:</strong> {{ $car->views }} keer<br>
                            <strong>Gepubliceerd op:</strong> {{ $car->created_at->format('d-m-Y H:i') }}
                        </div>

                        @if(auth()->id() === $car->user_id)
                            <div class="d-flex gap-2">
                                <a href="{{ route('home') }}" class="btn btn-secondary">Terug naar overzicht</a>
                                <!-- Future: Edit and Delete buttons can be added here -->
                            </div>
                        @else
                            <div class="d-flex gap-2">
                                <a href="{{ route('home') }}" class="btn btn-secondary">Terug naar overzicht</a>
                                <button class="btn btn-primary">Contact opnemen</button>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
