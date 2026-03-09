@extends('layouts.app')

@section('content')
<div class="create row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Auto aanbieden - Stap 1 van 2</h4>
            </div>
            <div class="card-body">
                @if(session('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif

                <p class="text-muted mb-4">Vul het kenteken van de auto in die je wilt aanbieden.</p>

                <form method="POST" action="{{ route('cars.create') }}">
                    @csrf

                    <div class="form-group mb-4">
                        <label for="license_plate" class="form-label fw-bold">Kenteken</label>
                        <input 
                            type="text" 
                            class="form-control form-control-lg @error('license_plate') is-invalid @enderror" 
                            id="license_plate" 
                            name="license_plate" 
                            placeholder="XX-XX-XX" 
                            value="{{ old('license_plate', session('car_data.license_plate', '')) }}"
                            required
                            autofocus
                        >
                        @error('license_plate')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                        <small class="form-text text-muted">Bijvoorbeeld: 1-XKD-48</small>
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('home') }}" class="btn btn-secondary">Annuleren</a>
                        <button type="submit" class="btn btn-primary btn-lg px-5">
                            Volgende <i class="bi bi-arrow-right"></i>
                        </button>
                    </div>
                </form>
            </div>
        </div>

        <div class="progress-bar mt-3">
            <div class="progress" style="height: 8px;">
                <div class="progress-bar bg-primary" role="progressbar" style="width: 50%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
            <div class="d-flex justify-content-between mt-2">
                <small class="text-primary fw-bold">Kenteken</small>
                <small class="text-muted">Gegevens</small>
            </div>
        </div>
    </div>
</div>
@endsection
