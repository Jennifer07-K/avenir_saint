
@extends('layouts.app')
@section('title', 'Profil')
@section('content')
    <section class="container section">
        <h1>Mon Profil</h1>
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card">
            <div class="card-body">
                <!-- Informations en lecture seule -->
                <h3>{{ $clinic->name }}</h3>
                <p><strong>Email :</strong> {{ $clinic->email }}</p>
                <p><strong>Services :</strong> {{ implode(', ', $clinic->services ?? []) }}</p>

                <!-- Formulaire pour mise à jour -->
                <form method="POST" action="{{ route('clinics.profile.update') }}">
                    @csrf
                    @method('PATCH')

                    <div class="mb-3">
                        <label for="address" class="form-label">Adresse</label>
                        <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $clinic->address) }}" required>
                        @error('address')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Téléphone</label>
                        <input type="text" name="phone" id="phone" class="form-control" value="{{ old('phone', $clinic->phone) }}" required>
                        @error('phone')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">Mettre à jour</button>
                </form>
            </div>
        </div>
    </section>
@endsection