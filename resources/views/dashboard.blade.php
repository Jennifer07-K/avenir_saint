@extends('layouts.app')
@section('title', 'Tableau de bord')
@section('content')
    <section class="container section">
        <h2>Tableau de bord</h2>
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if (auth()->user()->role === 'clinic')
            @if (auth()->user()->approved)
                @if (auth()->user()->subscription && auth()->user()->subscription->is_active)
                    <p>Bienvenue, {{ auth()->user()->name }} !</p>
                    <div class="row">
                        <div class="col-md-4"><a href="{{ route('clinics.services') }}" class="btn btn-primary">Gérer mes services</a></div>
                        <div class="col-md-4"><a href="{{ route('clinics.profile') }}" class="btn btn-primary">Compléter mon profil</a></div>
                        <div class="col-md-4"><a href="{{ route('forum') }}" class="btn btn-primary">Forum</a></div>
                    </div>
                @else
                    <p>Votre abonnement n’est pas actif. Contactez l’administrateur.</p>
                @endif
            @else
                <p>Votre compte est en attente d’approbation.</p>
            @endif
        @elseif (auth()->user()->role === 'admin')
            <p>Bienvenue, {{ auth()->user()->name }} !</p>
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary">Gérer les cliniques</a>
        @else
            <p>Bienvenue, {{ auth()->user()->name }} !</p>
            <a href="{{ route('forum') }}" class="btn btn-primary">Forum</a>
        @endif
    </section>
@endsection