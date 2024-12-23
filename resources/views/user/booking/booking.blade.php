@extends('layouts.app')
@section('content')
    <h1>Booking for Movie: {{ $showtime->movie->title }}</h1>
    
    <!-- nampilin informasi jadwal tayang -->
    <div class="showtime-details">
        <p><strong>Movie:</strong> {{ $showtime->movie->title }}</p>
        <p><strong>Room:</strong> {{ $showtime->room->name }}</p>
        <p><strong>Showtime:</strong> {{ $showtime->start_time }} - {{ $showtime->end_time }}</p>
    </div>
    
    <form action="{{ route('user.confirm.booking', $showtime->id) }}" method="POST">
        @csrf
        <div class="seats">
            @foreach($seats as $seat)
                <div class="seat">
                    <input type="checkbox" name="seats[]" value="{{ $seat->id }}">
                    <label>{{ $seat->name }}</label>
                </div>
            @endforeach
        </div>

        <button type="submit">Confirm Booking</button>
    </form>
@endsection
