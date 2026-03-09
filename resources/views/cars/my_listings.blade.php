@extends('layouts.app')

@section('content')
<div class="my-cars container mt-5">
    <div class="row">
        <div class="col-12">
            <div class="top d-flex justify-content-between align-items-center mb-4">
                <h2>Mijn aanbod</h2>
                <a href="{{ route('cars.create') }}" class="btn btn-primary">
                    <i class="bi bi-plus-circle"></i> Nieuwe auto aanbieden
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if($cars->isEmpty())
                <div class="empty card">
                    <div class="card-body text-center py-5">
                        <i class="bi bi-car-front" style="font-size: 4rem; color: #ddd;"></i>
                        <h4 class="mt-3 text-muted">Je hebt nog geen auto's aangeboden</h4>
                        <p class="text-muted">Klik op de knop hierboven om je eerste auto aan te bieden.</p>
                        <a href="{{ route('cars.create') }}" class="btn btn-primary mt-3">
                            Auto aanbieden
                        </a>
                    </div>
                </div>
            @else
                <div class="list card">
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead class="table-dark">
                                    <tr>
                                        <th>Kenteken</th>
                                        <th>Merk & Model</th>
                                        <th>Prijs</th>
                                        <th>Kilometerstand</th>
                                        <th>Jaar</th>
                                        <th>Bekeken</th>
                                        <th>Toegevoegd</th>
                                        <th class="text-center">Acties</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($cars as $car)
                                        <tr>
                                            <td class="plate">
                                                <span class="badge bg-warning text-dark">{{ $car->license_plate }}</span>
                                            </td>
                                            <td class="car">
                                                <strong>{{ $car->brand }} {{ $car->model }}</strong>
                                                @if($car->color)
                                                    <br><small class="text-muted">{{ $car->color }}</small>
                                                @endif
                                            </td>
                                            <td class="price">
                                                <strong class="text-primary">€ {{ number_format($car->price, 2, ',', '.') }}</strong>
                                            </td>
                                            <td class="km">{{ number_format($car->mileage, 0, ',', '.') }} km</td>
                                            <td class="year">{{ $car->production_year ?? '-' }}</td>
                                            <td class="views">
                                                <span class="badge bg-info">{{ $car->views }} x</span>
                                            </td>
                                            <td class="date">
                                                <small class="text-muted">{{ $car->created_at->format('d-m-Y') }}</small>
                                            </td>
                                            <td class="act text-center">
                                                <div class="btn-group btn-group-sm" role="group">
                                                    <a href="{{ route('cars.show', $car->id) }}" 
                                                       class="btn btn-outline-primary" 
                                                       title="Bekijken">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                    <button type="button" 
                                                            class="btn btn-outline-danger" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#del{{ $car->id }}"
                                                            title="Verwijderen">
                                                        <i class="bi bi-trash"></i>
                                                    </button>
                                                </div>

                                                <!-- Delete Confirmation Modal -->
                                                <div class="modal fade" id="del{{ $car->id }}" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Auto verwijderen</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Weet je zeker dat je deze auto wilt verwijderen?</p>
                                                                <div class="info alert alert-warning">
                                                                    <strong>{{ $car->brand }} {{ $car->model }}</strong><br>
                                                                    Kenteken: {{ $car->license_plate }}<br>
                                                                    Prijs: € {{ number_format($car->price, 2, ',', '.') }}
                                                                </div>
                                                                <p class="text-muted small">Deze actie kan niet ongedaan worden gemaakt.</p>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuleren</button>
                                                                <form method="POST" action="{{ route('cars.destroy', $car->id) }}" class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit" class="btn btn-danger">
                                                                        <i class="bi bi-trash"></i> Verwijderen
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer bg-light">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-muted">
                                <strong>{{ $cars->count() }}</strong> auto{{ $cars->count() !== 1 ? "'s" : '' }} aangeboden
                            </span>
                            <span class="text-muted small">
                                Totale weergaven: <strong>{{ $cars->sum('views') }}</strong>
                            </span>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
