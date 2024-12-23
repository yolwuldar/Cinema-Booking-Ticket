@extends('layouts.app')
@section('title', 'Movies')
@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-2xl font-bold mb-4">Sedang tayang</h1>
        <div class="row">
            @foreach ($movies as $movie)
                <div class="movie">
                    <h3>{{ $movie->title }}</h3>
                    <img src="{{ asset($movie->poster) }}" alt="{{ $movie->title }}" />
                    <p>{{ $movie->synopsis }}</p>
                    <a href="{{ route('user.movies.show', $movie->id) }}"  class="btn btn-primary">Lihat Detail</a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
