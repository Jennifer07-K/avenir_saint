
@extends('layouts.app')
@section('content')
    <section class="container">
        <h1>Forum communautaire</h1>
        @foreach($threads as $thread)
            <div class="card">
                <h2>{{ $thread->title }}</h2>
                <p>{{ $thread->body }}</p>
                <small>Par {{ $thread->user->name }}</small>
                <h3>Réponses :</h3>
                @foreach($thread->replies as $reply)
                    <p>{{ $reply->body }} - <small>{{ $reply->user->name }}</small></p>
                @endforeach
            </div>
        @endforeach
    </section>
@endsection