@extends('layouts.app')
@section('title', 'My Bookings')
@section('content')
<h1>My Bookings</h1>
<table>
    <thead>
        <tr>
            <th>Movie</th>
            <th>Date</th>
            <th>Seat</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($bookings as $booking)
            <tr>
                <td>{{ $booking->movie->title }}</td>
                <td>{{ $booking->showtime }}</td>
                <td>{{ $booking->seat }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
