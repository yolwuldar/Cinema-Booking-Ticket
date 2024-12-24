@extends('layouts.app')
@section('title', 'Add Showtime')
@section('content')
    <div class="container mx-auto py-6 bg-white">
        <h1 class="text-3xl font-bold mb-4">Add Showtime</h1>

        <!-- Menampilkan pesan error jika ada -->
        @if ($errors->any())
            <div class="alert alert-danger mb-4">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.showtimes.store') }}" method="POST">
            @csrf

            <!-- Select Movie -->
            <div class="form-group mb-4">
                <label for="movie_id" class="block text-sm font-medium text-gray-700">Movie</label>
                <select name="movie_id" id="movie_id" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm" required>
                    <option value="">Select Movie</option>
                    @foreach ($movies as $movie)
                        <option value="{{ $movie->id }}" {{ old('movie_id') == $movie->id ? 'selected' : '' }}>
                            {{ $movie->title }}
                        </option>
                    @endforeach
                </select>
                @error('movie_id')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Date -->
            <div class="form-group mb-4">
                <label for="date" class="block text-sm font-medium text-gray-700">Date</label>
                <input type="date" name="date" id="date" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm" value="{{ old('date') }}" required>
                @error('date')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input Start Time -->
            <div class="form-group mb-4">
                <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
                <input type="time" name="start_time" id="start_time" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm" value="{{ old('start_time', '12:00') }}" required>
                @error('start_time')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Input End Time -->
            <div class="form-group mb-4">
                <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
                <input type="time" name="end_time" id="end_time" class="form-control mt-1 block w-full border border-gray-300 rounded-md shadow-sm" value="{{ old('end_time', '14:00') }}" required>
                @error('end_time')
                    <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Button Submit -->
            <button type="submit" class="btn btn-primary py-2 px-4 rounded bg-blue-600 text-white hover:bg-blue-700">
                Add Showtime
            </button>
        </form>
    </div>
@endsection
