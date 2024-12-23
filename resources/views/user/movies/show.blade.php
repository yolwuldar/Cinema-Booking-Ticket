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

        <!-- Menampilkan showtimes dan pilih jadwal tayang -->
        <h3 class="mt-4">Pilih Jadwal Tayang</h3>
        <form action="{{ route('user.booking', ['showtime_id' => '__showtime_id__']) }}" method="GET" id="bookingForm">
            @csrf
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
                                            <input class="form-check-input" type="radio" name="showtime_id" value="{{ $showtime->id }}" id="showtime_{{ $showtime->id }}">
                                            <label class="form-check-label" for="showtime_{{ $showtime->id }}">
                                                {{ \Carbon\Carbon::parse($showtime->start_time)->format('H:i') }} - {{ \Carbon\Carbon::parse($showtime->end_time)->format('H:i') }}
                                            </label>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <!-- Tombol untuk Buy Ticket jika showtime dipilih -->
                    <button type="submit" class="btn btn-primary mt-3" id="buyTicketBtn" disabled>Buy Ticket</button>
                @endif
            </div>
        </form>
    </div>

    @push('scripts')
    <script>
        // Update form action dengan showtime_id yang dipilih
        document.querySelectorAll('input[name="showtime_id"]').forEach(input => {
            input.addEventListener('change', function() {
                let selectedShowtimeId = this.value;
                let formAction = "{{ route('user.booking', ['showtime_id' => '__showtime_id__']) }}";
                formAction = formAction.replace('__showtime_id__', selectedShowtimeId);
                document.getElementById('bookingForm').action = formAction;
                document.getElementById('buyTicketBtn').disabled = false;
            });
        });
    </script>
    @endpush
@endsection
