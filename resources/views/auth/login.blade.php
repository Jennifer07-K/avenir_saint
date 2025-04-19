@extends('layouts.app') 

@section('title', 'Connexion - EPAS')

@section('content')
    <!-- Login Section -->
    <section class="section light-background">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6 col-md-8">
                    <div class="card shadow-sm login-card" data-aos="fade-up">
                        <div class="card-body p-5">
                            <!-- Titre et sous-titre -->
                            <h2 class="text-center mb-4 login-title">Connexion à EPAS</h2>
                            <p class="text-center text-muted mb-5 login-subtitle">Ensemble pour un avenir sain</p>

                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4 text-center alert alert-success" :status="session('status')" />

                            <!-- Login Form -->
                            <form method="POST" action="{{ route('login') }}" class="login-form">
                                @csrf

                                <!-- Email Address -->
                                <div class="mb-4">
                                    <x-input-label for="email" :value="__('Email')" class="form-label" />
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-envelope"></i>
                                        </span>
                                        <x-text-input id="email" 
                                                      class="bg-white   form-control" 
                                                      type="email" 
                                                      name="email" 
                                                      :value="old('email')" 
                                                      required 
                                                      autofocus 
                                                      autocomplete="username" 
                                                      placeholder="Entrez votre email" />
                                    </div>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                </div>

                                <!-- Password -->
                                <div class="mb-4">
                                    <x-input-label for="password" :value="__('Mot de passe')" class="bg-white form-label" />
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i class="fas fa-lock"></i>
                                        </span>
                                        <x-text-input id="password" 
                                                      class="bg-white  form-control" 
                                                      type="password" 
                                                      name="password" 
                                                      required 
                                                      autocomplete="current-password" 
                                                      placeholder="Entrez votre mot de passe" />
                                    </div>
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                </div>

                                <!-- Remember Me -->
                                <div class="mb-4 form-check">
                                    <input id="remember_me" 
                                           type="checkbox" 
                                           class="form-check-input" 
                                           name="remember">
                                    <label for="remember_me" class="form-check-label">
                                        {{ __('Se souvenir de moi') }}
                                    </label>
                                </div>

                                <div class="d-flex align-items-center justify-content-between">
                                    @if (Route::has('password.request'))
                                        <a class="text-sm text-primary hover:underline" href="{{ route('password.request') }}">
                                            {{ __('Mot de passe oublié ?') }}
                                        </a>
                                    @endif
                                    <x-primary-button class="btn btn-primary" id="btn" >
                                        {{ __('Se connecter') }}
                                    </x-primary-button>
                                </div>
                            </form>

                            <!-- Lien vers inscription -->
                            <p class="text-center mt-4">
                                Pas de compte ? 
                                <a href="{{ route('register') }}" class="text-primary hover:underline">Inscrivez-vous</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection