<?php

namespace App\Http\Controllers\User;

use App\Models\Showtime;
use App\Models\Seat;
use App\Models\Booking;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    // buat nampilin halaman milih kursi
    public function book(Showtime $showtime)
    {
        $seats = Seat::where('room_id', $showtime->room_id)->where('is_booked', false)->get();
        return view('user.booking.book', compact('showtime', 'seats'));
    }

    // konfirmasi pemesanan kursi
    public function confirm(Request $request, Showtime $showtime)
    {
        $request->validate([
            'seats' => 'required|array',
            'seats.*' => 'exists:seats,id',
        ]);


        $booking = Booking::create([
            'user_id' => auth()->id(),
            'showtime_id' => $showtime->id,
        ]);

        $booking->seats()->attach($request->seats);

        Seat::whereIn('id', $request->seats)->update(['is_booked' => true]);

        // redirect ke halaman sukses
        return redirect()->route('user.booking.success');
    }

    // halaman pemesanan yang sudah sukses
    public function success()
    {
        return view('user.booking.success');
    }
}
