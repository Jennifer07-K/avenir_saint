@extends('layouts.app')

@section('content')
    <section class="container clinic-directory">
        <h1 class="clinic-directory__title">Annuaire des cliniques</h1>

        <div class="clinic-directory__grid">
            @foreach($clinics as $clinic)
                <div class="clinic-card">
                    <div class="clinic-card__header">
                        <h2 class="clinic-card__title">
                          {{ $clinic->name }}
                        </h2>
                    </div>
                    <div class="clinic-card__body">
                        <div class="clinic-card__info">
                            <i class="fas fa-map-marker-alt clinic-card__icon"></i>
                            <p class="clinic-card__text">{{ $clinic->address }}</p>
                        </div>
                        <div class="clinic-card__info">
                            <i class="fas fa-phone clinic-card__icon"></i>
                            <p class="clinic-card__text">{{ $clinic->phone }}</p>
                        </div>
                        <div class="clinic-card__info">
                            <i class="fas fa-stethoscope clinic-card__icon"></i>
                            <p class="clinic-card__text">{{ implode(', ', $clinic->services ?? []) }}</p>
                        </div>
                    </div>
                    {{-- <div class="clinic-card__footer">
                        <a href="#" class="btn btn-primary clinic-card__btn">Voir les détails</a>
                    </div> --}}
                </div>
            @endforeach
        </div>
    </section>
@endsection