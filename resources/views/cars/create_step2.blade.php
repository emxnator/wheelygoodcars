@extends('layouts.app')

@section('content')
<div class="create row justify-content-center mt-5">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Auto aanbieden - Stap 2 van 2</h4>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="alert alert-info">
                    <strong>Kenteken:</strong> {{ $carData['license_plate'] ?? 'Niet ingevuld' }}
                </div>

                <p class="text-muted mb-4">Vul de gegevens van de auto in. Velden met een * zijn verplicht.</p>

                <form method="POST" action="{{ route('cars.store') }}">
                    @csrf

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="brand" class="form-label fw-bold">Merk *</label>
                            <input 
                                type="text" 
                                class="form-control @error('brand') is-invalid @enderror" 
                                id="brand" 
                                name="brand" 
                                value="{{ old('brand', $carData['brand'] ?? '') }}"
                                required
                                placeholder="Bijv. Opel"
                            >
                            @error('brand')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Model -->
                        <div class="col-md-6 mb-3">
                            <label for="model" class="form-label fw-bold">Model *</label>
                            <input 
                                type="text" 
                                class="form-control @error('model') is-invalid @enderror" 
                                id="model" 
                                name="model" 
                                value="{{ old('model', $carData['model'] ?? '') }}"
                                required
                                placeholder="Bijv. Corsa"
                            >
                            @error('model')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Price (Vraagprijs) -->
                        <div class="col-md-4 mb-3">
                            <label for="price" class="form-label fw-bold">Vraagprijs *</label>
                            <div class="input-group">
                                <span class="input-group-text">€</span>
                                <input 
                                    type="number" 
                                    class="form-control @error('price') is-invalid @enderror" 
                                    id="price" 
                                    name="price" 
                                    value="{{ old('price', $carData['price'] ?? '') }}"
                                    required
                                    min="0"
                                    step="0.01"
                                    placeholder="0.00"
                                >
                                @error('price')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Mileage (Kilometerstand) -->
                        <div class="col-md-4 mb-3">
                            <label for="mileage" class="form-label fw-bold">Kilometerstand *</label>
                            <div class="input-group">
                                <input 
                                    type="number" 
                                    class="form-control @error('mileage') is-invalid @enderror" 
                                    id="mileage" 
                                    name="mileage" 
                                    value="{{ old('mileage', $carData['mileage'] ?? '') }}"
                                    required
                                    min="0"
                                    placeholder="0"
                                >
                                <span class="input-group-text">km</span>
                                @error('mileage')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Production Year (Jaar van productie) -->
                        <div class="col-md-4 mb-3">
                            <label for="production_year" class="form-label fw-bold">Jaar van productie</label>
                            <input 
                                type="number" 
                                class="form-control @error('production_year') is-invalid @enderror" 
                                id="production_year" 
                                name="production_year" 
                                value="{{ old('production_year', $carData['production_year'] ?? '') }}"
                                min="1900"
                                max="{{ date('Y') }}"
                                placeholder="2014"
                            >
                            @error('production_year')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <!-- Seats (Zitplaatsen) -->
                        <div class="col-md-3 mb-3">
                            <label for="seats" class="form-label fw-bold">Zitplaatsen</label>
                            <input 
                                type="number" 
                                class="form-control @error('seats') is-invalid @enderror" 
                                id="seats" 
                                name="seats" 
                                value="{{ old('seats', $carData['seats'] ?? '') }}"
                                min="1"
                                placeholder="4"
                            >
                            @error('seats')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Doors (Aantal deuren) -->
                        <div class="col-md-3 mb-3">
                            <label for="doors" class="form-label fw-bold">Aantal deuren</label>
                            <input 
                                type="number" 
                                class="form-control @error('doors') is-invalid @enderror" 
                                id="doors" 
                                name="doors" 
                                value="{{ old('doors', $carData['doors'] ?? '') }}"
                                min="1"
                                placeholder="5"
                            >
                            @error('doors')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Weight (Massa rijklaar) -->
                        <div class="col-md-3 mb-3">
                            <label for="weight" class="form-label fw-bold">Massa rijklaar</label>
                            <div class="input-group">
                                <input 
                                    type="number" 
                                    class="form-control @error('weight') is-invalid @enderror" 
                                    id="weight" 
                                    name="weight" 
                                    value="{{ old('weight', $carData['weight'] ?? '') }}"
                                    min="0"
                                    placeholder="1165"
                                >
                                <span class="input-group-text">kg</span>
                                @error('weight')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Color (Kleur) -->
                        <div class="col-md-3 mb-3">
                            <label for="color" class="form-label fw-bold">Kleur</label>
                            <input 
                                type="text" 
                                class="form-control @error('color') is-invalid @enderror" 
                                id="color" 
                                name="color" 
                                value="{{ old('color', $carData['color'] ?? '') }}"
                                placeholder="Wit"
                            >
                            @error('color')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('cars.create') }}" class="btn btn-secondary">
                            <i class="bi bi-arrow-left"></i> Terug
                        </a>
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            Aanbod plaatsen
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Progress indicator -->
        <div class="mt-3">
            <div class="progress" style="height: 8px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 100%;" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <small class="text-muted">Kenteken</small>
                <small class="text-primary fw-bold">Gegevens</small>
            </div>
        </div>
    </div>
</div>
@endsection
