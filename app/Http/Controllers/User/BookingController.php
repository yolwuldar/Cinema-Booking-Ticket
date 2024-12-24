<?php

namespace App\Http\Controllers\User;
use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    // Menampilkan halaman milih kursi
    public function show($movie_id)
    {
        $movie = Movie::with('showtimes')->findOrFail($movie_id);
        return view('user.booking.booking', compact('movie'));
    }

    public function store(Request $request)
    {
        // Logika untuk menyimpan pemesanan tiket
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'showtime_id' => 'required|exists:showtimes,id',
            'seats' => 'required|array',  // Misalnya kursi yang dipilih
        ]);

        // Simpan pemesanan
        // Booking::create($validated); // Model pemesanan

        return redirect()->route('user.booking.success')->with('success', 'Booking berhasil!');
    }

    public function success()
    {
        return view('user.booking.success');
    }
}