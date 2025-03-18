@extends('layouts.app')

@section('title', 'Profil')

@section('content')
    <section class="container section profile">
        <h1 class="profile__title">Mon Profil</h1>

        @if (session('success'))
            <div class="alert alert-success profile__alert">{{ session('success') }}</div>
        @endif

        <div class="profile__card">
            <div class="profile__card-body">
                <!-- Informations en lecture seule -->
                <div class="profile__info">
                    <h2 class="profile__clinic-name">{{ $clinic->name }}</h2>
                    <div class="profile__info-item">
                        <i class="fas fa-envelope profile__icon"></i>
                        <p class="profile__info-text">{{ $clinic->email }}</p>
                    </div>
                    <div class="profile__info-item">
                        <i class="fas fa-stethoscope profile__icon"></i>
                        <p class="profile__info-text">{{ implode(', ', $clinic->services ?? []) }}</p>
                    </div>
                </div>

                <!-- Formulaire pour mise à jour -->
                <form method="POST" action="{{ route('clinics.profile.update') }}" class="profile__form">
                    @csrf
                    @method('PATCH')

                    <div class="profile__form-group">
                        <label for="address" class="profile__label">
                            <i class="fas fa-map-marker-alt profile__icon"></i>
                            Adresse
                        </label>
                        <input type="text" name="address" id="address" class="profile__input" value="{{ old('address', $clinic->address) }}" required>
                        @error('address')
                            <span class="profile__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="profile__form-group">
                        <label for="phone" class="profile__label">
                            <i class="fas fa-phone profile__icon"></i>
                            Téléphone
                        </label>
                        <input type="text" name="phone" id="phone" class="profile__input" value="{{ old('phone', $clinic->phone) }}" required>
                        @error('phone')
                            <span class="profile__error">{{ $message }}</span>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary profile__submit">
                        <i class="fas fa-sync-alt profile__icon"></i>
                        Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection