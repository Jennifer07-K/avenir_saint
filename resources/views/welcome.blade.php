@extends('layouts.app')
@section('title', 'Accueil')
@section('content')
    <!-- Hero Section -->
    <section id="hero" class="hero section light-background">
        <img src="{{ asset('assets/img/hero-bg.jpg') }}" alt="" data-aos="fade-in">
        <div class="container position-relative">
            <div class="welcome position-relative" data-aos="fade-down" data-aos-delay="100">
                <h2 >EPAS</h2>
                <p><span>E</span>nsemble <span>P</span>our un <span>A</span>venir<span> S</span>ain</p>
                <p >Nous luttons contre la drépanocytose <br> en sensibilisant  et  en encourageant le dépistage.</p>
            </div>
            <div class="content row gy-4">
                <div class="col-lg-4 d-flex align-items-stretch">
                    <div class="why-box" data-aos="zoom-out" data-aos-delay="200">
                        <h3>Pourquoi nous choisir ?</h3>
                        <p>Nous offrons des informations fiables, un accès aux cliniques de dépistage et un soutien communautaire pour réduire la transmission de la drépanocytose.</p>
                        <div class="text-center">
                            <a href="{{ route('info') }}" class="more-btn"><span>En savoir plus</span> <i class="bi bi-chevron-right"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8 d-flex align-items-stretch">
                    <div class="d-flex flex-column justify-content-center">
                        <div class="row gy-4">
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box" data-aos="zoom-out" data-aos-delay="300">
                                    <i class="bi bi-clipboard-data"></i>
                                    <h4>Sensibilisation</h4>
                                    <p>80% de la population ignore son génotype. Nous informons pour changer cela.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box" data-aos="zoom-out" data-aos-delay="400">
                                    <i class="bi bi-gem"></i>
                                    <h4>Dépistage</h4>
                                    <p>Encourageons le dépistage par électrophorèse pour des choix éclairés.</p>
                                </div>
                            </div>
                            <div class="col-xl-4 d-flex align-items-stretch">
                                <div class="icon-box" data-aos="zoom-out" data-aos-delay="500">
                                    <i class="bi bi-inboxes"></i>
                                    <h4>Communauté</h4>
                                    <p>Un espace pour les porteurs et leurs familles pour partager et s’entraider.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('about')
    @include('state')
    @include('layouts.service')
    @include('layouts.partenaire')
    @include('layouts.doctor')
    @include('layouts.faq')
    @include('layouts.temoignage')
    @include('layouts.newsletter')



@endsection



