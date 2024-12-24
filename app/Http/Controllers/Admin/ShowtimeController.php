<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Movie;
use App\Models\Showtime;
use Illuminate\Http\Request;

class ShowtimeController extends Controller
{
    public function index()
    {
        $showtimes = Showtime::with('movie')->get();
        return view('admin.showtimes.index', compact('showtimes'));
    }

    public function create()
    {
        $movies = Movie::all();
        return view('admin.showtimes.create', compact('movies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        Showtime::create($validated);

        return redirect()->route('admin.showtimes.index')->with('success', 'Showtime added successfully');
    }

    public function edit($id)
    {
        $showtime = Showtime::findOrFail($id);
        $movies = Movie::all();  // Ambil semua film untuk dipilih
        return view('admin.showtimes.edit', compact('showtime', 'movies'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
            'date' => 'required|date',
            'start_time' => 'required|date_format:H:i',
            'end_time' => 'required|date_format:H:i|after:start_time',
        ]);

        $showtime = Showtime::findOrFail($id);
        $showtime->update($validated);

        return redirect()->route('admin.showtimes.index')->with('success', 'Showtime updated successfully');
    }

    public function destroy($id)
    {
        $showtime = Showtime::findOrFail($id);
        $showtime->delete();

        return redirect()->route('admin.showtimes.index')->with('success', 'Showtime deleted successfully');
    }
}
