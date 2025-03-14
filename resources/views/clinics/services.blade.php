@extends('layouts.app')
@section('title', 'Gérer mes services')
@section('content')
    <section class="container section">
        <h2>Gestion des services</h2>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('clinics.services.update') }}">
                    @csrf
                    @method('PATCH')
                    <div class="mb-3">
                        <label for="services" class="form-label">Services offerts</label>
                        <select name="services[]" id="services" class="form-select" multiple required>
                            <option value="Dépistage" {{ $clinic && in_array('Dépistage', $clinic->services ?? []) ? 'selected' : '' }}>Dépistage</option>
                            <option value="Consultation" {{ $clinic && in_array('Consultation', $clinic->services ?? []) ? 'selected' : '' }}>Consultation</option>
                            <option value="Suivi" {{ $clinic && in_array('Suivi', $clinic->services ?? []) ? 'selected' : '' }}>Suivi</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </section>
@endsection