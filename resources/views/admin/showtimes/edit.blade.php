@extends('layouts.app')

@section('title', 'Edit Showtime')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold mb-4">Edit Showtime</h1>

        <form action="{{ route('admin.showtimes.update', $showtime->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="movie_id">Movie</label>
                <select class="form-control" name="movie_id" id="movie_id" required>
                    <option value="">Select Movie</option>
                    @foreach ($movies as $movie)
                        <option value="{{ $movie->id }}" {{ $movie->id == $showtime->movie_id ? 'selected' : '' }}>
                            {{ $movie->title }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="date">Date</label>
                <input type="date" class="form-control" name="date" id="date" value="{{ $showtime->date }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="start_time">Start Time</label>
                <input type="time" class="form-control" name="start_time" id="start_time" value="{{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="end_time">End Time</label>
                <input type="time" class="form-control" name="end_time" id="end_time" value="{{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Update Showtime</button>
        </form>
    </div>
@endsection
