@extends('layouts.app')

@section('title', 'Gérer mes services')

@section('content')
    <section class="container section manage-services">
        <h2 class="manage-services__title">Gestion des services</h2>

        @if (session('success'))
            <div class="alert alert-success manage-services__alert">{{ session('success') }}</div>
        @endif

        <div class="manage-services__card">
            <div class="manage-services__card-body">
                <form method="POST" action="{{ route('clinics.services.update') }}" class="manage-services__form">
                    @csrf
                    @method('PATCH')

                    <div class="manage-services__form-group">
                        <label for="services" class="manage-services__label">
                            <i class="fas fa-cogs manage-services__icon"></i>
                            Services offerts
                        </label>
                        <select name="services[]" id="services" class="manage-services__select" multiple required>
                            <option value="Dépistage" {{ $clinic && in_array('Dépistage', $clinic->services ?? []) ? 'selected' : '' }}>Dépistage</option>
                            <option value="Consultation" {{ $clinic && in_array('Consultation', $clinic->services ?? []) ? 'selected' : '' }}>Consultation</option>
                            <option value="Suivi" {{ $clinic && in_array('Suivi', $clinic->services ?? []) ? 'selected' : '' }}>Suivi</option>
                        </select>
                        <small class="manage-services__hint">Maintenez la touche Ctrl (Windows) ou Commande (Mac) pour sélectionner plusieurs services.</small>
                    </div>

                    <button type="submit" class="btn btn-primary manage-services__submit">
                        <i class="fas fa-sync-alt manage-services__icon"></i>
                        Mettre à jour
                    </button>
                </form>
            </div>
        </div>
    </section>
@endsection