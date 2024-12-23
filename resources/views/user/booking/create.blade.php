@extends('layouts.app')
@section('title', 'Book a Ticket')
@section('content')
<h1>Book a Ticket</h1>
<form action="{{ route('booking.store') }}" method="POST">
    @csrf
    <label>Movie:</label>
    <select name="movie_id">
        @foreach ($movies as $movie)
            <option value="{{ $movie->id }}">{{ $movie->title }}</option>
        @endforeach
    </select>
    <label>Showtime:</label>
    <input type="datetime-local" name="showtime">
    <label>Seat:</label>
    <input type="text" name="seat">
    <button type="submit">Book</button>
</form>
@endsection