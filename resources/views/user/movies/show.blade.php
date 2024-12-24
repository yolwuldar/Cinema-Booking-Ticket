@extends('layouts.app')

@section('title', $movie->title)

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold mb-4">{{ $movie->title }}</h1>
        <div class="row">
            <div class="col-md-6">
                <img src="{{ asset($movie->poster) }}" class="img-fluid" alt="{{ $movie->title }}">
            </div>
            <div class="col-md-6">
                <p><strong>Genre:</strong> {{ $movie->genre }}</p>
                <p><strong>Director:</strong> {{ $movie->director }}</p>
                <p><strong>Casts:</strong> {{ $movie->casts }}</p>
                <p><strong>Age Rating:</strong> {{ $movie->age_rating }}</p>
                <p><strong>Release Date:</strong> {{ $movie->release_date }}</p>
                <p><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
                <p><strong>Synopsis:</strong> {{ $movie->synopsis }}</p>
            </div>
        </div>

<!-- Tombol untuk menuju halaman booking -->
<div class="mt-4">
    <a href="{{ route('user.booking', ['movie_id' => $movie->id]) }}" class="btn btn-primary">Booking Film</a>
</div>
</div>
@endsection