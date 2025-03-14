@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Informations sur la drépanocytose</h1>
        @foreach($contents as $content)
            <div class="card">
                <h2>{{ $content->title }}</h2>
                <p>{{ $content->description }}</p>
                @if($content->type === 'video')
                    <video src="{{ asset($content->file_path) }}" controls></video>
                @elseif($content->type === 'infography')
                    <img src="{{ asset($content->file_path) }}" alt="{{ $content->title }}">
                @endif
            </div>
        @endforeach
    </section>
@endsection