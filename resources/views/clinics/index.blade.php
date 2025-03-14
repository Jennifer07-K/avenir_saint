@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Annuaire des cliniques</h1>
        @foreach($clinics as $clinic)
            <div class="card">
                <h2>{{ $clinic->name }}</h2>
                <p>{{ $clinic->address }}</p>
                <p>Tél : {{ $clinic->phone }}</p>
                <p>Services : {{ $clinic->services }}</p>
            </div>
        @endforeach
    </section>
@endsection