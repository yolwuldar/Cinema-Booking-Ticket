@extends('layouts.app')

@section('title', 'Booking Film')

@section('content')
    <div class="container mx-auto py-6">
        <h1 class="text-3xl font-bold mb-4">Booking: {{ $movie->title }}</h1>

        <form action="{{ route('user.booking.store') }}" method="POST" id="bookingForm">
            @csrf
            <input type="hidden" name="movie_id" value="{{ $movie->id }}">

            <!-- Menampilkan showtimes dan pilih jadwal tayang -->
            <h3 class="mt-4">Pilih Jadwal Tayang</h3>
            <div class="showtimes">
                @if ($movie->showtimes->isEmpty())
                    <p>Jadwal tayang belum tersedia.</p>
                @else
                    <div class="form-group">
                        @foreach ($movie->showtimes->groupBy('date') as $date => $showtimes)
                            <div class="showtime-date mb-3">
                                <h4>{{ \Carbon\Carbon::parse($date)->format('D, d M Y') }}</h4>
                                <div class="showtime-buttons">
                                    @foreach ($showtimes as $showtime)
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="showtime_id"
                                                value="{{ $showtime->id }}" id="showtime_{{ $showtime->id }}">
                                            <label class="form-check-label" for="showtime_{{ $showtime->id }}">
                                                {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }} - 
                                                {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i') }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <button type="submit" class="btn btn-primary mt-3" id="bookingBtn" disabled>Booking</button>
                @endif
            </div>
        </form>
    </div>

    @push('scripts')
        <script>
            document.querySelectorAll('input[name="showtime_id"]').forEach(input => {
                input.addEventListener('change', function() {
                    let selectedShowtimeId = this.value;
                    let bookingButton = document.getElementById('bookingBtn');
                    bookingButton.disabled = false;
                });
            });
        </script>
    @endpush
@endsection
