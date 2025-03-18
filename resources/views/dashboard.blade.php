@extends('layouts.app')

@section('title', 'Tableau de bord')

@section('content')
    <section class="container section dashboard">
        <h2 class="dashboard__title">Tableau de bord</h2>

        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif

        @if (auth()->user()->role === 'clinic')
            @if (auth()->user()->approved)
                @if (auth()->user()->subscription && auth()->user()->subscription->is_active)
                    <p class="dashboard__welcome">Bienvenue, {{ auth()->user()->name }} !</p>
                    <div class="dashboard__cards">
                        <!-- Carte pour gérer les services -->
                        <div class="dashboard__card">
                            <div class="dashboard__card-icon">
                                <i class="fas fa-cogs"></i>
                            </div>
                            <h3 class="dashboard__card-title">Gérer mes services</h3>
                            <p class="dashboard__card-description">Créez et modifiez vos services proposés.</p>
                            <a href="{{ route('clinics.services') }}" class="btn btn-primary dashboard__card-btn">
                                Accéder
                            </a>
                        </div>

                        <!-- Carte pour compléter le profil -->
                        <div class="dashboard__card">
                            <div class="dashboard__card-icon">
                                <i class="fas fa-user-edit"></i>
                            </div>
                            <h3 class="dashboard__card-title">Compléter mon profil</h3>
                            <p class="dashboard__card-description">Renseignez les informations de votre clinique.</p>
                            <a href="{{ route('clinics.profile') }}" class="btn btn-primary dashboard__card-btn">
                                Accéder
                            </a>
                        </div>

                        <!-- Carte pour le forum -->
                        <div class="dashboard__card">
                            <div class="dashboard__card-icon">
                                <i class="fas fa-comments"></i>
                            </div>
                            <h3 class="dashboard__card-title">Forum</h3>
                            <p class="dashboard__card-description">Échangez avec d'autres professionnels.</p>
                            <a href="{{ route('forum') }}" class="btn btn-primary dashboard__card-btn">
                                Accéder
                            </a>
                        </div>
                    </div>
                @else
                    <p class="dashboard__alert">Votre abonnement n’est pas actif. Contactez l’administrateur.</p>
                @endif
            @else
                <p class="dashboard__alert">Votre compte est en attente d’approbation.</p>
            @endif
        @elseif (auth()->user()->role === 'admin')
            <p class="dashboard__welcome">Bienvenue, {{ auth()->user()->name }} !</p>
            <div class="dashboard__cards">
                <!-- Carte pour gérer les cliniques -->
                <div class="dashboard__card">
                    <div class="dashboard__card-icon">
                        <i class="fas fa-hospital"></i>
                    </div>
                    <h3 class="dashboard__card-title">Gérer les cliniques</h3>
                    <p class="dashboard__card-description">Consultez et modifiez les cliniques enregistrées.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary dashboard__card-btn">
                        Accéder
                    </a>
                </div>

                <!-- Carte pour gérer les articles -->
                <div class="dashboard__card">
                    <div class="dashboard__card-icon">
                        <i class="fas fa-newspaper"></i>
                    </div>
                    <h3 class="dashboard__card-title">Gérer les articles</h3>
                    <p class="dashboard__card-description">Publiez et modifiez des articles.</p>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-primary dashboard__card-btn">
                        Accéder
                    </a>
                </div>
            </div>
        @else
            <p class="dashboard__welcome">Bienvenue, {{ auth()->user()->name }} !</p>
            <div class="dashboard__cards">
                <!-- Carte pour le forum -->
                <div class="dashboard__card">
                    <div class="dashboard__card-icon">
                        <i class="fas fa-comments"></i>
                    </div>
                    <h3 class="dashboard__card-title">Forum</h3>
                    <p class="dashboard__card-description">Échangez avec d'autres utilisateurs.</p>
                    <a href="{{ route('forum') }}" class="btn btn-primary dashboard__card-btn">
                        Accéder
                    </a>
                </div>
            </div>
        @endif
    </section>
@endsection